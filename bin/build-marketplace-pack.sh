#!/usr/bin/env bash
#
# Envato / own-site pack. Delegates to the general install pack
# (bin/build-install-pack.sh) so ThemeForest and “regular upload”
# buyers get the same zip. Seller brief stays in the repo only.
#
# Usage:
#   bin/build-marketplace-pack.sh
#
set -euo pipefail

THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
INSTALL_OUT="${THEME_DIR}/dist-install"
MARKET_OUT="${OUT:-$THEME_DIR/dist-marketplace}"

echo "==> General install pack"
OUT="$INSTALL_OUT" "$THEME_DIR/bin/build-install-pack.sh"

echo "==> Copying to dist-marketplace (unzipped + seller brief)"
rm -rf "$MARKET_OUT"
mkdir -p "$MARKET_OUT"
cp -a "$INSTALL_OUT/acreline/." "$MARKET_OUT/"
cp -a "$THEME_DIR/docs/marketplace/SELLING.md" "$MARKET_OUT/SELLING.md"

# Mirror the seller-upload zip next to the unpacked tree
if ls "$INSTALL_OUT"/acreline-*.zip >/dev/null 2>&1; then
  cp -a "$INSTALL_OUT"/acreline-*.zip "$MARKET_OUT/"
  cp -a "$INSTALL_OUT/acreline.zip" "$MARKET_OUT/"
fi

echo "==> Marketplace folder ready: $MARKET_OUT"
find "$MARKET_OUT" -type f | sort
