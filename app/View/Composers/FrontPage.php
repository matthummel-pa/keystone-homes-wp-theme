<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    /**
     * @var array
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * URL for a file under theme `public/` (`@asset('images/foo.jpg')`).
     * Uses WordPress theme URIs so Vite/Acorn manifests are not required.
     */
    public static function publicUri(string $path): string
    {
        $path = ltrim($path, '/');
        $relative = str_starts_with($path, 'public/') ? $path : 'public/'.$path;

        return get_theme_file_uri($relative);
    }

    /**
     * Demo review cards shaped like a Google Places review payload.
     * Swap this array for a server-proxied feed later — do not call Google from the browser.
     *
     * @return list<array{
     *   author_name: string,
     *   rating: float,
     *   text: string,
     *   profile_photo_url: string,
     *   relative_time_description: string,
     *   given_or_received: string,
     *   location: string
     * }>
     */
    public function reviews(): array
    {
        return [
            [
                'author_name' => 'Sample Buyer A',
                'rating' => 5.0,
                'text' => 'The showing scheduler made it obvious what to do next.',
                'profile_photo_url' => 'images/review-buyer-a.jpg',
                'relative_time_description' => 'a month ago',
                'given_or_received' => 'received',
                'location' => 'North Ridge · demo',
            ],
            [
                'author_name' => 'Sample Buyer B',
                'rating' => 5.0,
                'text' => 'Payment estimate beside the photo helped us compare homes faster.',
                'profile_photo_url' => 'images/review-buyer-b.jpg',
                'relative_time_description' => '2 weeks ago',
                'given_or_received' => 'received',
                'location' => 'Mill Creek · demo',
            ],
            [
                'author_name' => 'Sample Seller C',
                'rating' => 4.8,
                'text' => 'We used the value tool before calling — then booked a walk-through.',
                'profile_photo_url' => 'images/review-seller-c.jpg',
                'relative_time_description' => '3 weeks ago',
                'given_or_received' => 'received',
                'location' => 'Oak Hollow · demo',
            ],
        ];
    }
}
