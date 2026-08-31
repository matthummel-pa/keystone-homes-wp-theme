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
        __('Keystone Setup', 'keystone-homes'),
        __('Keystone Setup', 'keystone-homes'),
        'edit_theme_options',
        'keystone-setup',
        __NAMESPACE__.'\\render_setup_page'
    );
});

function render_setup_page(): void
{
    if (! current_user_can('edit_theme_options')) {
        wp_die(esc_html__('You do not have permission to edit theme options.', 'keystone-homes'));
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
    echo '<h1>'.esc_html__('Keystone Setup', 'keystone-homes').'</h1>';
    echo '<p style="max-width:70ch">'.esc_html__('Buyer checklist — presentation only. No upsells. Walk these once after you activate the theme.', 'keystone-homes').'</p>';
    echo '<ol style="max-width:70ch;line-height:1.7">';
    echo '<li><a href="'.esc_url($identityUrl).'">'.esc_html__('Identity', 'keystone-homes').'</a> — '.esc_html__('Brand name, phone, email, address, hours, and header button.', 'keystone-homes').'</li>';
    echo '<li><a href="'.esc_url($colorUrl).'">'.esc_html__('Colors', 'keystone-homes').'</a> — '.esc_html__('Accent (forest by default).', 'keystone-homes').'</li>';
    echo '<li><a href="'.esc_url($customizer).'">'.esc_html__('Site Identity / Logo', 'keystone-homes').'</a> — '.esc_html__('Upload a logo under Site Identity. Header falls back to the house mark.', 'keystone-homes').'</li>';
    echo '<li><a href="'.esc_url($menusUrl).'">'.esc_html__('Menus', 'keystone-homes').'</a> — ';
    echo $hasPrimary
        ? esc_html__('Primary menu is assigned.', 'keystone-homes')
        : esc_html__('Assign Primary and Footer menus, or run Seed to create them.', 'keystone-homes');
    echo '</li>';
    echo '<li><a href="'.esc_url($seedUrl).'">'.esc_html__('Demo content', 'keystone-homes').'</a> — '.esc_html__('Loads concept pages, listings, agents, and menus. Safe to re-run.', 'keystone-homes').'</li>';
    echo '<li>'.esc_html__('Listings plugin', 'keystone-homes').' — ';
    echo $coreActive
        ? esc_html__('Keystone Core is active. Listings, agents, and bookings stay if you switch themes.', 'keystone-homes')
        : esc_html__('Install Keystone Core (in the marketplace pack) so custom post types are not theme-only. This concept site still registers them in the theme as a fallback.', 'keystone-homes');
    echo '</li>';
    echo '</ol>';
    echo '<p class="description" style="max-width:70ch">'.esc_html__('Turn off the concept demo banner and studio credit under Customize → Identity before you show this to a client.', 'keystone-homes').'</p>';
    echo '</div>';
}

add_action('wp_head', function (): void {
    echo '<style id="keystone-identity">'.Identity::cssVariables().'</style>'."\n";
}, 19);
