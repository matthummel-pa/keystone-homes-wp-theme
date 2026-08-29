<?php

namespace App\Support;

class Typography
{
    /**
     * Popular realtor-site sans-serifs. Inter is the default — widely used
     * on modern brokerage and listing sites for both UI and headlines.
     *
     * @return array<string, array{label: string, stack: string, google: string}>
     */
    public static function fonts(): array
    {
        return [
            'inter' => [
                'label' => 'Inter',
                'stack' => '"Inter", system-ui, sans-serif',
                'google' => 'Inter:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'plus-jakarta-sans' => [
                'label' => 'Plus Jakarta Sans',
                'stack' => '"Plus Jakarta Sans", system-ui, sans-serif',
                'google' => 'Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'dm-sans' => [
                'label' => 'DM Sans',
                'stack' => '"DM Sans", system-ui, sans-serif',
                'google' => 'DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'manrope' => [
                'label' => 'Manrope',
                'stack' => '"Manrope", system-ui, sans-serif',
                'google' => 'Manrope:wght@400;500;600;700',
            ],
            'montserrat' => [
                'label' => 'Montserrat',
                'stack' => '"Montserrat", system-ui, sans-serif',
                'google' => 'Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'poppins' => [
                'label' => 'Poppins',
                'stack' => '"Poppins", system-ui, sans-serif',
                'google' => 'Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'source-sans-3' => [
                'label' => 'Source Sans 3',
                'stack' => '"Source Sans 3", system-ui, sans-serif',
                'google' => 'Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'nunito-sans' => [
                'label' => 'Nunito Sans',
                'stack' => '"Nunito Sans", system-ui, sans-serif',
                'google' => 'Nunito+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400',
            ],
            'outfit' => [
                'label' => 'Outfit',
                'stack' => '"Outfit", system-ui, sans-serif',
                'google' => 'Outfit:wght@400;500;600;700',
            ],
            'lato' => [
                'label' => 'Lato',
                'stack' => '"Lato", system-ui, sans-serif',
                'google' => 'Lato:ital,wght@0,400;0,700;1,400',
            ],
        ];
    }

    /**
     * @return array<string, array{label: string, default: string, css: string}>
     */
    public static function roles(): array
    {
        return [
            'heading' => ['label' => 'Headings (H1–H4, prices, brand)', 'default' => 'inter', 'css' => '--ff-display'],
            'body' => ['label' => 'Body copy', 'default' => 'inter', 'css' => '--ff-body'],
            'nav' => ['label' => 'Navigation', 'default' => 'inter', 'css' => '--ff-nav'],
            'button' => ['label' => 'Buttons', 'default' => 'inter', 'css' => '--ff-button'],
            'label' => ['label' => 'Labels, eyebrows, and meta', 'default' => 'inter', 'css' => '--ff-mono'],
        ];
    }

    public static function option(string $role): string
    {
        $roles = self::roles();
        $default = $roles[$role]['default'] ?? 'inter';
        $value = (string) get_theme_mod('ks_font_'.$role, $default);

        return array_key_exists($value, self::fonts()) ? $value : $default;
    }

    public static function stack(string $role): string
    {
        $fonts = self::fonts();
        $key = self::option($role);

        return $fonts[$key]['stack'];
    }

    public static function baseSize(): int
    {
        $size = (int) get_theme_mod('ks_font_size', 16);

        return max(14, min(20, $size));
    }

    public static function headingWeight(): int
    {
        $weight = (int) get_theme_mod('ks_heading_weight', 700);

        return in_array($weight, [500, 600, 700], true) ? $weight : 700;
    }

    /**
     * @return list<string>
     */
    public static function googleFamilies(): array
    {
        $fonts = self::fonts();
        $needed = [];
        foreach (array_keys(self::roles()) as $role) {
            $key = self::option($role);
            if (isset($fonts[$key])) {
                $needed[$key] = $fonts[$key]['google'];
            }
        }

        return array_values($needed);
    }

    public static function cssVariables(): string
    {
        $lines = [];
        foreach (self::roles() as $role => $def) {
            $lines[] = $def['css'].':'.self::stack($role).';';
        }
        $lines[] = '--font-size-base:'.self::baseSize().'px;';
        $lines[] = '--fw-heading:'.self::headingWeight().';';

        return ':root{'.implode('', $lines).'}';
    }

    /**
     * @return array<string, string>
     */
    public static function stacksForJs(): array
    {
        $out = [];
        foreach (self::fonts() as $key => $font) {
            $out[$key] = $font['stack'];
        }

        return $out;
    }
}
