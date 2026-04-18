import os, sys

theme = r"c:\Users\ajspi\.gemini\antigravity\scratch\livia-medspa-theme"

issues = []
for fname in sorted(os.listdir(theme)):
    if not fname.endswith(".php"):
        continue
    fpath = os.path.join(theme, fname)
    with open(fpath, "rb") as f:
        raw = f.read()
    double_crlf = raw.count(b"\r\r\n")
    size = len(raw)
    if double_crlf:
        issues.append((fname, double_crlf, size))

if issues:
    sys.stderr.write("FILES WITH DOUBLE LINE ENDINGS:\n")
    for fname, count, size in issues:
        sys.stderr.write(f"  {fname}: {count}x double-CRLF, {size} bytes\n")
else:
    sys.stderr.write("No double line ending issues.\n")

hp = os.path.join(theme, "header.php")
with open(hp, "rb") as f:
    raw = f.read()
sys.stderr.write(f"header.php: {len(raw)} bytes, lines: {raw.count(b'\\n')}\n")
sys.stderr.write(f"style.css: {os.path.getsize(os.path.join(theme, 'style.css'))} bytes\n")
