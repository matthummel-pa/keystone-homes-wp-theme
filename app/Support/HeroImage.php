<?php

namespace App\Support;

/**
 * Homepage (and other LCP) hero photo — URL + srcset, no plugin.
 */
class HeroImage
{
    public const DEFAULT = 'https://images.unsplash.com/photo-1570129477492-45c003edd2be';

    public const ALT = 'Keystone Homes Featured Property';

    public static function url(?string $override = null): string
    {
        $url = trim((string) $override);

        return $url !== '' ? $url : self::DEFAULT;
    }

    public static function srcset(?string $override = null): string
    {
        $url = self::url($override);
        $unsplash = 'images.unsplash.com';

        if (str_contains($url, $unsplash)) {
            $base = preg_replace('/\?.*$/', '', $url) ?: $url;

            return $base.'?auto=format&fit=crop&w=800&q=70 800w, '
                .$base.'?auto=format&fit=crop&w=1600&q=75 1600w';
        }

        return $url.' 1600w';
    }
}
