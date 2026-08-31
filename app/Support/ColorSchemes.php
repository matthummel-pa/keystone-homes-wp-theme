<?php

namespace App\Support;

/**
 * Named color styles for Customize → Colors and the demo style switcher.
 */
class ColorSchemes
{
    /**
     * @return array<string, array{label: string, accent: string, paper: string, ink: string}>
     */
    public static function all(): array
    {
        return [
            'forest' => [
                'label' => __('Forest', 'keystone-homes'),
                'accent' => '#1f6b4a',
                'paper' => '#f5f4f1',
                'ink' => '#141210',
            ],
            'clay' => [
                'label' => __('Clay', 'keystone-homes'),
                'accent' => '#9a4324',
                'paper' => '#f6f1ea',
                'ink' => '#1c1612',
            ],
            'navy' => [
                'label' => __('Navy', 'keystone-homes'),
                'accent' => '#1e3a5f',
                'paper' => '#f3f2ee',
                'ink' => '#12151a',
            ],
            'burgundy' => [
                'label' => __('Burgundy', 'keystone-homes'),
                'accent' => '#722f37',
                'paper' => '#f6f1ee',
                'ink' => '#1a1214',
            ],
            'harvest' => [
                'label' => __('Harvest', 'keystone-homes'),
                'accent' => '#7a5b14',
                'paper' => '#f7f3e8',
                'ink' => '#1a160c',
            ],
            'lake' => [
                'label' => __('Lake', 'keystone-homes'),
                'accent' => '#0e5f5c',
                'paper' => '#f0f4f3',
                'ink' => '#101716',
            ],
            'orchard' => [
                'label' => __('Orchard', 'keystone-homes'),
                'accent' => '#5c3d6e',
                'paper' => '#f5f1f4',
                'ink' => '#161218',
            ],
            'charcoal' => [
                'label' => __('Charcoal', 'keystone-homes'),
                'accent' => '#2c2a28',
                'paper' => '#f4f2ee',
                'ink' => '#141210',
            ],
        ];
    }

    public static function defaultKey(): string
    {
        return 'forest';
    }

    public static function currentKey(): string
    {
        $key = sanitize_key((string) get_theme_mod('ks_color_scheme', self::defaultKey()));

        return array_key_exists($key, self::all()) ? $key : self::defaultKey();
    }

    /**
     * @return array{label: string, accent: string, paper: string, ink: string}
     */
    public static function current(): array
    {
        $all = self::all();

        return $all[self::currentKey()];
    }

    /**
     * @return list<string>
     */
    public static function keys(): array
    {
        return array_keys(self::all());
    }

    public static function sanitizeKey($value): string
    {
        $value = sanitize_key((string) $value);

        return array_key_exists($value, self::all()) ? $value : self::defaultKey();
    }

    /**
     * @return array<string, array{label: string, accent: string, paper: string, ink: string, css: string}>
     */
    public static function forJs(): array
    {
        $out = [];
        foreach (self::all() as $key => $scheme) {
            $out[$key] = $scheme + [
                'css' => Identity::cssFromPalette($scheme['accent'], $scheme['paper'], $scheme['ink']),
            ];
        }

        return $out;
    }
}
