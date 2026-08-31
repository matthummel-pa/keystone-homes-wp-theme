<?php

defined('ABSPATH') || exit;

function keystone_core_register_post_types(): void
{
    register_post_type('listing', [
        'labels' => [
            'name' => __('Listings', 'acreline-core'),
            'singular_name' => __('Listing', 'acreline-core'),
            'add_new_item' => __('Add Listing', 'acreline-core'),
            'edit_item' => __('Edit Listing', 'acreline-core'),
            'search_items' => __('Search Listings', 'acreline-core'),
            'not_found' => __('No listings found.', 'acreline-core'),
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
            'name' => __('Bookings', 'acreline-core'),
            'singular_name' => __('Booking', 'acreline-core'),
            'add_new_item' => __('Add Booking', 'acreline-core'),
            'edit_item' => __('Edit Booking', 'acreline-core'),
            'search_items' => __('Search Bookings', 'acreline-core'),
            'not_found' => __('No bookings found.', 'acreline-core'),
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
            'name' => __('Agents', 'acreline-core'),
            'singular_name' => __('Agent', 'acreline-core'),
            'add_new_item' => __('Add Agent', 'acreline-core'),
            'edit_item' => __('Edit Agent', 'acreline-core'),
            'search_items' => __('Search Agents', 'acreline-core'),
            'not_found' => __('No agents found.', 'acreline-core'),
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
