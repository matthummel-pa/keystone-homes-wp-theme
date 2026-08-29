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
        $resolved = self::resolve($override);

        return $resolved['url'];
    }

    public static function srcset(?string $override = null): string
    {
        return self::resolve($override)['srcset'];
    }

    /**
     * @return array{url: string, srcset: string}
     */
    public static function resolve(?string $override = null): array
    {
        $raw = trim((string) $override);
        if ($raw !== '' && ctype_digit($raw)) {
            $id = (int) $raw;
            $url = wp_get_attachment_image_url($id, 'full');
            if (is_string($url) && $url !== '') {
                $srcset = wp_get_attachment_image_srcset($id, 'full');

                return [
                    'url' => $url,
                    'srcset' => is_string($srcset) && $srcset !== '' ? $srcset : $url.' 1600w',
                ];
            }
        }

        $url = $raw !== '' ? $raw : self::DEFAULT;
        $attachmentId = $raw !== '' ? (int) attachment_url_to_postid($url) : 0;
        if ($attachmentId > 0) {
            $srcset = wp_get_attachment_image_srcset($attachmentId, 'full');
            if (is_string($srcset) && $srcset !== '') {
                return ['url' => $url, 'srcset' => $srcset];
            }
        }

        if (str_contains($url, 'images.unsplash.com')) {
            $base = preg_replace('/\?.*$/', '', $url) ?: $url;

            return [
                'url' => $url,
                'srcset' => $base.'?auto=format&fit=crop&w=800&q=70 800w, '
                    .$base.'?auto=format&fit=crop&w=1600&q=75 1600w',
            ];
        }

        return ['url' => $url, 'srcset' => $url.' 1600w'];
    }
}
