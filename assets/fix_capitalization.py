#!/usr/bin/env python3
"""
Replace all brand-name occurrences of 'Livia' with 'LIVIA' across the theme.
Rules:
  - REPLACE: 'Livia' when used as the brand name in text/strings
  - SKIP: 'Livia' when followed by '-' or '_' (slugs, CSS classes, PHP identifiers)
  - SKIP: 'Livia' when inside a URL (preceded by '/', '.', or '=')
  - SKIP: 'livia' (lowercase — these are slugs/identifiers, leave alone)
"""
import os, re, sys

theme_dir = r"c:\Users\ajspi\.gemini\antigravity\scratch\livia-medspa-theme"
exts = (".php", ".js")

# Pattern: 'Livia' NOT followed by [-_a-z] (which would make it a slug/identifier)
# Use lookahead to skip slug forms
PATTERN = re.compile(r"Livia(?![-_a-z])")

total_replaced = 0
files_changed = []

for fname in sorted(os.listdir(theme_dir)):
    if not fname.endswith(exts):
        continue
    fpath = os.path.join(theme_dir, fname)

    with open(fpath, "rb") as f:
        raw = f.read()
    text = raw.decode("utf-8", errors="replace")

    # Split text into segments: inside URLs (don't replace) vs outside (replace)
    # Strategy: replace in string, but protect URL attribute values first
    # We'll do a character-by-character context check via regex substitution

    def replacer(m):
        start = m.start()
        # Look back up to 60 chars for URL context indicators
        lookback = text[max(0, start-60):start]
        # If we're right after href=", src=", url(, or a path separator
        # Check if we're inside a URL by looking for open quote with URL chars before Livia
        if re.search(r'(?:href|src|url|action|content)=["\'][^"\']*$', lookback):
            return m.group(0)  # skip — inside a URL attribute
        # Skip if part of a PHP function/hook name (preceded by underscore or letter with no space)
        if re.search(r'[a-z_]$', lookback):
            return m.group(0)
        return "LIVIA"

    new_text, n = PATTERN.subn(replacer, text)

    if n > 0:
        with open(fpath, "w", encoding="utf-8", newline="") as f:
            f.write(new_text)
        total_replaced += n
        files_changed.append((fname, n))
        sys.stderr.write(f"  {fname}: {n} replaced\n")

sys.stderr.write(f"\nTotal: {total_replaced} replacements across {len(files_changed)} files.\n")
sys.stderr.write("Done.\n")
