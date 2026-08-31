=== Acreline ===
Contributors: matthummel
Requires at least: 6.6
Tested up to: 7.0.1
Requires PHP: 8.3
Stable tag: 1.2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, custom-colors, custom-logo, custom-menu, featured-images, footer-widgets, theme-options, threaded-comments, translation-ready

WordPress theme for farms, land, and historic homes — listings, agents, showing requests.

== Description ==

Acreline is a classic (non-block) Sage 11 WordPress theme for land, farms, and historic-home inventory: searchable listings, agents, and showing requests. Buyers set office identity, color style, menus, and logo from the Customizer. Demo pages and sample listings load from Tools → Seed Acreline demo. Support: https://github.com/matthummel-pa/keystone-homes-wp-theme/blob/main/SUPPORT.md

The sample office in the preview is named Acreline — replace it under Customize → Identity. This is a concept theme. Sample phones are 555 numbers. It is not a live MLS, licensed brokerage, or booking system.

= Features =

* Customizer identity: brand, phone, email, address, hours, header button, removable author credit
* Eight color styles (Forest, Clay, Navy, Burgundy, Harvest, Lake, Orchard, Charcoal) plus accent, paper, and ink
* Header size and sticky toggle
* Demo color switcher on the concept preview
* Inter-based typography with font choices
* WordPress menus (Primary + Footer) with a concept-page fallback
* Footer widget area
* Listing, agent, and booking templates (types registered by Acreline Core, or in-theme as a concept fallback)
* Native title, description, Open Graph, and Twitter tags (yields to Yoast / Rank Math / SEOPress / AIOSEO)
* Breadcrumbs with BreadcrumbList JSON-LD
* Translation-ready (`acreline`)

= WordPress.org note =

This theme ships compiled Vite assets and an Acorn/Sage vendor tree. The directory prefers simpler classic or block themes. Treat a WP.org upload as a later lite listing, not a guaranteed first-pass approval. ThemeForest and your own store take the full pack.

== Installation ==

1. Upload `acreline` to `/wp-content/themes/` (or use the zip from Appearance → Themes → Add New).
2. Activate Acreline.
3. Optional: install and activate Acreline Core from the marketplace pack so listings survive a theme switch.
4. Go to Appearance → Acreline Setup and walk the checklist.
5. Appearance → Customize → Identity to replace concept phone and address.
6. Tools → Seed Acreline demo if you want the preview pages and sample inventory.

The theme folder must stay `acreline` (Vite `base` path). After a source checkout run `npm run build` and `composer install --no-dev`. Store zips already include `public/build` and `vendor`.

== Frequently Asked Questions ==

= Where do I change the phone number? =

Appearance → Customize → Identity.

= How do I hide the concept demo banner? =

Customize → Identity → uncheck “Show concept demo banner and author badge.” Uncheck the credit box to drop the footer author line (WordPress.org requires the buyer’s copyright only).

= Where do listings live? =

In the `listing` post type. Acreline Core owns registration on a store install. This repo still registers the types in the theme when the plugin is missing so the live concept site keeps working.

= Can I use a child theme? =

Yes. The marketplace pack includes `acreline-child`.

== Changelog ==

= 1.2.1 =
* Marketing pages: taller photo heroes, sample-market cards, and a scannable land-buying guide. Retired Keystone / Adams County strings fall back to Acreline copy.

= 1.2.0 =
* Install folder, text domain, and theme zip are `acreline`. Child theme `acreline-child`. Companion plugin is Acreline Core.
* Sample office default is Acreline. Concept emails use `@acreline-concept.test`.

= 1.1.0 =
* Eight named color styles, paper/ink pickers, header size, and a demo style switcher.
* Sample page and listing copy is generic market language for store previews.

= 1.0.2 =
* Author credit is Matt Hummel (matthummel.com) for theme shops and WordPress.org.

= 1.0.1 =
* Theme Name is now Acreline. Sample office in the demo stays Acreline until you change Identity.

= 1.0.0 =
* Marketplace layer: Customizer identity/colors/social, WP menus, breadcrumbs, setup checklist, companion plugin, child theme, readme.txt
* Text domain is `acreline` (install folder)
* Footer copyright is the site name; author credit is optional and nofollow

== Resources ==

* Inter, Google Fonts, SIL Open Font License, https://fonts.google.com/specimen/Inter
* Plus Jakarta Sans, Google Fonts, SIL OFL
* DM Sans, Google Fonts, SIL OFL
* Manrope, Google Fonts, SIL OFL
* Montserrat, Google Fonts, SIL OFL
* Sage / Acorn, Roots, MIT, https://roots.io/sage/
* Theme placeholders and SVG marks, Matt Hummel, GPLv2 or later
* Unsplash photographs used as hotlinked concept images only — not bundled in the theme zip
