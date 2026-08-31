<?php

/**
 * Keystone Real Estate child theme.
 */
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', static function (): void {
    $path = get_stylesheet_directory().'/style.css';
    wp_enqueue_style(
        'keystone-homes-child',
        get_stylesheet_uri(),
        [],
        is_readable($path) ? (string) filemtime($path) : wp_get_theme()->get('Version')
    );
});
