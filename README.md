# Keystone Homes & Land

Sage 11 WordPress theme for **Keystone Homes & Land** — a land-and-farms realtor concept by [Ridges & Valleys Studio](https://ridgesandvalleys.com).

Ported from the static concept:

- Live demo: https://matthummel-pa.github.io/realtor-keystone-homes-and-land-theme/
- Source: https://github.com/matthummel-pa/realtor-keystone-homes-and-land-theme

> **Fiction only.** Listings, market stats, contact details, and appointments are sample data. Not a live MLS, licensed brokerage, or booking system.

## Stack

- [Roots Sage 11](https://roots.io/sage/) — Blade, Tailwind CSS v4, Vite 8, Acorn
- Designed to drop into a [Bedrock](https://roots.io/bedrock/) `web/app/themes/` directory (or a classic `wp-content/themes/` install)

## Features

- Homepage search → listings with type / price / acreage / area filters
- Grid + map listing views, payment estimate modal, save-to-shortlist demo
- House-showing scheduler (property, date, time slots)
- Home-value range and listing-alert demos
- Areas, land-buyer guide, agents, and contact pages
- SEO-ready blog with sample posts

## Local development

```bash
bin/setup-wp.sh
wp server --path="$HOME/wp" --host=0.0.0.0 --port=8080 --allow-root
```

Admin: `http://localhost:8080/wp-admin` — user `admin`, password `admin123`.

```bash
npm run build          # required before first page load
npm run dev            # Vite HMR alongside wp server
./vendor/bin/pint      # PHP style
```

## Package for a host

```bash
bin/build-theme-zip.sh   # -> dist-theme/keystone-homes.zip
```

Install via WP Admin → Appearance → Themes → Upload Theme, or:

```bash
wp theme install dist-theme/keystone-homes.zip --activate
```

If the theme folder is not `keystone-homes`, update `base` in `vite.config.js` and rebuild.

## Theme templates

| Concept page | WordPress template |
| --- | --- |
| Home | `resources/views/front-page.blade.php` |
| Listings | `resources/views/page-listings.blade.php` |
| Areas | `resources/views/page-areas.blade.php` |
| Guide | `resources/views/page-guide.blade.php` |
| Agents | `resources/views/page-agents.blade.php` |
| Contact | `resources/views/page-contact.blade.php` |
| Blog | `resources/views/home.blade.php` |
| Posts | `resources/views/single.blade.php` |

Design tokens and layout CSS live in `resources/css/keystone.css`. Interactive tools live in `resources/js/`.
