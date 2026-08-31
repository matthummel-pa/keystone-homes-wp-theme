# Selling Keystone (for Matt)

This is the seller brief — not buyer docs. Buyer HTML is `buyer-guide.html`.

## What actually sells

Realtor themes on Envato move when the demo looks like a working office: search → listings → agent → book a showing. You already have that. Buyers pay for **identity Customizer, menus, a child theme, and a plugin that keeps listings after they switch themes** — not for another “luxury brokerage” skin.

Price band for a niche land/farms theme: **$39–$69** on ThemeForest, **$49–$79** on your own checkout (Gumroad / Lemon Squeezy). Keep the own-site price higher; Envato takes a large cut.

## Channel by channel

| Channel | Ship | Do not claim |
| --- | --- | --- |
| **Own site** | Full pack from `bin/build-marketplace-pack.sh` | Nothing. Best margin. |
| **ThemeForest / Creative Market** | Same pack + live preview URL | “#1 realtor theme.” Show the Adams County concept honestly. |
| **WordPress.org** | Theme zip only. No plugin inside the theme. CPTs off (`KS_DISABLE_THEME_CPTS`). `readme.txt` + 1200×900 screenshot | “Approved” or “in the picker” until a reviewer says so. Sage + Acorn + Gutenberg-off is a common rejection. Use WP.org later as a **lite** traffic listing, or list **Keystone Core** as a free plugin and sell setup. |

WordPress.org is **not** a cash register. It is distribution. Money there is services (install, copy, listing import) or a paid add-on — never an in-theme upgrade nag.

## Pack

```bash
bin/build-marketplace-pack.sh
```

Creates `dist-marketplace/`:

- `keystone-homes.zip` — installable theme
- `keystone-homes-child.zip`
- `keystone-core.zip`
- `Documentation/buyer-guide.html`
- `Demos/README.txt`
- `Licensing/CREDITS.md`

Upload the **pack** to Envato (“All files & documentation”). Upload **only** `keystone-homes.zip` if you try WordPress.org.

## Before you submit anywhere

1. Live preview with demo chrome **on** (concept honesty) and a second screenshot with chrome **off** (buyer fantasy).
2. Customize → Identity filled with 555 / `@keystone-concept.test` only.
3. No Unsplash files inside the theme zip.
4. No Freemius, Envato banners, or “Pro” admin ads.
5. Footer credit is optional and `rel="nofollow"`.
6. Theme Check on a stock WP install (warnings on Sage/vendor are expected — document them).

## WP.org remaining blockers (do not paper over)

- Sage / Blade / `vendor` (Acorn) is not what the Themes Team usually ships
- Block editor is disabled on purpose (project rule)
- PHP 8.3+ and a compiled Vite manifest
- Listings are plugin territory — Core must be a **separate** WP.org plugin if you go that route

A future “Keystone Lite” without Acorn would have a real shot at the picker. This repo is the premium / Envato / own-site product.

## After a sale

Buyer path is Appearance → Keystone Setup. Do not add a license server unless a marketplace requires it. Envato purchase codes are their problem, not a theme options lock.
