"""style.css analyzer: exact duplicate rules and orphaned class prefixes.

Reports:
  1. EXACT duplicates — same media context, same selector, identical
     declarations. The earlier copy is always safe to delete (the later
     copy re-asserts the same values, so the cascade result is unchanged).
  2. Same selector redefined with different declarations (manual review).
  3. Top-level class prefixes (.foo from .foo__bar/.foo--baz) that appear
     in zero PHP templates and zero inline JS — candidates for removal.
"""
import io
import re
import sys
import glob
from collections import defaultdict

CSS = "style.css"


def parse_rules(text):
    """Yield (media, selector, body, start_line, end_line). Handles one
    level of @media nesting (the only nesting this stylesheet uses)."""
    rules = []
    i = 0
    n = len(text)
    line = 1
    media = ""
    media_depth = 0
    buf_start_line = 1
    buf = []

    def flush(end_line):
        nonlocal buf, buf_start_line
        sel = "".join(buf).strip()
        buf = []
        buf_start_line = end_line
        return sel

    while i < n:
        c = text[i]
        if c == "\n":
            line += 1
        if c == "/" and i + 1 < n and text[i + 1] == "*":
            end = text.find("*/", i + 2)
            if end == -1:
                break
            line += text.count("\n", i, end + 2)
            i = end + 2
            buf_start_line = line
            continue
        if c == "{":
            sel = flush(line)
            if sel.startswith("@media") or sel.startswith("@supports"):
                media = sel
                media_depth = 1
                i += 1
                continue
            if sel.startswith("@"):  # @keyframes, @font-face etc.
                depth = 1
                start = i + 1
                j = start
                while j < n and depth:
                    if text[j] == "{":
                        depth += 1
                    elif text[j] == "}":
                        depth -= 1
                    j += 1
                line += text.count("\n", i, j)
                i = j
                buf_start_line = line
                continue
            # normal rule
            end = text.find("}", i + 1)
            if end == -1:
                break
            body = text[i + 1:end]
            start_line = buf_start_line
            line += text.count("\n", i, end + 1)
            rules.append((media, sel, body, start_line, line))
            i = end + 1
            buf_start_line = line
            continue
        if c == "}":
            if media_depth:
                media = ""
                media_depth = 0
            buf = []
            i += 1
            buf_start_line = line
            continue
        buf.append(c)
        i += 1
    return rules


def norm_body(body):
    decls = sorted(d.strip() for d in body.split(";") if d.strip())
    return ";".join(re.sub(r"\s+", " ", d) for d in decls)


def main():
    text = io.open(CSS, encoding="utf-8").read()
    rules = parse_rules(text)
    print(f"parsed {len(rules)} rules")

    seen = defaultdict(list)
    for media, sel, body, s, e in rules:
        key = (media, re.sub(r"\s+", " ", sel))
        seen[key].append((norm_body(body), s, e))

    print("\n== EXACT DUPLICATES (earlier copy safe to delete) ==")
    exact = 0
    for (media, sel), occ in seen.items():
        if len(occ) < 2:
            continue
        bodies = defaultdict(list)
        for nb, s, e in occ:
            bodies[nb].append((s, e))
        for nb, locs in bodies.items():
            if len(locs) > 1:
                exact += 1
                m = f" [{media[:40]}]" if media else ""
                print(f"  {sel}{m}: lines {', '.join(str(s) for s, _ in locs)}")
    print(f"  total: {exact}")

    print("\n== REDEFINED (same selector, different declarations) ==")
    rede = 0
    for (media, sel), occ in seen.items():
        uniq = {nb for nb, _, _ in occ}
        if len(uniq) > 1:
            rede += 1
            m = f" [{media[:40]}]" if media else ""
            print(f"  {sel}{m}: lines {', '.join(str(s) for _, s, _ in occ)}")
    print(f"  total: {rede}")

    # Orphan check: class prefixes never referenced in PHP or inline JS
    refs = ""
    for p in glob.glob("*.php") + glob.glob("inc/*.php"):
        refs += io.open(p, encoding="utf-8", errors="replace").read()

    css_classes = set()
    for _, sel, _, _, _ in rules:
        for m in re.finditer(r"\.([a-zA-Z][\w-]*)", sel):
            css_classes.add(m.group(1))

    prefixes = defaultdict(set)
    for cls in css_classes:
        root = re.split(r"__|--", cls)[0]
        prefixes[root].add(cls)

    print("\n== ORPHAN CLASS PREFIXES (no PHP/JS reference) ==")
    for root in sorted(prefixes):
        if root in ("is", "has", "wp", "admin", "page", "post", "no"):
            continue
        if root not in refs:
            classes = prefixes[root]
            lines = sorted(s for _, sel, _, s, _ in rules
                           if re.search(rf"\.{re.escape(root)}(?![\w-])|\.{re.escape(root)}(?:__|--)", sel))
            print(f"  {root}: {len(classes)} class(es), rules at lines "
                  f"{lines[0]}..{lines[-1]} ({len(lines)} rules)")


if __name__ == "__main__":
    main()
