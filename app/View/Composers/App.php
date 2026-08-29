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

    public function copy(): array
    {
        $id = (int) (get_queried_object_id() ?: get_the_ID());

        return $id ? PageCopy::all($id) : [];
    }

    public function catalogListings(): array
    {
        return Catalog::listings();
    }

    public function spotlightListings(): array
    {
        return Catalog::featuredListings(3);
    }

    public function catalogAgents(): array
    {
        return Catalog::agents();
    }

    public function catalogTownships(): array
    {
        return Catalog::townships();
    }

    public function selectedListingId(): int
    {
        return (int) ($_GET['listing'] ?? 0);
    }

    public function keystone(): array
    {
        return [
            'homeUrl' => home_url('/'),
            'listingsUrl' => home_url('/listings'),
            'bookUrl' => home_url('/book/'),
            'blogUrl' => home_url('/blog'),
            'restUrl' => rest_url('keystone/v1/'),
            'nonce' => wp_create_nonce('wp_rest'),
            'listings' => Catalog::listings(),
        ];
    }

    public function showingTypes(): array
    {
        return Catalog::SHOWING_TYPES;
    }

    public function areaCards(): array
    {
        return PageCopy::areaCards();
    }
}
