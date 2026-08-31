<?php

namespace App\Support;

/**
 * Buyer-facing office identity. Customizer first, concept defaults second.
 */
class Identity
{
    public static function brandName(): string
    {
        $mod = trim((string) get_theme_mod('ks_brand_name', ''));
        if ($mod !== '') {
            return $mod;
        }

        $name = (string) get_bloginfo('name', 'display');

        return $name !== '' ? $name : 'Keystone Real Estate';
    }

    public static function tagline(): string
    {
        $mod = trim((string) get_theme_mod('ks_tagline', ''));
        if ($mod !== '') {
            return $mod;
        }

        $desc = (string) get_bloginfo('description', 'display');

        return $desc !== '' ? $desc : __('Concept demo', 'keystone-homes');
    }

    public static function phone(): string
    {
        $phone = trim((string) get_theme_mod('ks_phone', '(555) 010-0455'));

        return $phone !== '' ? $phone : '(555) 010-0455';
    }

    public static function phoneHref(): string
    {
        return Catalog::telHref(self::phone());
    }

    public static function email(): string
    {
        $email = sanitize_email((string) get_theme_mod('ks_email', 'hello@keystone-concept.test'));

        return $email !== '' ? $email : 'hello@keystone-concept.test';
    }

    public static function address(): string
    {
        $address = trim((string) get_theme_mod('ks_address', "100 Concept Way\nSample Borough, PA 00000"));

        return $address !== '' ? $address : "100 Concept Way\nSample Borough, PA 00000";
    }

    public static function hours(): string
    {
        $hours = trim((string) get_theme_mod('ks_hours', "Mon–Fri 9:00–5:00\nSat by appointment\nSun closed (demo)"));

        return $hours !== '' ? $hours : "Mon–Fri 9:00–5:00\nSat by appointment\nSun closed (demo)";
    }

    public static function footerBlurb(): string
    {
        $blurb = trim((string) get_theme_mod('ks_footer_blurb', ''));
        if ($blurb !== '') {
            return $blurb;
        }

        return __('Concept realtor site by Matt Hummel. Fiction only — not a licensed brokerage or live MLS feed.', 'keystone-homes');
    }

    public static function ctaLabel(): string
    {
        $label = trim((string) get_theme_mod('ks_cta_label', ''));

        return $label !== '' ? $label : __('Book a showing', 'keystone-homes');
    }

    public static function bookUrl(): string
    {
        $custom = trim((string) get_theme_mod('ks_cta_url', ''));
        if ($custom !== '') {
            return $custom;
        }

        $page = get_page_by_path('book');

        return $page instanceof \WP_Post ? (string) get_permalink($page) : home_url('/book/');
    }

    public static function showDemoChrome(): bool
    {
        return (bool) get_theme_mod('ks_show_demo_chrome', true);
    }

    public static function showCredit(): bool
    {
        return (bool) get_theme_mod('ks_show_credit', true);
    }

    public static function creditText(): string
    {
        $text = trim((string) get_theme_mod('ks_credit_text', ''));

        return $text !== '' ? $text : __('Concept by Matt Hummel', 'keystone-homes');
    }

    public static function creditUrl(): string
    {
        return trim((string) get_theme_mod('ks_credit_url', 'https://matthummel.com'));
    }

    public static function accent(): string
    {
        $hex = sanitize_hex_color((string) get_theme_mod('ks_accent', '#1f6b4a'));

        return $hex ?: '#1f6b4a';
    }

    /**
     * @return array<string, string>
     */
    public static function social(): array
    {
        $out = [];
        foreach (['facebook', 'instagram', 'youtube', 'linkedin', 'x'] as $key) {
            $url = esc_url_raw((string) get_theme_mod('ks_social_'.$key, ''));
            if ($url !== '') {
                $out[$key] = $url;
            }
        }

        return $out;
    }

    /**
     * @return array<string, mixed>
     */
    public static function toArray(): array
    {
        return [
            'brand' => self::brandName(),
            'tagline' => self::tagline(),
            'phone' => self::phone(),
            'phoneHref' => self::phoneHref(),
            'email' => self::email(),
            'address' => self::address(),
            'hours' => self::hours(),
            'footerBlurb' => self::footerBlurb(),
            'ctaLabel' => self::ctaLabel(),
            'bookUrl' => self::bookUrl(),
            'showDemoChrome' => self::showDemoChrome(),
            'showCredit' => self::showCredit(),
            'creditText' => self::creditText(),
            'creditUrl' => self::creditUrl(),
            'social' => self::social(),
            'hasLogo' => has_custom_logo(),
        ];
    }

    public static function cssVariables(): string
    {
        $accent = self::accent();
        $rgb = self::hexToRgb($accent);
        $dark = self::shadeHex($accent, 0.82);
        $soft = sprintf('rgba(%d,%d,%d,.16)', $rgb[0], $rgb[1], $rgb[2]);
        $glow = sprintf('rgba(%d,%d,%d,.28)', $rgb[0], $rgb[1], $rgb[2]);

        return ':root{--accent:'.$accent.';--accent-dark:'.$dark.';--accent-soft:'.$soft.';--accent-glow:'.$glow.';--success:'.$accent.';}';
    }

    /**
     * @return array{0:int,1:int,2:int}
     */
    private static function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $int = hexdec($hex);

        return [($int >> 16) & 255, ($int >> 8) & 255, $int & 255];
    }

    private static function shadeHex(string $hex, float $factor): string
    {
        [$r, $g, $b] = self::hexToRgb($hex);
        $r = max(0, min(255, (int) round($r * $factor)));
        $g = max(0, min(255, (int) round($g * $factor)));
        $b = max(0, min(255, (int) round($b * $factor)));

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
