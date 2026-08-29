# Keystone Homes & Land — WordPress Theme

A [Roots Sage 11](https://roots.io/sage/) theme (Blade + Tailwind CSS v4 + Vite 8, powered by Acorn) for a land-and-farms realtor concept. The visual design is ported from the static concept in [`matthummel-pa/realtor-keystone-homes-and-land-theme`](https://github.com/matthummel-pa/realtor-keystone-homes-and-land-theme).

## Cursor Cloud specific instructions

### What this repo is
This repository is only the **theme** (`wp-content/themes/keystone-homes`). WordPress core is not part of the repo — a throwaway local WordPress install is created outside the repo to run/test the theme.

### System prerequisites (installed during initial VM setup)
PHP 8.3+ (with `mbstring xml curl zip gd intl sqlite3 bcmath`), Composer 2, WP-CLI (`wp`), and Node 20+/22+. The startup update script only refreshes the theme's own dependencies (`composer install`, `npm install`); it intentionally does **not** install system packages, build assets, or start services.

### First-time run in a fresh clone
Run the bootstrap helper — it is idempotent and safe to re-run:

```bash
bin/setup-wp.sh
```

This installs theme deps + builds assets, then stands up WordPress at `~/wp` using the **SQLite Database Integration** plugin (no MySQL needed), symlinks the theme in, seeds concept pages and sample blog posts, and activates the theme. Admin: `/wp-admin` (user `admin`, pass `admin123`).

### Running the site
```bash
wp server --path="$HOME/wp" --host=0.0.0.0 --port=8080 --allow-root
```
Then browse `http://localhost:8080/` (homepage), `/listings`, `/areas`, `/guide`, `/agents`, `/contact`, and `/blog`.

### Build / lint / dev
- Build assets (required — Vite generates the manifest the theme loads): `npm run build`
- Hot-reload dev server for assets: `npm run dev` (in addition to `wp server`)
- PHP lint (Laravel Pint): `./vendor/bin/pint --test` (drop `--test` to auto-fix)

### Non-obvious gotchas
- **You must build assets** (`npm run build`) or every page dies with a "Vite manifest not found" error. Build artifacts live in `public/build/` and are git-ignored.
- **Blade template changes are cached by Acorn.** After editing `.blade.php` files, if you don't see changes, clear the cache: `wp acorn view:clear --path="$HOME/wp" --allow-root` (or `wp acorn optimize:clear`).
- **Vite `base` path is hard-coded** in `vite.config.js` to `/wp-content/themes/keystone-homes/public/build/`. If the theme is installed under a different folder name, update it or built asset URLs will 404.
- Concept pages are **slug-based Blade templates**: `front-page.blade.php` plus `page-listings`, `page-areas`, `page-guide`, `page-agents`, `page-contact`. Those only take effect if a published Page with that slug exists (`bin/setup-wp.sh` creates them). Shared chrome lives in `resources/views/sections/` and `partials/chat.blade.php`.
- Homepage search, showing booking, value estimate, listing alerts, listing filters/map, and guide calculators are client-side demos. They do not email, calendar, or hit an MLS.
- Listing inventory lives in `resources/js/listings.js` as sample data.

### Packaging & deploying the theme
- This is a WordPress theme — it ships as an installable theme package to a WordPress host.
- Build the installable zip with `bin/build-theme-zip.sh` → `dist-theme/keystone-homes.zip`. The script ships the compiled `public/build` assets and a production (`--no-dev`) `vendor/` so the target host needs no composer/npm. Install via WP Admin → Appearance → Themes → Add New → Upload Theme, or `wp theme install dist-theme/keystone-homes.zip --activate`.
