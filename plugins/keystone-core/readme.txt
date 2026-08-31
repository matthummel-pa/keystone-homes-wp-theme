=== Keystone Core ===
Contributors: ridgesandvalleys
Requires at least: 6.6
Tested up to: 6.8
Requires PHP: 8.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Listings, agents, and showing bookings for the Acreline theme.

== Description ==

Keystone Core registers the `listing`, `agent`, and `booking` post types and the public `keystone/v1/bookings` REST route.

Switching themes leaves those posts and `ks_*` meta in the database. Acreline displays them; this plugin owns them.

This is sample / concept inventory — not a live MLS.

== Installation ==

1. Upload the `keystone-core` folder to `wp-content/plugins/`.
2. Activate Keystone Core.
3. Activate the Acreline theme.
4. Use Tools → Seed Acreline demo, or add listings from wp-admin.

== Changelog ==

= 1.0.0 =
* First public companion plugin for marketplace packs.
