#!/usr/bin/env bash
#
# Envato / own-site pack: theme + child + Keystone Core + docs.
# The theme zip itself stays plugin-free (WP.org rule).
#
# Usage:
#   bin/build-marketplace-pack.sh
#
set -euo pipefail

THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
OUT_DIR="${OUT:-$THEME_DIR/dist-marketplace}"
STAGE="$(mktemp -d)"

cleanup() { rm -rf "$STAGE"; }
trap cleanup EXIT

echo "==> Theme zip"
( cd "$THEME_DIR" && bin/build-theme-zip.sh )
THEME_ZIP="$THEME_DIR/dist-theme/keystone-homes.zip"
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

echo "==> Assembling pack"
rm -rf "$OUT_DIR"
mkdir -p "$OUT_DIR/Documentation" "$OUT_DIR/Demos" "$OUT_DIR/Licensing"
cp -a "$THEME_ZIP" "$OUT_DIR/keystone-homes.zip"
cp -a "$STAGE/keystone-homes-child.zip" "$OUT_DIR/"
cp -a "$STAGE/keystone-core.zip" "$OUT_DIR/"
cp -a "$THEME_DIR/docs/marketplace/buyer-guide.html" "$OUT_DIR/Documentation/"
cp -a "$THEME_DIR/docs/marketplace/support.html" "$OUT_DIR/Documentation/"
cp -a "$THEME_DIR/SUPPORT.md" "$OUT_DIR/Documentation/"
cp -a "$THEME_DIR/docs/marketplace/SELLING.md" "$OUT_DIR/Documentation/"
cp -a "$THEME_DIR/docs/marketplace/Demos/README.txt" "$OUT_DIR/Demos/"
cp -a "$THEME_DIR/CREDITS.md" "$OUT_DIR/Licensing/"
cp -a "$THEME_DIR/LICENSE.md" "$OUT_DIR/Licensing/" 2>/dev/null || true
cp -a "$THEME_DIR/readme.txt" "$OUT_DIR/Documentation/"

# Optional WXR if a local WP export exists
if [ -d "$HOME/wp" ] && command -v wp >/dev/null 2>&1; then
  echo "==> Exporting WXR from local WP (if available)"
  wp export --path="$HOME/wp" --dir="$OUT_DIR/Demos" --allow-root 2>/dev/null || true
fi

echo "==> Pack ready: $OUT_DIR"
find "$OUT_DIR" -type f | sort
