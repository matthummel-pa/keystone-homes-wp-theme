# Acreline — WordPress theme for farms, land, and historic homes

**Acreline** is a WordPress real estate theme for rural offices: searchable listings, agents, and showing requests — built for land, farms, and older houses, not a generic luxury brokerage skin.

It is meant to **set up with almost no plugins**. The theme zip alone runs the office: identity, colors, menus, listings, agents, and showing requests. You do **not** need Advanced Custom Fields, Elementor, a Gutenberg kit, or an IDX plugin. Copy and inventory live in **Customizer + custom-field metaboxes**, so you change headlines, prices, and photos without touching Blade or CSS.

The sample office in the preview is named **Acreline**. Change the brand, phone, email, and colors in **Appearance → Customize → Identity**. Brand kit: [`BRAND.md`](BRAND.md). Created by [Matt Hummel](https://matthummel.com/).

| | |
| --- | --- |
| **Live demo** | [keystonehomes.ridgesandvalleys.com](https://keystonehomes.ridgesandvalleys.com/) |
| **Product landing** | [matthummel.com/concept/acreline/](https://matthummel.com/concept/acreline/) |
| **Buy / checkout** | [matthummel.com/product/acreline/](https://matthummel.com/product/acreline/) |
| **GitHub** | [`matthummel-pa/wp-acreline`](https://github.com/matthummel-pa/wp-acreline) |
| **Brand kit** | [`BRAND.md`](BRAND.md) · [branding.html](docs/marketplace/branding.html) |
| **Support** | [SUPPORT.md](SUPPORT.md) |
| **Author** | [matthummel.com](https://matthummel.com/) |
| **Install folder** | **`acreline`** (leave this name — Vite asset URLs depend on it) |

> **Fiction only.** Listings, market stats, contact details, and appointments are sample / demo data. Not a live MLS, licensed brokerage, or booking system. Demo phones use the `555` exchange; emails use `@acreline-concept.test`.

## Brand (Acreline)

| | |
| --- | --- |
| **Name** | Acreline |
| **Tagline** | Farms · land · historic homes |
| **Mark** | [`public/images/brand/acreline-mark.svg`](public/images/brand/acreline-mark.svg) |
| **Lockup** | [`public/images/brand/acreline-lockup.svg`](public/images/brand/acreline-lockup.svg) |
| **Forest accent** | `#1f6b4a` on paper `#f5f4f1`, ink `#141210` |

Retired **Keystone** naming is stripped by `Identity::isRetiredBrand()` so old Customizer/seed strings fall back to Acreline. Full kit: [`BRAND.md`](BRAND.md).

Ported from the static concept: [live HTML demo](https://matthummel-pa.github.io/realtor-keystone-homes-and-land-theme/) · [source](https://github.com/matthummel-pa/realtor-keystone-homes-and-land-theme/).

Sage 11 stack: Blade, Tailwind CSS v4, Vite 8, Acorn. Classic (non-block) editor. Not Gutenberg-optimized, not Elementor, not an IDX/MLS feed.

## Little plugin stack

| Need | What you install |
| --- | --- |
| Public site | **Theme zip only.** Listings, agents, and bookings still register in the theme so the concept demo works. |
| Listings that survive a theme switch | Optional **Acreline Core** (`acreline-core.zip`) — the store-correct home for those post types |
| CSS that survives parent updates | Optional **Acreline Child** (`acreline-child.zip`) |
| SEO plugin | Optional. Native title / description / OG / Twitter are already in the theme. If Yoast, Rank Math, SEOPress, or AIOSEO is active, native tags **yield** |

Do **not** add ACF, a page builder, or an MLS plugin “to make the fields work.” The fields are already there.

## Custom fields — do not edit the design to change copy

Layout stays in Blade (`resources/views/`). Tokens stay in `resources/css/keystone.css`. Card chrome is locked in `resources/css/card-lock.css`. For day-to-day office copy:

| What to change | Where |
| --- | --- |
| Brand, phone, email, address, hours, header button, demo banner, author credit | **Customize → Identity** |
| Color style (Forest, Clay, Navy, …), accent, paper, ink | **Customize → Colors** |
| Header sticky / compact | **Customize → Header** |
| Logo | **Customize → Site Identity** |
| Nav | **Appearance → Menus** (Primary + Footer) |
| Page headlines, leads, CTAs | The page’s **Page fields** metabox (not the block editor) |
| Listing price, acres, beds, township, gallery | The listing’s **Listing details** metabox |
| Agent bio, license, specialties | The agent’s **Agent details** metabox |
| Blog kicker / SEO fallback | The post’s **Post fields** metabox |

Editing a theme file does **not** change live posts. Re-seed only when you want the sample inventory reset (`Tools → Seed Acreline demo`).

## Install from a marketplace zip

Theme shop and own-site buyers: **do not clone this repo onto the host.** The store pack is already built. The host needs WordPress 6.6+ and PHP 8.3+ — not Composer or npm.

1. Extract the outer `acreline-*.zip`. Do not upload that outer file in wp-admin.
2. **Appearance → Themes → Add New → Upload Theme** → inner **`acreline.zip`**. Activate Acreline. The folder must stay **`acreline`**.
3. **Appearance → Customize → Identity** for brand, phone, email, address, hours, and the header button. Upload a logo under Site Identity.
4. Optional: upload `acreline-child.zip`, then `acreline-core.zip`.
5. **Appearance → Acreline Setup** for the checklist. **Tools → Seed Acreline demo** if you want the preview pages and sample inventory.

Walkthrough, branding, sources, changelog, and ThemeForest form fields: open [`docs/marketplace/index.html`](docs/marketplace/index.html). Paste-ready store listing: [`docs/marketplace/themeforest-listing.md`](docs/marketplace/themeforest-listing.md). WordPress.org-style parser file: [`readme.txt`](readme.txt). WP.org upload notes: [`docs/marketplace/wordpress-org.md`](docs/marketplace/wordpress-org.md).

## Who it is for

Realtors and marketers who sell **acreage, working farms, and historic homes** and want a classic WordPress site: search the inventory, open a listing, meet an agent, request a showing. Buyers set office identity from the Customizer. Developers who already like [Sage 11](https://roots.io/sage/) can drop it into [Bedrock](https://roots.io/bedrock/) `web/app/themes/` or a classic `wp-content/themes/` install.

## What you get

- Homepage search → listings with type, price, acreage, and area filters
- Grid and map views from the Listings custom post type; payment-estimate modal
- Showing requests write Booking posts (Requested → Confirmed → Completed)
- Agents page and singles (license, MLS/NRDS, specialties, contact)
- Areas, land-buyer guide, contact, and blog templates
- Customizer identity: brand, phone, email, address, hours, header button, removable author credit
- Eight color styles (Forest, Clay, Navy, Burgundy, Harvest, Lake, Orchard, Charcoal) plus accent, paper, and ink
- Header size and sticky toggle; Inter-based typography
- WordPress Primary + Footer menus, custom logo, footer widgets, breadcrumbs
- Native title, description, Open Graph, and Twitter tags (yields to Yoast / Rank Math / SEOPress / AIOSEO)
- Translation-ready `acreline` text domain
- Demo **Colors** switcher on the concept preview (mid-right). Buyers set a style in Customizer; the floating control is demo chrome only

## Documentation (keep this map)

| File | Who it is for | Ships in |
| --- | --- | --- |
| **This README.md** | You, GitHub, Sage developers | Git only |
| [`readme.txt`](readme.txt) | WordPress / ThemeForest parser | Theme zip |
| [`SUPPORT.md`](SUPPORT.md) | Support links | Seller pack `Documentation/` |
| [`CHANGELOG.md`](CHANGELOG.md) | User-facing history | Theme zip |
| [`CREDITS.md`](CREDITS.md) / [`LICENSE.md`](LICENSE.md) | Fonts, GPL | Theme zip + pack `Licensing/` |
| [`docs/marketplace/index.html`](docs/marketplace/index.html) | ThemeForest docs hub (start here) | Pack `Documentation/` |
| [`docs/marketplace/buyer-guide.html`](docs/marketplace/buyer-guide.html) | Buyer install, Customizer, fields, FAQ | Pack `Documentation/` |
| [`BRAND.md`](BRAND.md) | Product brand kit (name, palette, marks) | Git + seller pack |
| [`docs/marketplace/branding.html`](docs/marketplace/branding.html) | Logos, Forest palette, fair housing | Pack `Documentation/` |
| [`docs/marketplace/requirements.html`](docs/marketplace/requirements.html) | Host needs + store listing fields to paste | Pack `Documentation/` |
| [`docs/marketplace/support.html`](docs/marketplace/support.html) | Buyer help | Pack `Documentation/` |
| [`docs/marketplace/sources.html`](docs/marketplace/sources.html) | Fonts, Sage, SVG marks, what is not bundled | Pack `Documentation/` |
| [`docs/marketplace/changelog.html`](docs/marketplace/changelog.html) | User-facing history | Pack `Documentation/` |
| [`docs/marketplace/customizer.html`](docs/marketplace/customizer.html) | Customizer field map | Pack `Documentation/` |
| [`docs/marketplace/listings.html`](docs/marketplace/listings.html) | Listings, agents, bookings | Pack `Documentation/` |
| [`docs/marketplace/screenshots/`](docs/marketplace/screenshots/) | Extra item images (homepage → book) | Pack `Documentation/screenshots/` |
| [`docs/marketplace/themeforest-listing.md`](docs/marketplace/themeforest-listing.md) | **You only** — paste-ready store copy | Git only |
| [`docs/marketplace/wordpress-org.md`](docs/marketplace/wordpress-org.md) | **You only** — WP.org upload + Theme Check | Git only |
| [`docs/marketplace/SELLING.md`](docs/marketplace/SELLING.md) | **You only** — channels, price band, WP.org limits | Repo + `dist-marketplace/`, **not** the buyer zip |
| [`license.txt`](license.txt) | GPLv2 (Theme Check) | Theme zip + pack `Licensing/` |
| [`AGENTS.md`](AGENTS.md) | Cursor / local VM | Git only |
| [`.cursor/rules/`](.cursor/rules/) | Agent rules (`.mdc`) | Git only |

Do not paste `SELLING.md` into a ThemeForest zip. Do not tell a shop buyer to `composer install` on the host.

## Notes for future theme updates (Matt)

Theme files and WordPress **content** are separate. Merging to `main` does **not** rewrite live pages, listings, or uploads. CI does **not** FTP to the host.

1. Bump **Version** in `style.css`, **Stable tag** in `readme.txt`, and a short user-facing note in `CHANGELOG.md` / `readme.txt` changelog together. Do not ship a zip whose versions disagree.
2. Leave the install folder, text domain, and Vite `base` as **`acreline`**. Leave `ks_*` post meta and the `keystone/v1` REST namespace — renaming them blanks live posts.
3. GitHub repo for the updater is **`matthummel-pa/wp-acreline`** (not `acreline-wp-theme`, not `keystone-homes-wp-theme`). Fine-grained PAT: **Contents: Read** to install the zip. Add **Actions: Read and write** only to trigger **Rebuild zip on GitHub**.
4. Merge to `main`. Wait for Actions **Deploy theme zip**. Assets: [acreline.zip](https://github.com/matthummel-pa/wp-acreline/releases/download/theme-latest/acreline.zip) and `acreline-<version>.zip` on the `theme-latest` release.
5. Host: **Appearance → Update Theme → Install latest zip from GitHub**. Theme files only. If that screen 404s, the running PHP still has the old repo slug — upload inner `acreline.zip` once, then the updater works.
6. After Blade edits locally: `wp acorn view:clear --path="$HOME/wp" --allow-root`. After CSS/JS: `npm run build` (or `npm run dev`). Missing `public/build/manifest.json` whitescreens every page.
7. Do not delete `resources/css/card-lock.css`. Do not enable the block editor to “pass” a shop checklist. Keep 555 phones and `@acreline-concept.test` in sample copy.
8. Live demo cache (nginx `x-proxy-cache`) can keep an old `/`. Check `/?fresh=1` or purge Site Tools → Speed → Caching. `wp cache purge` is only the object cache.

Token lives in Customizer → GitHub, the Update Theme screen, or `KS_GITHUB_TOKEN` — never in this repo.

## Local development (this git repo)

This repository is Sage **source**. `vendor/` and `public/build/` are not committed. After a clone you must build assets before any page will load.

```bash
bin/setup-wp.sh
wp server --path="$HOME/wp" --host=0.0.0.0 --port=8080 --allow-root
```

Admin: `http://localhost:8080/wp-admin` — user `admin`, password `admin123`.

A fresh install seeds demo pages, eight listings, three agents, and sample blog posts on the first public request. Re-run from **Tools → Seed Acreline demo** or:

```bash
wp ks seed --path="$HOME/wp" --allow-root
```

```bash
npm run build          # required before first page load
npm run dev            # Vite HMR alongside wp server
./vendor/bin/pint      # PHP style
```

If the theme folder is not `acreline`, update `base` in `vite.config.js` and rebuild.

**Do not symlink `vendor/` from another worktree.** Composer maps `App\` to that tree’s `app/`; Blade loads from this folder. A mismatch 500s the homepage.

## Package for a host or a marketplace

```bash
bin/build-theme-zip.sh            # -> dist-theme/acreline.zip (WP upload)
bin/build-install-pack.sh         # -> dist-install/acreline-<version>.zip (seller pack)
bin/build-marketplace-pack.sh     # same pack, plus SELLING.md for you
```

**Regular WordPress install:** extract `acreline-*.zip`, then **Appearance → Themes → Upload Theme** and choose the inner `acreline.zip`.

Theme-only install (no child / plugin / docs):

```bash
wp theme install dist-theme/acreline.zip --activate
```

## Update from GitHub

CI publishes a built zip on the `theme-latest` release. WordPress installs it over HTTPS (same pattern as [matthummel-theme](https://github.com/matthummel-pa/matthummel-theme)).

1. Push `main` (or use **Appearance → Update Theme → Rebuild zip on GitHub**) so Actions builds `acreline.zip`.
2. In wp-admin go to **Appearance → Update Theme**.
3. Paste a fine-grained PAT with **Contents: Read** (add **Actions: Read and write** only to trigger rebuilds). Or set `KS_GITHUB_TOKEN` / `MH_GITHUB_TOKEN` in `wp-config.php`, or **Appearance → Customize → GitHub**.
4. Click **Install latest zip from GitHub**. Theme files only — pages, posts, and uploads stay put.

CLI: `wp ks theme-update` and `wp ks theme-build`.

## Theme templates

| Concept page | WordPress template |
| --- | --- |
| Home | `front-page.blade.php` (template: Home) |
| Listings | `page-listings.blade.php` |
| Book a showing | `page-book.blade.php` |
| Areas | `page-areas.blade.php` |
| Guide | `page-guide.blade.php` |
| Agents | `page-agents.blade.php` |
| Contact | `page-contact.blade.php` |
| Blog | `home.blade.php` |
| Listing / agent singles | `single-listing.blade.php`, `single-agent.blade.php` |
| Posts | `single.blade.php` |

Design tokens and layout CSS live in `resources/css/keystone.css`. Card chrome is locked in `resources/css/card-lock.css`. Interactive tools live in `resources/js/`.

## License

GPLv2 or later. See `license.txt`, `LICENSE.md`, and `CREDITS.md`. Sage / Acorn remain MIT.
