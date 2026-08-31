#!/usr/bin/env bash
#
# General install pack for a regular WordPress host (Appearance → Upload Theme).
#
# Buyers extract this zip, then upload the inner keystone-homes.zip.
# Also ships child theme, Keystone Core, and seller/buyer requirements docs.
# Does not include the internal seller brief (SELLING.md).
#
# Usage:
#   bin/build-install-pack.sh
#   OUT=/tmp/acreline-pack bin/build-install-pack.sh
#
set -euo pipefail

THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
OUT_DIR="${OUT:-$THEME_DIR/dist-install}"
STAGE="$(mktemp -d)"
PACK_ROOT="$STAGE/acreline"

cleanup() { rm -rf "$STAGE"; }
trap cleanup EXIT

version_from_style() {
  sed -n 's/^[[:space:]]*Version:[[:space:]]*//p' "$THEME_DIR/style.css" | head -n1 | tr -d '[:space:]'
}

VERSION="$(version_from_style)"
if [ -z "$VERSION" ]; then
  echo "ERROR: could not read Version from style.css" >&2
  exit 1
fi

THEME_ZIP="$THEME_DIR/dist-theme/keystone-homes.zip"
if [ "${SKIP_THEME_BUILD:-}" = "1" ] && [ -f "$THEME_ZIP" ]; then
  echo "==> Reusing existing theme zip ($THEME_ZIP)"
else
  echo "==> Theme zip (regular WP upload)"
  ( cd "$THEME_DIR" && bin/build-theme-zip.sh )
fi
if [ ! -f "$THEME_ZIP" ]; then
  echo "ERROR: $THEME_ZIP missing" >&2
  exit 1
fi

echo "==> Child theme zip"
mkdir -p "$STAGE/keystone-homes-child"
cp -a "$THEME_DIR/child-theme/." "$STAGE/keystone-homes-child/"
( cd "$STAGE" && zip -rqX keystone-homes-child.zip keystone-homes-child -x '*.DS_Store' )

echo "==> Keystone Core zip"
mkdir -p "$STAGE/keystone-core"
cp -a "$THEME_DIR/plugins/keystone-core/." "$STAGE/keystone-core/"
( cd "$STAGE" && zip -rqX keystone-core.zip keystone-core -x '*.DS_Store' )

echo "==> Assembling acreline/ pack"
mkdir -p "$PACK_ROOT/Documentation" "$PACK_ROOT/Demos" "$PACK_ROOT/Licensing"
cp -a "$THEME_DIR/docs/marketplace/PACK-README.txt" "$PACK_ROOT/README.txt"
cp -a "$THEME_ZIP" "$PACK_ROOT/keystone-homes.zip"
cp -a "$STAGE/keystone-homes-child.zip" "$PACK_ROOT/"
cp -a "$STAGE/keystone-core.zip" "$PACK_ROOT/"
cp -a "$THEME_DIR/docs/marketplace/requirements.html" "$PACK_ROOT/Documentation/"
cp -a "$THEME_DIR/docs/marketplace/buyer-guide.html" "$PACK_ROOT/Documentation/"
cp -a "$THEME_DIR/docs/marketplace/support.html" "$PACK_ROOT/Documentation/"
cp -a "$THEME_DIR/SUPPORT.md" "$PACK_ROOT/Documentation/"
cp -a "$THEME_DIR/readme.txt" "$PACK_ROOT/Documentation/"
cp -a "$THEME_DIR/docs/marketplace/Demos/README.txt" "$PACK_ROOT/Demos/"
cp -a "$THEME_DIR/CREDITS.md" "$PACK_ROOT/Licensing/"
cp -a "$THEME_DIR/LICENSE.md" "$PACK_ROOT/Licensing/" 2>/dev/null || true

if [ -d "$HOME/wp" ] && command -v wp >/dev/null 2>&1; then
  echo "==> Exporting WXR from local WP (if available)"
  wp export --path="$HOME/wp" --dir="$PACK_ROOT/Demos" --allow-root 2>/dev/null || true
fi

echo "==> Writing pack zip"
rm -rf "$OUT_DIR"
mkdir -p "$OUT_DIR"
ZIP_VERSIONED="$OUT_DIR/acreline-$VERSION.zip"
ZIP_STABLE="$OUT_DIR/acreline.zip"
rm -f "$ZIP_VERSIONED" "$ZIP_STABLE"
( cd "$STAGE" && zip -rqX "$ZIP_VERSIONED" acreline -x '*.DS_Store' )
cp -a "$ZIP_VERSIONED" "$ZIP_STABLE"

# Unzipped tree for inspection (same files as inside the zip)
cp -a "$PACK_ROOT" "$OUT_DIR/acreline"

echo "==> Pack ready"
echo "    Regular WP upload:  acreline/keystone-homes.zip  (inside the pack)"
echo "    Seller upload:      $ZIP_VERSIONED"
echo "    Also copied as:     $ZIP_STABLE"
du -h "$ZIP_VERSIONED" "$PACK_ROOT/keystone-homes.zip" | sed 's/^/    /'
find "$OUT_DIR/acreline" -type f | sort
