# Acreline — WordPress theme for farms, land, and historic homes

**Acreline** is a WordPress real estate theme for rural offices: searchable listings, agents, and showing requests — built for land, farms, and older houses, not a generic luxury brokerage skin.

The sample office in the preview is named Acreline. Change the brand, phone, email, and colors in **Appearance → Customize → Identity**. Created by [Matt Hummel](https://matthummel.com/).

| | |
| --- | --- |
| **Live concept demo** | [keystonehomes.ridgesandvalleys.com](https://keystonehomes.ridgesandvalleys.com/) |
| **Support** | [SUPPORT.md](SUPPORT.md) |
| **Author** | [matthummel.com](https://matthummel.com/) |
| **Install folder** | `acreline` (leave this name — Vite asset URLs depend on it) |

> **Fiction only.** Listings, market stats, contact details, and appointments are sample / concept data. Not a live MLS, licensed brokerage, or booking system. Demo phones use the `555` exchange; emails use `@acreline-concept.test`.

Ported from the static concept: [live HTML demo](https://matthummel-pa.github.io/realtor-keystone-homes-and-land-theme/) · [source](https://github.com/matthummel-pa/realtor-keystone-homes-and-land-theme).

## Who it is for

Realtors and marketers who sell **acreage, working farms, and historic homes** and want a classic (non-block) WordPress site: search the inventory, open a listing, meet an agent, request a showing. Buyers set office identity from the Customizer. Developers who already like [Sage 11](https://roots.io/sage/) get Blade, Tailwind CSS v4, Vite 8, and Acorn.

It drops into a [Bedrock](https://roots.io/bedrock/) `web/app/themes/` directory or a classic `wp-content/themes/` install.

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

Listings, agents, and bookings are registered by **Acreline Core** (companion plugin) or in-theme as a fallback so this concept site keeps working without the plugin.

## Requirements

WordPress 6.6+, PHP 8.3+. Built assets (`npm run build`) must exist — the theme loads Vite’s manifest. The install folder must stay `acreline`.

## Local development

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

## Package for a host or a marketplace

```bash
bin/build-theme-zip.sh            # -> dist-theme/acreline.zip (WP upload)
bin/build-install-pack.sh         # -> dist-install/acreline-1.2.0.zip (seller pack)
bin/build-marketplace-pack.sh     # same pack, plus SELLING.md for you
```

**Regular WordPress install:** extract `acreline-*.zip`, then **Appearance → Themes → Upload Theme** and choose the inner `acreline.zip`. Do not upload the outer pack to WordPress.

Host needs and ThemeForest / own-site listing fields: [`docs/marketplace/requirements.html`](docs/marketplace/requirements.html). Buyer walkthrough: [`docs/marketplace/buyer-guide.html`](docs/marketplace/buyer-guide.html). Seller channels: [`docs/marketplace/SELLING.md`](docs/marketplace/SELLING.md). Support: [`SUPPORT.md`](SUPPORT.md).

Theme-only install (no child / plugin / docs):

```bash
wp theme install dist-theme/acreline.zip --activate
```

If the theme folder is not `acreline`, update `base` in `vite.config.js` and rebuild.

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

GPLv2 or later. See `LICENSE.md` and `CREDITS.md`.
