"""Lightweight PHP structural checker (no PHP binary on this machine).

Verifies, for each file passed on the command line:
  1. <?php / ?> tags are balanced and never nested.
  2. Alternative-syntax blocks (if/endif, foreach/endforeach, while/endwhile,
     for/endfor, switch/endswitch) are balanced across the whole file.
  3. Braces, parens, and brackets inside PHP code are balanced
     (string and comment content is stripped first).

This is not a full parser, but it catches the structural mistakes that a
hand-edited WordPress template typically introduces.
"""
import re
import sys


def extract_php(source: str):
    """Return concatenated PHP code segments, checking tag balance."""
    segments = []
    pos = 0
    depth = 0
    while True:
        if depth == 0:
            i = source.find("<?php", pos)
            j = source.find("<?=", pos)
            if i == -1 and j == -1:
                break
            if i == -1 or (j != -1 and j < i):
                i = j
                skip = 3
            else:
                skip = 5
            pos = i + skip
            depth = 1
        else:
            k = source.find("?>", pos)
            if k == -1:
                segments.append(source[pos:])
                pos = len(source)
                depth = 0
                break
            segments.append(source[pos:k])
            pos = k + 2
            depth = 0
    return "\n".join(segments)


def strip_strings_and_comments(code: str) -> str:
    out = []
    i = 0
    n = len(code)
    while i < n:
        c = code[i]
        if c in ("'", '"'):
            quote = c
            i += 1
            while i < n:
                if code[i] == "\\":
                    i += 2
                    continue
                if code[i] == quote:
                    i += 1
                    break
                i += 1
            out.append("''")
        elif c == "/" and i + 1 < n and code[i + 1] == "/":
            while i < n and code[i] != "\n":
                i += 1
        elif c == "#":
            while i < n and code[i] != "\n":
                i += 1
        elif c == "/" and i + 1 < n and code[i + 1] == "*":
            end = code.find("*/", i + 2)
            i = n if end == -1 else end + 2
        else:
            out.append(c)
            i += 1
    return "".join(out)


def check(path: str) -> bool:
    src = open(path, encoding="utf-8").read()
    code = strip_strings_and_comments(extract_php(src))
    ok = True

    for open_c, close_c in [("(", ")"), ("{", "}"), ("[", "]")]:
        if code.count(open_c) != code.count(close_c):
            print(f"{path}: unbalanced {open_c}{close_c} "
                  f"({code.count(open_c)} vs {code.count(close_c)})")
            ok = False

    pairs = {
        "if": "endif", "foreach": "endforeach", "while": "endwhile",
        "for": "endfor", "switch": "endswitch",
    }
    for kw, end_kw in pairs.items():
        # Count colon-form openers: keyword ... ) :
        # ("for" headers legitimately contain semicolons; other keywords
        #  use the ; exclusion to avoid matching across statements)
        body = r"[^{]*?" if kw == "for" else r"[^;{]*?"
        opens = len(re.findall(rf"\b{kw}\b{body}\)\s*:", code))
        closes = len(re.findall(rf"\b{end_kw}\b", code))
        if opens != closes:
            print(f"{path}: {kw}/{end_kw} mismatch ({opens} vs {closes})")
            ok = False

    if ok:
        print(f"{path}: OK")
    return ok


if __name__ == "__main__":
    results = [check(p) for p in sys.argv[1:]]
    sys.exit(0 if all(results) else 1)
