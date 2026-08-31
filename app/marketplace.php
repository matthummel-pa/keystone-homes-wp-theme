<?php

/**
 * Marketplace chrome: menus, setup checklist, Theme Check helpers.
 */

namespace App;

use App\Support\Identity;

add_filter('nav_menu_css_class', function (array $classes, $item): array {
    if (in_array('current-menu-item', $classes, true) || in_array('current-menu-ancestor', $classes, true)) {
        $classes[] = 'is-active';
    }

    return $classes;
}, 10, 2);

add_filter('nav_menu_link_attributes', function (array $atts, $item): array {
    if (! empty($item->current) || ! empty($item->current_item_ancestor)) {
        $atts['aria-current'] = 'page';
        $atts['class'] = trim(($atts['class'] ?? '').' is-active');
    }

    return $atts;
}, 10, 2);

add_action('admin_menu', function (): void {
    add_theme_page(
        __('Acreline Setup', 'acreline'),
        __('Acreline Setup', 'acreline'),
        'edit_theme_options',
        'keystone-setup',
        __NAMESPACE__.'\\render_setup_page'
    );
});

function render_setup_page(): void
{
    if (! current_user_can('edit_theme_options')) {
        wp_die(esc_html__('You do not have permission to edit theme options.', 'acreline'));
    }

    $coreActive = defined('KEYSTONE_CORE_VERSION');
    $menus = get_nav_menu_locations();
    $hasPrimary = ! empty($menus['primary_navigation']);
    $customizer = admin_url('customize.php');
    $menusUrl = admin_url('nav-menus.php');
    $seedUrl = admin_url('tools.php?page=ks-seed-demo');
    $identityUrl = add_query_arg('autofocus[section]', 'ks_identity', $customizer);
    $colorUrl = add_query_arg('autofocus[section]', 'ks_colors', $customizer);

    echo '<div class="wrap">';
    echo '<h1>'.esc_html__('Acreline Setup', 'acreline').'</h1>';
    echo '<p style="max-width:70ch">'.esc_html__('Buyer checklist — presentation only. No upsells. Walk these once after you activate Acreline.', 'acreline').'</p>';
    echo '<ol style="max-width:70ch;line-height:1.7">';
    echo '<li><a href="'.esc_url($identityUrl).'">'.esc_html__('Identity', 'acreline').'</a> — '.esc_html__('Brand name, phone, email, address, hours, and header button.', 'acreline').'</li>';
    echo '<li><a href="'.esc_url($colorUrl).'">'.esc_html__('Colors', 'acreline').'</a> — '.esc_html__('Eight styles (Forest, Clay, Navy, Burgundy, Harvest, Lake, Orchard, Charcoal) plus accent, paper, and ink.', 'acreline').'</li>';
    echo '<li><a href="'.esc_url(add_query_arg('autofocus[section]', 'ks_header', $customizer)).'">'.esc_html__('Header', 'acreline').'</a> — '.esc_html__('Sticky or static, standard or compact.', 'acreline').'</li>';
    echo '<li><a href="'.esc_url($customizer).'">'.esc_html__('Site Identity / Logo', 'acreline').'</a> — '.esc_html__('Upload a logo under Site Identity. Header falls back to the house mark.', 'acreline').'</li>';
    echo '<li><a href="'.esc_url($menusUrl).'">'.esc_html__('Menus', 'acreline').'</a> — ';
    echo $hasPrimary
        ? esc_html__('Primary menu is assigned.', 'acreline')
        : esc_html__('Assign Primary and Footer menus, or run Seed to create them.', 'acreline');
    echo '</li>';
    echo '<li><a href="'.esc_url($seedUrl).'">'.esc_html__('Demo content', 'acreline').'</a> — '.esc_html__('Loads concept pages, listings, agents, and menus. Safe to re-run.', 'acreline').'</li>';
    echo '<li>'.esc_html__('Listings plugin', 'acreline').' — ';
    echo $coreActive
        ? esc_html__('Acreline Core is active. Listings, agents, and bookings stay if you switch themes.', 'acreline')
        : esc_html__('Install Acreline Core (in the marketplace pack) so custom post types are not theme-only. This concept site still registers them in the theme as a fallback.', 'acreline');
    echo '</li>';
    echo '</ol>';
    echo '<p class="description" style="max-width:70ch">'.esc_html__('Turn off the concept demo banner and author credit under Customize → Identity before you show this to a client.', 'acreline').'</p>';
    echo '</div>';
}

add_action('wp_head', function (): void {
    echo '<style id="keystone-identity">'.Identity::cssVariables().'</style>'."\n";
}, 19);
