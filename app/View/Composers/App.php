<?php

namespace App\View\Composers;

use App\Support\Catalog;
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
        return [
            'copy' => PageCopy::all(),
            'catalogListings' => Catalog::listings(),
            'spotlightListings' => Catalog::featuredListings(3),
            'catalogAgents' => Catalog::agents(),
            'catalogTownships' => Catalog::townships(),
            'selectedListingId' => (int) ($_GET['listing'] ?? 0),
            'showingTypes' => Catalog::SHOWING_TYPES,
            'areaCards' => PageCopy::areaCards($id ?: null),
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
