#!/usr/bin/env python3
"""Fix broken emoji/mojibake in header.php using the correct byte sequences."""
import sys

filepath = r"c:\Users\ajspi\.gemini\antigravity\scratch\livia-medspa-theme\header.php"

with open(filepath, "rb") as f:
    raw = f.read()

sys.stderr.write(f"File size: {len(raw)} bytes\n")

def moji_bytes(chars_as_unicode):
    """Convert a string of mojibake codepoints to their UTF-8 byte representation."""
    return chars_as_unicode.encode("utf-8")

bottle_svg = (
    '<svg width="14" height="16" viewBox="0 0 20 32" fill="none" stroke="currentColor" '
    'stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
    '<rect x="7" y="1" width="6" height="4" rx="1"/>'
    '<path d="M7 5C4.5 7 4 9 4 11"/>'
    '<path d="M13 5C15.5 7 16 9 16 11"/>'
    '<rect x="4" y="11" width="12" height="18" rx="3"/>'
    '<line x1="7" y1="17" x2="13" y2="17"/>'
    '<line x1="7" y1="21" x2="11" y2="21"/>'
    '</svg>'
).encode("utf-8")

person_svg = (
    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
    'stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
    '<circle cx="12" cy="8" r="4"/>'
    '<path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>'
    '</svg>'
).encode("utf-8")

# Mojibake characters (as unicode strings), paired with replacements (as bytes)
# All identified from the char inspection at their actual codepoints in the file
fixes = [
    # Shopping bag 🛍️: U+00F0 U+0178 U+203A U+008D U+00EF U+00B8 U+008F
    (
        moji_bytes(chr(0x00f0)+chr(0x0178)+chr(0x203a)+chr(0x008d)+chr(0x00ef)+chr(0x00b8)+chr(0x008f)),
        bottle_svg
    ),
    # Doctor 👩‍⚕️: U+00F0 U+0178 U+2018 U+00A9 U+00E2 U+20AC U+008D U+00E2 U+0161 U+2022 U+00EF U+00B8 U+008F
    (
        moji_bytes(chr(0x00f0)+chr(0x0178)+chr(0x2018)+chr(0x00a9)+chr(0x00e2)+chr(0x20ac)+chr(0x008d)+chr(0x00e2)+chr(0x0161)+chr(0x2022)+chr(0x00ef)+chr(0x00b8)+chr(0x008f)),
        person_svg
    ),
    # Money bag 💰: U+00F0 U+0178 U+2019 U+00B0
    (
        moji_bytes(chr(0x00f0)+chr(0x0178)+chr(0x2019)+chr(0x00b0)),
        "\u2726".encode("utf-8")
    ),
    # Question mark ❓: U+00E2 U+009D U+201C  
    (
        moji_bytes(chr(0x00e2)+chr(0x009d)+chr(0x201c)),
        b"?"
    ),
]

for bad_b, good_b in fixes:
    n = raw.count(bad_b)
    sys.stderr.write(f"Searching {bad_b[:4].hex()}...: found {n}\n")
    if n:
        raw = raw.replace(bad_b, good_b)

with open(filepath, "wb") as f:
    f.write(raw)

sys.stderr.write(f"Written {len(raw)} bytes\n")

with open(filepath, "rb") as f:
    check = f.read()
has_svg = b'viewBox="0 0 20 32"' in check
sys.stderr.write(f"Bottle SVG present: {has_svg}\n")
sys.stderr.write("DONE\n")
