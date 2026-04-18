import os, sys
theme = r"c:\Users\ajspi\.gemini\antigravity\scratch\livia-medspa-theme"
for fname in ["functions.php", "header.php"]:
    fpath = os.path.join(theme, fname)
    with open(fpath, "r", encoding="utf-8") as f:
        content = f.read()
    new = content.replace('content="Livia Med Spa"', 'content="LIVIA Med Spa"')
    if content != new:
        with open(fpath, "w", encoding="utf-8", newline="") as f:
            f.write(new)
        sys.stderr.write("Fixed: " + fname + "\n")
    else:
        sys.stderr.write("No change: " + fname + "\n")
