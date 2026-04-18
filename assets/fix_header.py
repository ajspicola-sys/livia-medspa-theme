#!/usr/bin/env python3
"""One-shot complete fix for ALL mojibake in header.php using raw byte replacement."""
import sys

filepath = r"c:\Users\ajspi\.gemini\antigravity\scratch\livia-medspa-theme\header.php"

with open(filepath, "rb") as f:
    raw = f.read()

sys.stderr.write(f"Original size: {len(raw)} bytes\n")

# All fixes: (bad_hex, good_bytes, description)
fixes = [
    # â€" (em dash) -> — (U+2014)
    (bytes.fromhex("c3a2e282ace2809d"), "\u2014".encode("utf-8"), "em-dash"),
    # â€" (en dash variant) -> —
    (bytes.fromhex("c3a2e282ace2809c"), "\u2013".encode("utf-8"), "en-dash"),
    # â–¾ (▾ small triangle) -> ▾ (U+25BE)
    (bytes.fromhex("c3a2e28093c2be"), "\u25be".encode("utf-8"), "triangle-down"),
    # âœ¨ (sparkles) -> ✦ (U+2726 four-pointed star)
    (bytes.fromhex("c3a2c593c2a8"), "\u2726".encode("utf-8"), "sparkles->star"),
    # â†' (right arrow) -> → (U+2192)
    (bytes.fromhex("c3a2e280a0e28099"), "\u2192".encode("utf-8"), "right-arrow"),
    # âœ¦ (star) -> ✦ (U+2726)
    (bytes.fromhex("c3a2c593c2a6"), "\u2726".encode("utf-8"), "star"),
    # ðŸŽ¯ (target emoji) -> target SVG
    (bytes.fromhex("c3b0c5b8c5bdc2af"), (
        '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
        'stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
        '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="5"/>'
        '<circle cx="12" cy="12" r="2" fill="currentColor" stroke="none"/></svg>'
    ).encode("utf-8"), "target-emoji->SVG"),
    # âœ• (ballot x) -> × (HTML times)
    (bytes.fromhex("c3a2c593e280a2"), "\u00d7".encode("utf-8"), "x-mark"),
]

for bad, good, desc in fixes:
    n = raw.count(bad)
    sys.stderr.write(f"  {desc}: found {n}x\n")
    if n:
        raw = raw.replace(bad, good)

with open(filepath, "wb") as f:
    f.write(raw)

sys.stderr.write(f"Written: {len(raw)} bytes\n")

# Verify no broken sequences remain
with open(filepath, "rb") as f:
    check = f.read()

remaining = []
for bad, _, desc in fixes:
    n = check.count(bad)
    if n:
        remaining.append(f"{desc}: {n} remaining")

if remaining:
    sys.stderr.write("STILL BROKEN: " + ", ".join(remaining) + "\n")
else:
    sys.stderr.write("ALL CLEAN - no broken sequences remain.\n")

sys.stderr.write("Arrow present: " + str(b'\xe2\x86\x92' in check) + "\n")
sys.stderr.write("Triangle present: " + str(b'\xe2\x96\xbe' in check) + "\n")
