<?php

namespace App\View\Composers;

use App\Support\Catalog;
use App\Support\Faqs;
use App\Support\HeroImage;
use App\Support\PageCopy;
use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * @var array
     */
    protected static $views = [
        '*',
    ];

    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }

    public function with(): array
    {
        $copy = PageCopy::all();
        $heroOverride = is_array($copy) ? ($copy['hero_image'] ?? '') : '';
        $heroContext = PageCopy::schemaKeyForContext();
        $hero = HeroImage::forRequest($heroOverride, $heroContext);

        return [
            'copy' => $copy,
            'hero_image_url' => $hero['url'],
            'hero_image_srcset' => $hero['srcset'],
            'hero_image_alt' => $hero['alt'],
            'catalogListings' => Catalog::listings(),
            'spotlightListings' => Catalog::featuredListings(3),
            'catalogAgents' => Catalog::agents(),
            'catalogTownships' => Catalog::townships(),
            'selectedListingId' => (int) ($_GET['listing_id'] ?? $_GET['listing'] ?? 0),
            'showingTypes' => Catalog::SHOWING_TYPES,
            'areaCards' => PageCopy::areaCards(),
            'faqs' => Faqs::forContext(),
            'keystone' => [
                'homeUrl' => home_url('/'),
                'listingsUrl' => home_url('/listings'),
                'bookUrl' => home_url('/book/'),
                'blogUrl' => home_url('/blog'),
                'restUrl' => rest_url('keystone/v1/'),
                'nonce' => wp_create_nonce('wp_rest'),
                'listings' => Catalog::listings(),
            ],
        ];
    }
}
