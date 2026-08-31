# Selling Acreline (for Matt)

This is the seller brief — not buyer docs. Buyer HTML is `buyer-guide.html`.

## What actually sells

Realtor themes on Envato move when the demo looks like a working office: search → listings → agent → book a showing. You already have that. Buyers pay for **identity Customizer, menus, a child theme, and a plugin that keeps listings after they switch themes** — not for another “luxury brokerage” skin.

Price band for a niche land/farms theme: **$39–$69** on ThemeForest, **$49–$79** on your own checkout (Gumroad / Lemon Squeezy). Keep the own-site price higher; Envato takes a large cut.

## Channel by channel

| Channel | Ship | Do not claim |
| --- | --- | --- |
| **Own site** | Full pack from `bin/build-marketplace-pack.sh` | Nothing. Best margin. |
| **ThemeForest / Creative Market** | Same pack + live preview URL | “#1 realtor theme.” Show the sample-county land/farms concept honestly. |
| **WordPress.org** | Theme zip only. No plugin inside the theme. CPTs off (`KS_DISABLE_THEME_CPTS`). `readme.txt` + 1200×900 screenshot | “Approved” or “in the picker” until a reviewer says so. Sage + Acorn + Gutenberg-off is a common rejection. Use WP.org later as a **lite** traffic listing, or list **Acreline Core** as a free plugin and sell setup. |

WordPress.org is **not** a cash register. It is distribution. Money there is services (install, copy, listing import) or a paid add-on — never an in-theme upgrade nag.

## Pack

```bash
bin/build-install-pack.sh         # general seller zip
bin/build-marketplace-pack.sh     # same files + this brief copied beside them
```

Creates `dist-install/`:

- `acreline-1.2.0.zip` — **upload this to ThemeForest / Gumroad** (folder inside: `acreline-pack/`)
- `acreline-pack/acreline.zip` — what the buyer uploads in Appearance → Themes
- `acreline-pack/acreline-child.zip`
- `acreline-pack/acreline-core.zip`
- `acreline-pack/Documentation/requirements.html` — host needs + listing fields to paste
- `acreline-pack/Documentation/buyer-guide.html`
- `acreline-pack/Documentation/support.html`
- `acreline-pack/Demos/README.txt`
- `acreline-pack/Licensing/CREDITS.md`

`SELLING.md` stays in the repo and in `dist-marketplace/SELLING.md` only. It is **not** inside the buyer zip.

Upload the **outer** `acreline-*.zip` to Envato (“All files & documentation”). Buyers extract it, then upload `acreline.zip`. Upload **only** `acreline.zip` if you try WordPress.org.

## Before you submit anywhere

1. Live preview with demo chrome **on** (concept honesty) and a second screenshot with chrome **off** (buyer fantasy).
2. Customize → Identity filled with 555 / `@acreline-concept.test` only.
3. No Unsplash files inside the theme zip.
4. No Freemius, Envato banners, or “Pro” admin ads.
5. Footer credit is optional and `rel="nofollow"`.
6. Theme Check on a stock WP install (warnings on Sage/vendor are expected — document them).

## WP.org remaining blockers (do not paper over)

- Sage / Blade / `vendor` (Acorn) is not what the Themes Team usually ships
- Block editor is disabled on purpose (project rule)
- PHP 8.3+ and a compiled Vite manifest
- Listings are plugin territory — Core must be a **separate** WP.org plugin if you go that route

A future “Acreline Lite” without Acorn would have a real shot at the picker. This repo is the premium / Envato / own-site product.

## GitHub repo About (paste in Settings → General)

Rename the GitHub repository to **`wp-acreline`** (Settings → General → Repository name) if it still says `keystone-homes-wp-theme`. GitHub keeps redirects from the old name. Then paste these on https://github.com/matthummel-pa/wp-acreline/settings :

**Description** (under 350 characters; this is the search snippet):

```
Acreline is a WordPress theme for farms, land, and historic homes — searchable listings, agents, and showing requests. Customizer identity, eight color styles, Sage 11. Demo and support by Matt Hummel.
```

**Website** (points at the support page, not only the demo):

```
https://github.com/matthummel-pa/wp-acreline/blob/main/SUPPORT.md
```

**Topics:** `wordpress-theme`, `wordpress`, `real-estate`, `realtor`, `farms`, `land`, `sage`, `acreline`

Leave the demo URL in `style.css` Theme URI. The repo Website field is the support page so GitHub’s “About” sidebar sends people to help, not a second concept HTML demo.

## After a sale

Buyer path is Appearance → Acreline Setup. Do not add a license server unless a marketplace requires it. Envato purchase codes are their problem, not a theme options lock.
