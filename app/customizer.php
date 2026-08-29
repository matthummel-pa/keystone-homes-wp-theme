<?php

/**
 * Theme Customizer — typography for every text role.
 */

namespace App;

use App\Support\Typography;
use WP_Customize_Manager;

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    $wp_customize->add_section('ks_typography', [
        'title' => __('Typography', 'sage'),
        'description' => __('Sans-serif fonts used on modern realtor sites. Inter is the default for headings and body.', 'sage'),
        'priority' => 40,
    ]);

    $choices = [];
    foreach (Typography::fonts() as $key => $font) {
        $choices[$key] = $font['label'];
    }

    foreach (Typography::roles() as $role => $def) {
        $id = 'ks_font_'.$role;
        $wp_customize->add_setting($id, [
            'default' => $def['default'],
            'sanitize_callback' => __NAMESPACE__.'\\sanitize_font_key',
            'transport' => 'postMessage',
        ]);
        $wp_customize->add_control($id, [
            'label' => $def['label'],
            'section' => 'ks_typography',
            'type' => 'select',
            'choices' => $choices,
        ]);
    }

    $wp_customize->add_setting('ks_font_size', [
        'default' => 16,
        'sanitize_callback' => function ($value) {
            return max(14, min(20, (int) $value));
        },
        'transport' => 'postMessage',
    ]);
    $wp_customize->add_control('ks_font_size', [
        'label' => __('Base text size (px)', 'sage'),
        'section' => 'ks_typography',
        'type' => 'number',
        'input_attrs' => ['min' => 14, 'max' => 20, 'step' => 1],
    ]);

    $wp_customize->add_setting('ks_heading_weight', [
        'default' => 700,
        'sanitize_callback' => function ($value) {
            $value = (int) $value;

            return in_array($value, [500, 600, 700], true) ? $value : 700;
        },
        'transport' => 'postMessage',
    ]);
    $wp_customize->add_control('ks_heading_weight', [
        'label' => __('Heading weight', 'sage'),
        'section' => 'ks_typography',
        'type' => 'select',
        'choices' => [
            500 => __('Medium (500)', 'sage'),
            600 => __('Semibold (600)', 'sage'),
            700 => __('Bold (700)', 'sage'),
        ],
    ]);
});

function sanitize_font_key($value): string
{
    $value = sanitize_key((string) $value);

    return array_key_exists($value, Typography::fonts()) ? $value : 'inter';
}

add_action('wp_enqueue_scripts', function () {
    $families = Typography::googleFamilies();
    if ($families === []) {
        return;
    }
    $href = 'https://fonts.googleapis.com/css2?family='.implode('&family=', $families).'&display=swap';
    wp_enqueue_style('keystone-fonts', $href, [], null);
}, 5);

add_filter('style_loader_tag', function (string $tag, string $handle) {
    if ($handle !== 'keystone-fonts') {
        return $tag;
    }

    return '<link rel="preconnect" href="https://fonts.googleapis.com">'."\n"
        .'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'."\n"
        .$tag;
}, 10, 2);

add_action('wp_head', function () {
    echo '<style id="keystone-typography">'.Typography::cssVariables().'</style>'."\n";
}, 20);

add_action('customize_preview_init', function () {
    $rel = 'resources/js/customizer-preview.js';
    $src = get_theme_file_uri($rel);
    $path = get_theme_file_path($rel);
    wp_enqueue_script(
        'keystone-customizer-preview',
        $src,
        ['customize-preview'],
        file_exists($path) ? (string) filemtime($path) : wp_get_theme()->get('Version'),
        true
    );
    wp_localize_script('keystone-customizer-preview', 'KEYSTONE_FONTS', [
        'stacks' => Typography::stacksForJs(),
        'google' => array_map(fn ($font) => $font['google'], Typography::fonts()),
        'roles' => array_map(fn ($def) => $def['css'], Typography::roles()),
    ]);
});
