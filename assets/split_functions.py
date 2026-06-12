"""One-time splitter: functions.php -> inc/ modules.

Extracts exact line ranges (1-indexed, inclusive) from functions.php into
module files, preserving every byte of each section. Writes inc/*.php and
functions_new.php for verification; the caller swaps the file afterwards.
"""
import io
import os
import sys

SRC = "functions.php"
OUT_DIR = "inc"

# (start, end, module) — must tile lines 7..EOF with no gaps or overlaps
SEGMENTS = [
    (7, 20, "setup"),
    (21, 59, "seo-schema"),
    (60, 72, "seo-schema"),
    (73, 77, "seo-schema"),
    (78, 123, "seo-schema"),
    (124, 195, "seo-schema"),
    (196, 238, "seo-schema"),
    (239, 261, "performance"),
    (262, 275, "performance"),
    (276, 284, "performance"),
    (285, 322, "seo-schema"),
    (323, 334, "performance"),
    (335, 344, "performance"),
    (345, 375, "setup"),
    (376, 394, "performance"),
    (395, 420, "performance"),
    (421, 427, "performance"),
    (428, 501, "performance"),
    (502, 515, "performance"),
    (516, 520, "performance"),
    (521, 677, "seo-schema"),
    (678, 723, "content-seeder"),
    (724, 755, "content-seeder"),
    (756, 769, "content-seeder"),
    (770, 833, "content-seeder"),
    (834, 1002, "content-seeder"),
    (1003, 1174, "content-seeder"),
    (1175, 1214, "post-types"),
    (1215, 1226, "post-types"),
    (1227, 1253, "post-types"),
    (1254, 1316, "metaboxes"),
    (1317, 1343, "post-types"),
    (1344, 1410, "metaboxes"),
    (1411, 1420, "post-types"),
    (1421, 1431, "setup"),
    (1432, 1439, "setup"),
    (1440, 1442, "setup"),
    (1443, 1451, "performance"),
    (1452, 1484, "seo-schema"),
    (1485, 1494, "setup"),
    (1495, 1562, "forms"),
    (1563, 1637, "forms"),
    (1638, 1707, "forms"),
    (1708, 1822, "forms"),
    (1823, 1936, "customizer"),
    (1937, 2201, "content-seeder"),
    (2202, 2236, "performance"),
    (2237, 2300, "performance"),
    (2301, 2371, "seo-schema"),
    (2372, 2426, "seo-schema"),
    (2427, 2451, "seo-schema"),
    (2452, 2497, "seo-schema"),
    (2498, 2594, "metaboxes"),
    (2595, 2634, "post-types"),
    (2635, 2781, "metaboxes"),
    (2782, 2862, "content-seeder"),
    (2863, 3357, "metaboxes"),
    (3358, 3591, "content-seeder"),
]

MODULES = {
    "setup": ("Theme Setup",
              "Theme supports, nav menus, page-template routing, upload mimes,\n * image size defaults, XML-RPC hardening, and security headers."),
    "performance": ("Performance",
                    "Asset loading and cache tuning: emoji/oEmbed removal, script and\n * style optimization, LiteSpeed UCSS whitelist, and auto cache purge."),
    "seo-schema": ("SEO & Structured Data",
                   "Title tags, meta, legacy redirects, analytics, and every JSON-LD\n * schema block (business, FAQ, reviews, articles, breadcrumbs)."),
    "post-types": ("Custom Post Types",
                   "Service, team member, product, and before/after post types plus\n * archive tweaks and rewrite flushing."),
    "metaboxes": ("Admin Meta Boxes",
                  "Editing UI for custom post types: team/product fields, service\n * sections editor, bottom photo, and before/after image pickers."),
    "forms": ("Forms & Email",
              "Contact and newsletter AJAX handlers, notification email template,\n * subscriber list page, and the LIVIA settings screen."),
    "customizer": ("Customizer",
                   "Deal popup controls (enable, copy, image, delay, frequency)."),
    "content-seeder": ("Content Seeding & Migration",
                       "One-time creation of pages, starter posts, services, and gallery\n * items, the demo importer, and the service data migrator."),
}

LOAD_ORDER = ["setup", "performance", "seo-schema", "post-types",
              "metaboxes", "forms", "customizer", "content-seeder"]


def main():
    with io.open(SRC, "r", encoding="utf-8", newline="") as f:
        lines = f.read().split("\n")

    total = len(lines)
    print(f"{SRC}: {total} lines")

    # Validate tiling
    expect = 7
    for start, end, _mod in SEGMENTS:
        if start != expect:
            sys.exit(f"GAP/OVERLAP: expected segment to start at {expect}, got {start}")
        if end < start:
            sys.exit(f"BAD SEGMENT: {start}-{end}")
        expect = end + 1
    if expect < total - 1:
        sys.exit(f"UNCOVERED TAIL: segments end at {expect - 1}, file has {total} lines")

    # Group content per module, preserving original order
    content = {m: [] for m in MODULES}
    for start, end, mod in SEGMENTS:
        chunk = lines[start - 1:end]
        first = next((l for l in chunk if l.strip()), "")
        print(f"  {start:>5}-{end:>5} -> {mod:<14} | {first.strip()[:70]}")
        content[mod].append("\n".join(chunk).strip("\n"))

    os.makedirs(OUT_DIR, exist_ok=True)
    for mod in LOAD_ORDER:
        title, desc = MODULES[mod]
        body = "\n\n".join(content[mod])
        out = (f"<?php\n/**\n * LIVIA Med Spa — {title}\n * {desc}\n *\n"
               f" * Split out of functions.php; load order is defined there.\n */\n\n"
               f"{body}\n")
        path = os.path.join(OUT_DIR, f"{mod}.php")
        with io.open(path, "w", encoding="utf-8", newline="\n") as f:
            f.write(out)
        print(f"wrote {path}: {out.count(chr(10))} lines")

    loader = """<?php
/**
 * LIVIA Med Spa — Theme Functions
 * Performance-optimized build
 *
 * This file only loads the theme's modules. Each area of functionality
 * lives in its own file under /inc:
 *   setup.php          — theme supports, menus, templates, security basics
 *   performance.php    — asset loading, cache tuning, LiteSpeed integration
 *   seo-schema.php     — titles, meta, JSON-LD structured data, redirects
 *   post-types.php     — service / team / product / before-after CPTs
 *   metaboxes.php      — admin editing UI for the custom post types
 *   forms.php          — contact + newsletter AJAX handlers, email template
 *   customizer.php     — deal popup customizer settings
 *   content-seeder.php — one-time page/post/service creation + demo import
 */

foreach ( [
    'setup',
    'performance',
    'seo-schema',
    'post-types',
    'metaboxes',
    'forms',
    'customizer',
    'content-seeder',
] as $livia_module ) {
    require_once get_template_directory() . '/inc/' . $livia_module . '.php';
}
unset( $livia_module );
"""
    with io.open("functions_new.php", "w", encoding="utf-8", newline="\n") as f:
        f.write(loader)
    print("wrote functions_new.php")


if __name__ == "__main__":
    main()
