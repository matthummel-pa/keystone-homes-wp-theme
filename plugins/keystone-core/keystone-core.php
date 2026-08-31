<?php

/**
 * Plugin Name:       Keystone Core
 * Plugin URI:        https://github.com/matthummel-pa/keystone-homes-wp-theme
 * Description:       Listings, agents, and showing bookings for the Keystone Real Estate theme. Keeps inventory in the database when you switch themes.
 * Version:           1.0.0
 * Requires at least: 6.6
 * Requires PHP:      8.1
 * Author:            Ridges & Valleys Studio
 * Author URI:        https://ridgesandvalleys.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       keystone-core
 */

defined('ABSPATH') || exit;

define('KEYSTONE_CORE_VERSION', '1.0.0');
define('KEYSTONE_CORE_FILE', __FILE__);

require_once __DIR__.'/includes/post-types.php';
require_once __DIR__.'/includes/bookings.php';

register_activation_hook(__FILE__, static function (): void {
    keystone_core_register_post_types();
    flush_rewrite_rules();
});

register_deactivation_hook(__FILE__, static function (): void {
    flush_rewrite_rules();
});
