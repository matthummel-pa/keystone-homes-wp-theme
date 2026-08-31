=== Keystone Real Estate ===
Contributors: ridgesandvalleys
Requires at least: 6.6
Tested up to: 6.8
Requires PHP: 8.3
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, custom-colors, custom-logo, custom-menu, featured-images, footer-widgets, theme-options, threaded-comments, translation-ready

Land-and-farms realtor theme for rural listings, agents, and showing requests.

== Description ==

Keystone Real Estate is a classic (non-block) Sage 11 theme for land, farms, and historic-home inventory. Buyers set office identity, accent color, menus, and logo from the Customizer. Demo pages and sample listings load from Tools → Seed Keystone demo.

This is a concept theme. Sample phones are 555 numbers. It is not a live MLS, licensed brokerage, or booking system.

= Features =

* Customizer identity: brand, phone, email, address, hours, header button, removable studio credit
* Accent color and Inter-based typography
* WordPress menus (Primary + Footer) with a concept-page fallback
* Footer widget area
* Listing, agent, and booking templates (types registered by Keystone Core, or in-theme as a concept fallback)
* Native title, description, Open Graph, and Twitter tags (yields to Yoast / Rank Math / SEOPress / AIOSEO)
* Breadcrumbs with BreadcrumbList JSON-LD
* Translation-ready (`keystone-homes`)

= WordPress.org note =

This theme ships compiled Vite assets and an Acorn/Sage vendor tree. The directory prefers simpler classic or block themes. Treat a WP.org upload as a later lite listing, not a guaranteed first-pass approval. ThemeForest and your own store take the full pack.

== Installation ==

1. Upload `keystone-homes` to `/wp-content/themes/` (or use the zip from Appearance → Themes → Add New).
2. Activate Keystone Real Estate.
3. Optional: install and activate Keystone Core from the marketplace pack so listings survive a theme switch.
4. Go to Appearance → Keystone Setup and walk the checklist.
5. Appearance → Customize → Identity to replace concept phone and address.
6. Tools → Seed Keystone demo if you want the preview pages and sample inventory.

The theme folder must stay `keystone-homes` (Vite `base` path). After a source checkout run `npm run build` and `composer install --no-dev`. Store zips already include `public/build` and `vendor`.

== Frequently Asked Questions ==

= Where do I change the phone number? =

Appearance → Customize → Identity.

= How do I hide the concept demo banner? =

Customize → Identity → uncheck “Show concept demo banner and studio badge.” Uncheck the credit box to drop the footer studio line (WordPress.org requires the buyer’s copyright only).

= Where do listings live? =

In the `listing` post type. Keystone Core owns registration on a store install. This repo still registers the types in the theme when the plugin is missing so the live concept site keeps working.

= Can I use a child theme? =

Yes. The marketplace pack includes `keystone-homes-child`.

== Changelog ==

= 1.0.0 =
* Marketplace layer: Customizer identity/colors/social, WP menus, breadcrumbs, Keystone Setup, companion plugin, child theme, readme.txt
* Text domain is now `keystone-homes`
* Footer copyright is the site name; studio credit is optional and nofollow

== Resources ==

* Inter, Google Fonts, SIL Open Font License, https://fonts.google.com/specimen/Inter
* Plus Jakarta Sans, Google Fonts, SIL OFL
* DM Sans, Google Fonts, SIL OFL
* Manrope, Google Fonts, SIL OFL
* Montserrat, Google Fonts, SIL OFL
* Sage / Acorn, Roots, MIT, https://roots.io/sage/
* Theme placeholders and SVG marks, Ridges & Valleys Studio, GPLv2 or later
* Unsplash photographs used as hotlinked concept images only — not bundled in the theme zip
