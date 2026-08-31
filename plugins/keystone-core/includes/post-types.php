<?php

defined('ABSPATH') || exit;

function keystone_core_register_post_types(): void
{
    register_post_type('listing', [
        'labels' => [
            'name' => __('Listings', 'keystone-core'),
            'singular_name' => __('Listing', 'keystone-core'),
            'add_new_item' => __('Add Listing', 'keystone-core'),
            'edit_item' => __('Edit Listing', 'keystone-core'),
            'search_items' => __('Search Listings', 'keystone-core'),
            'not_found' => __('No listings found.', 'keystone-core'),
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'listing'],
        'query_var' => false,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-home',
        'menu_position' => 20,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'capability_type' => 'post',
    ]);

    register_post_type('booking', [
        'labels' => [
            'name' => __('Bookings', 'keystone-core'),
            'singular_name' => __('Booking', 'keystone-core'),
            'add_new_item' => __('Add Booking', 'keystone-core'),
            'edit_item' => __('Edit Booking', 'keystone-core'),
            'search_items' => __('Search Bookings', 'keystone-core'),
            'not_found' => __('No bookings found.', 'keystone-core'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'has_archive' => false,
        'rewrite' => false,
        'menu_icon' => 'dashicons-calendar-alt',
        'menu_position' => 21,
        'supports' => ['title'],
        'capability_type' => 'post',
    ]);

    register_post_type('agent', [
        'labels' => [
            'name' => __('Agents', 'keystone-core'),
            'singular_name' => __('Agent', 'keystone-core'),
            'add_new_item' => __('Add Agent', 'keystone-core'),
            'edit_item' => __('Edit Agent', 'keystone-core'),
            'search_items' => __('Search Agents', 'keystone-core'),
            'not_found' => __('No agents found.', 'keystone-core'),
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'agent'],
        'query_var' => false,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-businessperson',
        'menu_position' => 22,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'capability_type' => 'post',
    ]);
}

add_action('init', 'keystone_core_register_post_types');

add_filter('request', static function (array $vars): array {
    foreach (['listing', 'agent'] as $var) {
        if (isset($vars[$var]) && ctype_digit((string) $vars[$var])) {
            unset($vars[$var]);
        }
    }

    return $vars;
});
