<?php

/**
 * Theme Customizer — identity, colors, typography.
 */

namespace App;

use App\Support\ColorSchemes;
use App\Support\Typography;
use WP_Customize_Color_Control;
use WP_Customize_Manager;

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    $wp_customize->add_section('ks_identity', [
        'title' => __('Identity', 'keystone-homes'),
        'description' => __('Office name, phone, and chrome buyers change first. Concept defaults stay until you overwrite them.', 'keystone-homes'),
        'priority' => 30,
    ]);

    $text = [
        'ks_brand_name' => [__('Brand name', 'keystone-homes'), 'Keystone Real Estate'],
        'ks_tagline' => [__('Header tagline', 'keystone-homes'), 'Concept demo'],
        'ks_phone' => [__('Phone', 'keystone-homes'), '(555) 010-0455'],
        'ks_email' => [__('Email', 'keystone-homes'), 'hello@keystone-concept.test'],
        'ks_cta_label' => [__('Header button label', 'keystone-homes'), 'Book a showing'],
        'ks_cta_url' => [__('Header button URL', 'keystone-homes'), ''],
        'ks_credit_text' => [__('Footer credit text', 'keystone-homes'), 'Concept by Matt Hummel'],
        'ks_credit_url' => [__('Footer credit URL', 'keystone-homes'), 'https://matthummel.com'],
    ];

    foreach ($text as $id => [$label, $default]) {
        $sanitize = str_contains($id, 'url') ? 'esc_url_raw' : (str_contains($id, 'email') ? 'sanitize_email' : 'sanitize_text_field');
        $wp_customize->add_setting($id, [
            'default' => $default,
            'sanitize_callback' => $sanitize,
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control($id, [
            'label' => $label,
            'section' => 'ks_identity',
            'type' => 'text',
        ]);
    }

    $wp_customize->add_setting('ks_address', [
        'default' => "100 Concept Way\nSample Borough, PA 00000",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('ks_address', [
        'label' => __('Address', 'keystone-homes'),
        'section' => 'ks_identity',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('ks_hours', [
        'default' => "Mon–Fri 9:00–5:00\nSat by appointment\nSun closed (demo)",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('ks_hours', [
        'label' => __('Hours', 'keystone-homes'),
        'section' => 'ks_identity',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('ks_footer_blurb', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('ks_footer_blurb', [
        'label' => __('Footer blurb', 'keystone-homes'),
        'description' => __('Leave empty for the concept sentence.', 'keystone-homes'),
        'section' => 'ks_identity',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('ks_show_demo_chrome', [
        'default' => true,
        'sanitize_callback' => __NAMESPACE__.'\\sanitize_checkbox',
    ]);
    $wp_customize->add_control('ks_show_demo_chrome', [
        'label' => __('Show concept demo banner and author badge', 'keystone-homes'),
        'section' => 'ks_identity',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_setting('ks_show_credit', [
        'default' => true,
        'sanitize_callback' => __NAMESPACE__.'\\sanitize_checkbox',
    ]);
    $wp_customize->add_control('ks_show_credit', [
        'label' => __('Show removable author credit in the footer', 'keystone-homes'),
        'section' => 'ks_identity',
        'type' => 'checkbox',
    ]);

    $schemeChoices = [];
    foreach (ColorSchemes::all() as $key => $scheme) {
        $schemeChoices[$key] = $scheme['label'];
    }

    $wp_customize->add_section('ks_colors', [
        'title' => __('Colors', 'keystone-homes'),
        'description' => __('Eight named styles. Pick a style, then tweak accent, paper, or ink. Keep body text dark on a light page.', 'keystone-homes'),
        'priority' => 35,
    ]);

    $wp_customize->add_setting('ks_color_scheme', [
        'default' => ColorSchemes::defaultKey(),
        'sanitize_callback' => [ColorSchemes::class, 'sanitizeKey'],
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('ks_color_scheme', [
        'label' => __('Color style', 'keystone-homes'),
        'section' => 'ks_colors',
        'type' => 'select',
        'choices' => $schemeChoices,
    ]);

    $forest = ColorSchemes::all()['forest'];
    foreach ([
        'ks_accent' => [__('Accent', 'keystone-homes'), $forest['accent']],
        'ks_paper' => [__('Paper (page background)', 'keystone-homes'), $forest['paper']],
        'ks_ink' => [__('Ink (text)', 'keystone-homes'), $forest['ink']],
    ] as $id => [$label, $default]) {
        $wp_customize->add_setting($id, [
            'default' => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, [
            'label' => $label,
            'section' => 'ks_colors',
        ]));
    }

    $wp_customize->add_section('ks_header', [
        'title' => __('Header', 'keystone-homes'),
        'description' => __('Sticky bar is the default. Compact shortens the bar on listing-heavy pages.', 'keystone-homes'),
        'priority' => 34,
    ]);

    $wp_customize->add_setting('ks_header_style', [
        'default' => 'standard',
        'sanitize_callback' => function ($value) {
            $value = sanitize_key((string) $value);

            return in_array($value, ['standard', 'compact'], true) ? $value : 'standard';
        },
    ]);
    $wp_customize->add_control('ks_header_style', [
        'label' => __('Header size', 'keystone-homes'),
        'section' => 'ks_header',
        'type' => 'select',
        'choices' => [
            'standard' => __('Standard', 'keystone-homes'),
            'compact' => __('Compact', 'keystone-homes'),
        ],
    ]);

    $wp_customize->add_setting('ks_header_sticky', [
        'default' => true,
        'sanitize_callback' => __NAMESPACE__.'\\sanitize_checkbox',
    ]);
    $wp_customize->add_control('ks_header_sticky', [
        'label' => __('Stick the header while scrolling', 'keystone-homes'),
        'section' => 'ks_header',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_section('ks_social', [
        'title' => __('Social links', 'keystone-homes'),
        'priority' => 36,
    ]);

    foreach ([
        'facebook' => __('Facebook URL', 'keystone-homes'),
        'instagram' => __('Instagram URL', 'keystone-homes'),
        'youtube' => __('YouTube URL', 'keystone-homes'),
        'linkedin' => __('LinkedIn URL', 'keystone-homes'),
        'x' => __('X / Twitter URL', 'keystone-homes'),
    ] as $key => $label) {
        $id = 'ks_social_'.$key;
        $wp_customize->add_setting($id, [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control($id, [
            'label' => $label,
            'section' => 'ks_social',
            'type' => 'url',
        ]);
    }

    $wp_customize->add_section('ks_typography', [
        'title' => __('Typography', 'keystone-homes'),
        'description' => __('Sans-serif fonts used on modern realtor sites. Inter is the default for headings and body.', 'keystone-homes'),
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
        'label' => __('Base text size (px)', 'keystone-homes'),
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
        'label' => __('Heading weight', 'keystone-homes'),
        'section' => 'ks_typography',
        'type' => 'select',
        'choices' => [
            500 => __('Medium (500)', 'keystone-homes'),
            600 => __('Semibold (600)', 'keystone-homes'),
            700 => __('Bold (700)', 'keystone-homes'),
        ],
    ]);
});

function sanitize_font_key($value): string
{
    $value = sanitize_key((string) $value);

    return array_key_exists($value, Typography::fonts()) ? $value : 'inter';
}

function sanitize_checkbox($value): bool
{
    return (bool) $value;
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

add_action('customize_controls_enqueue_scripts', function () {
    $rel = 'resources/js/customizer-controls.js';
    $src = get_theme_file_uri($rel);
    $path = get_theme_file_path($rel);
    wp_enqueue_script(
        'keystone-customizer-controls',
        $src,
        ['customize-controls', 'jquery'],
        file_exists($path) ? (string) filemtime($path) : wp_get_theme()->get('Version'),
        true
    );
    wp_localize_script('keystone-customizer-controls', 'KEYSTONE_SCHEMES', ColorSchemes::forJs());
});

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
