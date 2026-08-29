#!/usr/bin/env bash
#
# Bootstrap a local WordPress dev environment for the Keystone Homes theme.
#
# Stands up a throwaway WordPress install (SQLite, no MySQL required) OUTSIDE
# the repo, symlinks this theme into it, seeds concept pages + blog posts,
# and builds assets.
#
# Idempotent: re-running skips work that is already done.
#
# Prerequisites:
#   - PHP 8.3+ with mbstring, xml, curl, zip, gd, intl, sqlite3, bcmath
#   - Composer 2
#   - WP-CLI (`wp`)
#   - Node 20+/22+ and npm
#
# Usage:
#   bin/setup-wp.sh
#   WP_PATH=/custom/path bin/setup-wp.sh
#
set -euo pipefail

THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_PATH="${WP_PATH:-$HOME/wp}"
SITE_URL="${SITE_URL:-http://localhost:8080}"
THEME_SLUG="keystone-homes"
WP="wp --path=$WP_PATH --allow-root"

echo "==> Theme dir : $THEME_DIR"
echo "==> WP path   : $WP_PATH"
echo "==> Site URL  : $SITE_URL"

echo "==> Installing theme dependencies (composer + npm) and building assets"
( cd "$THEME_DIR" && composer install --no-interaction --no-progress )
( cd "$THEME_DIR" && npm install && npm run build )

if [ ! -f "$WP_PATH/wp-load.php" ]; then
  echo "==> Downloading WordPress core"
  mkdir -p "$WP_PATH"
  $WP core download
else
  echo "==> WordPress core already present"
fi

if [ ! -f "$WP_PATH/wp-config.php" ]; then
  echo "==> Creating wp-config.php"
  $WP config create --dbname=wp --dbuser=root --dbpass=root --dbhost=localhost --skip-check
  $WP config set WP_DEBUG true --raw --type=constant
fi

if [ ! -d "$WP_PATH/wp-content/plugins/sqlite-database-integration" ]; then
  echo "==> Installing SQLite Database Integration plugin"
  curl -sL -o /tmp/sqlite.zip https://downloads.wordpress.org/plugin/sqlite-database-integration.latest-stable.zip
  unzip -q -o /tmp/sqlite.zip -d "$WP_PATH/wp-content/plugins"
  rm -f /tmp/sqlite.zip
fi

if [ ! -f "$WP_PATH/wp-content/db.php" ]; then
  echo "==> Installing SQLite db.php drop-in"
  cp "$WP_PATH/wp-content/plugins/sqlite-database-integration/db.copy" "$WP_PATH/wp-content/db.php"
  sed -i "s|{SQLITE_IMPLEMENTATION_FOLDER_PATH}|/wp-content/plugins/sqlite-database-integration|g" "$WP_PATH/wp-content/db.php"
  sed -i "s|{SQLITE_PLUGIN}|sqlite-database-integration/load.php|g" "$WP_PATH/wp-content/db.php"
fi

if ! $WP core is-installed 2>/dev/null; then
  echo "==> Installing WordPress"
  $WP core install \
    --url="$SITE_URL" \
    --title="Keystone Homes & Land" \
    --admin_user=admin \
    --admin_password=admin123 \
    --admin_email=admin@keystone-concept.test \
    --skip-email
  $WP rewrite structure '/%postname%/' --hard
fi

ln -sfn "$THEME_DIR" "$WP_PATH/wp-content/themes/$THEME_SLUG"
$WP theme activate "$THEME_SLUG"

seed_page() {
  local title="$1" slug="$2"
  if ! $WP post list --post_type=page --name="$slug" --field=ID 2>/dev/null | grep -q .; then
    $WP post create --post_type=page --post_status=publish --post_title="$title" --post_name="$slug" >/dev/null
    echo "==> Created page /$slug"
  fi
}

seed_page "Home" "home"
seed_page "Listings" "listings"
seed_page "Areas" "areas"
seed_page "Guide" "guide"
seed_page "Agents" "agents"
seed_page "Contact" "contact"
seed_page "Blog" "blog"

HOME_ID="$($WP post list --post_type=page --name=home --field=ID --format=ids | awk '{print $1}')"
BLOG_ID="$($WP post list --post_type=page --name=blog --field=ID --format=ids | awk '{print $1}')"
$WP option update show_on_front page >/dev/null
$WP option update page_on_front "$HOME_ID" >/dev/null
$WP option update page_for_posts "$BLOG_ID" >/dev/null

seed_post() {
  local slug="$1" title="$2" excerpt="$3" file="$4"
  if $WP post list --post_type=post --name="$slug" --field=ID 2>/dev/null | grep -q .; then
    return
  fi
  local content
  content="$(python3 - <<PY
from pathlib import Path
import re
html = Path("$file").read_text()
m = re.search(r'<div class="post-body">(.*?)</div>', html, re.S)
print(m.group(1).strip() if m else html)
PY
)"
  $WP post create \
    --post_type=post \
    --post_status=publish \
    --post_title="$title" \
    --post_name="$slug" \
    --post_excerpt="$excerpt" \
    --post_content="$content" >/dev/null
  echo "==> Created post /$slug"
}

SEED="$THEME_DIR/resources/seed"
if [ -d "$SEED" ]; then
  seed_post "book-a-home-showing" \
    "How to book a home showing" \
    "A step-by-step demo of the appointment flow buyers expect on modern listing sites." \
    "$SEED/book-a-home-showing.html"
  seed_post "first-time-buyer-checklist" \
    "First-time buyer checklist" \
    "Scannable list covering pre-approval, tour questions, inspections and offer timing." \
    "$SEED/first-time-buyer-checklist.html"
  seed_post "land-vs-home-search" \
    "Land vs home search" \
    "What to filter first when shoppers are comparing acreage parcels with turnkey houses." \
    "$SEED/land-vs-home-search.html"
fi

ensure_term() {
  local name="$1" slug="$2"
  if ! $WP term get category "$slug" --by=slug --field=term_id >/dev/null 2>&1; then
    $WP term create category "$name" --slug="$slug" >/dev/null
  fi
}
ensure_term "Showings" "showings"
ensure_term "Buyers" "buyers"
ensure_term "Search" "search"

assign_cat() {
  local slug="$1" cat="$2"
  local id
  id="$($WP post list --post_type=post --name="$slug" --field=ID --format=ids | awk '{print $1}')"
  if [ -n "$id" ]; then
    $WP post term set "$id" category "$cat" --by=slug >/dev/null
  fi
}
assign_cat "book-a-home-showing" "showings"
assign_cat "first-time-buyer-checklist" "buyers"
assign_cat "land-vs-home-search" "search"

hello_id="$($WP post list --post_type=post --name=hello-world --field=ID --format=ids | awk '{print $1}')"
if [ -n "$hello_id" ]; then
  $WP post delete "$hello_id" --force >/dev/null
  echo "==> Removed default Hello world! post"
fi

$WP acorn optimize:clear >/dev/null 2>&1 || true

echo ""
echo "==> Done. Start the dev server with:"
echo "    wp server --path=$WP_PATH --host=0.0.0.0 --port=8080 --allow-root"
echo "    (admin: $SITE_URL/wp-admin  user: admin  pass: admin123)"
