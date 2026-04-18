import os, sys

theme = r"c:\Users\ajspi\.gemini\antigravity\scratch\livia-medspa-theme"
BOM = b"\xef\xbb\xbf"

fixed = []
for fname in sorted(os.listdir(theme)):
    if not fname.endswith(".php"):
        continue
    fpath = os.path.join(theme, fname)
    with open(fpath, "rb") as f:
        raw = f.read()
    if raw.startswith(BOM):
        raw = raw[3:]
        with open(fpath, "wb") as f:
            f.write(raw)
        fixed.append(fname)
        sys.stderr.write(f"  BOM removed: {fname}\n")

if not fixed:
    sys.stderr.write("No BOM found in any PHP file.\n")
else:
    sys.stderr.write(f"\nFixed {len(fixed)} files.\n")
