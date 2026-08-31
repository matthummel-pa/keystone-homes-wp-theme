# Support — Acreline

Acreline is a **concept** WordPress theme for farms, land, and historic homes. Sample listings, agents, phones, and showing requests are fiction — not a live MLS, licensed brokerage, or booking desk.

Created by [Matt Hummel](https://matthummel.com/).

## Where to get help

| Need | Go here |
| --- | --- |
| How the public site looks | [Concept demo](https://keystonehomes.ridgesandvalleys.com/) |
| Install, Customizer, seed, child theme | [Buyer guide](docs/marketplace/buyer-guide.html) |
| Theme bugs or docs gaps | [Open a GitHub issue](https://github.com/matthummel-pa/keystone-homes-wp-theme/issues) |
| Author / other work | [matthummel.com](https://matthummel.com/) |
| Concept office form (demo only) | [Contact on the demo](https://keystonehomes.ridgesandvalleys.com/contact/) |

There is no ticket desk or live chat for this theme. Demo phones are `555` numbers (office `(555) 010-0455`). Demo emails use `@keystone-concept.test` and do not reach a real inbox.

## Before you file an issue

1. Confirm the theme folder is still `keystone-homes` and you ran `npm run build` (or installed a zip that already includes `public/build`).
2. After Blade edits, clear Acorn views: `wp acorn view:clear`.
3. Identity, colors, and the header live under **Appearance → Customize** — not in page content.
4. Listings and agents are WordPress posts. Editing theme files does not change live copy unless you re-seed.

Include the WordPress version, PHP version, theme version (Appearance → Themes), and whether Keystone Core is active.

## What this theme does not do

- Sync a live MLS or IDX feed
- Process payments or hold real appointments
- Replace a licensed brokerage or CRM
- Ship Gutenberg / block-editor patterns (classic metaboxes only)

## Marketplace buyers

If you bought a pack (theme + child + Keystone Core), start with the **Documentation** folder in that zip (`buyer-guide.html` and `support.html`). ThemeForest / own-site purchase questions go through that marketplace’s support channel; GitHub issues are still welcome for reproducible theme bugs.

## Security

Do not commit GitHub tokens. The updater PAT lives in Customizer → GitHub, the Update Theme screen, or `KS_GITHUB_TOKEN` on the host — never in the theme repo.
