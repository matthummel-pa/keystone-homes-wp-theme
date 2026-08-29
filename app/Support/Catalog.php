<?php

namespace App\Support;

use WP_Post;
use WP_Query;

class Catalog
{
    public const LISTING = 'listing';

    public const BOOKING = 'booking';

    public const AGENT = 'agent';

    public const LISTING_TYPES = [
        'home' => 'Home',
        'farm' => 'Working Farm',
        'land' => 'Land / Acreage',
        'historic' => 'Historic Home',
    ];

    public const LISTING_STATUSES = [
        'active' => 'Active',
        'new' => 'New',
        'pending' => 'Pending',
        'sold' => 'Sold',
    ];

    public const BOOKING_STATUSES = [
        'requested' => 'Requested',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    public const SHOWING_TYPES = [
        'in-person' => 'In-person tour',
        'preview' => 'Private preview',
        'virtual' => 'Virtual walk-through',
    ];

    /**
     * Listing meta keys stored on the listing CPT (no leading underscore so WP-CLI can set them easily).
     *
     * @return array<string, string>
     */
    public static function listingFields(): array
    {
        return [
            'type' => 'Property type',
            'status' => 'Status',
            'address' => 'Street address',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'ZIP',
            'township' => 'Township',
            'price' => 'List price',
            'beds' => 'Beds',
            'baths' => 'Baths',
            'sqft' => 'Square feet',
            'acres' => 'Acres',
            'year_built' => 'Year built',
            'mls_number' => 'MLS number',
            'lat' => 'Map pin top %',
            'lng' => 'Map pin left %',
            'photo_grad' => 'Card gradient (fallback)',
            'image' => 'Photo URL (if no featured image)',
            'virtual_tour' => 'Virtual tour URL',
            'property_tax' => 'Annual taxes',
            'hoa' => 'HOA / dues',
            'listing_agent' => 'Listing agent (agent post ID)',
            'featured' => 'Featured on homepage (1/0)',
            'description' => 'Listing description',
        ];
    }

    /**
     * Standard agent fields used across realtor sites.
     *
     * @return array<string, string>
     */
    public static function agentFields(): array
    {
        return [
            'job_title' => 'Title / designation',
            'license_number' => 'License number',
            'license_state' => 'License state',
            'phone' => 'Direct phone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'office' => 'Office name',
            'office_phone' => 'Office phone',
            'years_experience' => 'Years of experience',
            'specialties' => 'Specialties',
            'service_areas' => 'Service areas',
            'languages' => 'Languages',
            'designations' => 'Designations (ABR, CRS, GRI…)',
            'mls_id' => 'MLS ID',
            'nrds_id' => 'NRDS ID',
            'website' => 'Personal website',
            'calendly' => 'Booking / calendar URL',
            'facebook' => 'Facebook URL',
            'instagram' => 'Instagram URL',
            'linkedin' => 'LinkedIn URL',
            'initials' => 'Avatar initials',
            'avatar_color' => 'Avatar color',
            'featured' => 'Featured (1/0)',
            'bio' => 'Bio',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function bookingFields(): array
    {
        return [
            'listing_id' => 'Listing ID',
            'listing_title' => 'Listing title (snapshot)',
            'showing_date' => 'Showing date',
            'showing_time' => 'Showing time',
            'showing_type' => 'Showing type',
            'client_name' => 'Client name',
            'client_email' => 'Client email',
            'client_phone' => 'Client phone',
            'notes' => 'Notes',
            'status' => 'Status',
            'agent_id' => 'Assigned agent ID',
        ];
    }

    public static function metaKey(string $field): string
    {
        return 'ks_'.$field;
    }

    public static function getMeta(int $postId, string $field, mixed $default = ''): mixed
    {
        $value = get_post_meta($postId, self::metaKey($field), true);

        return $value === '' || $value === false ? $default : $value;
    }

    public static function updateMeta(int $postId, string $field, mixed $value): void
    {
        update_post_meta($postId, self::metaKey($field), $value);
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function listings(): array
    {
        $query = new WP_Query([
            'post_type' => self::LISTING,
            'post_status' => 'publish',
            'posts_per_page' => 100,
            'orderby' => ['menu_order' => 'ASC', 'date' => 'ASC'],
            'no_found_rows' => true,
        ]);

        $items = array_map([self::class, 'listingToArray'], $query->posts);
        wp_reset_postdata();

        return $items;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function featuredListings(int $limit = 3): array
    {
        $featured = array_values(array_filter(self::listings(), fn ($item) => ! empty($item['featured'])));

        if ($featured === []) {
            $featured = array_values(array_filter(self::listings(), fn ($item) => $item['type'] !== 'land'));
        }

        return array_slice($featured, 0, $limit);
    }

    /**
     * @return list<string>
     */
    public static function townships(): array
    {
        $towns = [];
        foreach (self::listings() as $listing) {
            if ($listing['township'] !== '') {
                $towns[$listing['township']] = $listing['township'];
            }
        }
        ksort($towns);

        return array_values($towns);
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function agents(): array
    {
        $query = new WP_Query([
            'post_type' => self::AGENT,
            'post_status' => 'publish',
            'posts_per_page' => 50,
            'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'],
            'no_found_rows' => true,
        ]);

        $items = array_map([self::class, 'agentToArray'], $query->posts);
        wp_reset_postdata();

        return $items;
    }

    public static function agent(int $id): ?array
    {
        $post = get_post($id);
        if (! $post instanceof WP_Post || $post->post_type !== self::AGENT) {
            return null;
        }

        return self::agentToArray($post);
    }

    public static function listing(int $id): ?array
    {
        $post = get_post($id);
        if (! $post instanceof WP_Post || $post->post_type !== self::LISTING) {
            return null;
        }

        return self::listingToArray($post);
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function listingsForAgent(int $agentId): array
    {
        return array_values(array_filter(
            self::listings(),
            fn ($item) => (int) $item['listing_agent'] === $agentId
        ));
    }

    public static function listingToArray(WP_Post $post): array
    {
        $type = (string) self::getMeta($post->ID, 'type', 'home');
        $image = get_the_post_thumbnail_url($post, 'large') ?: (string) self::getMeta($post->ID, 'image', '');

        return [
            'id' => (int) $post->ID,
            'slug' => $post->post_name,
            'permalink' => get_permalink($post),
            'title' => get_the_title($post),
            'desc' => (string) (self::getMeta($post->ID, 'description', '') ?: wp_strip_all_tags($post->post_content)),
            'type' => $type,
            'typeLabel' => self::LISTING_TYPES[$type] ?? 'Home',
            'status' => (string) self::getMeta($post->ID, 'status', 'active'),
            'address' => (string) self::getMeta($post->ID, 'address', ''),
            'city' => (string) self::getMeta($post->ID, 'city', ''),
            'state' => (string) self::getMeta($post->ID, 'state', 'PA'),
            'zip' => (string) self::getMeta($post->ID, 'zip', ''),
            'township' => (string) self::getMeta($post->ID, 'township', ''),
            'price' => (int) self::getMeta($post->ID, 'price', 0),
            'beds' => (float) self::getMeta($post->ID, 'beds', 0),
            'baths' => (float) self::getMeta($post->ID, 'baths', 0),
            'sqft' => (int) self::getMeta($post->ID, 'sqft', 0),
            'acres' => (float) self::getMeta($post->ID, 'acres', 0),
            'year_built' => (string) self::getMeta($post->ID, 'year_built', ''),
            'mls_number' => (string) self::getMeta($post->ID, 'mls_number', ''),
            'lat' => (float) self::getMeta($post->ID, 'lat', 40),
            'lng' => (float) self::getMeta($post->ID, 'lng', 40),
            'grad' => (string) self::getMeta($post->ID, 'photo_grad', 'linear-gradient(135deg,#155539,#1f6b4a)'),
            'image' => $image,
            'virtual_tour' => (string) self::getMeta($post->ID, 'virtual_tour', ''),
            'property_tax' => (string) self::getMeta($post->ID, 'property_tax', ''),
            'hoa' => (string) self::getMeta($post->ID, 'hoa', ''),
            'listing_agent' => (int) self::getMeta($post->ID, 'listing_agent', 0),
            'featured' => (bool) self::getMeta($post->ID, 'featured', 0),
        ];
    }

    public static function agentToArray(WP_Post $post): array
    {
        $photo = get_the_post_thumbnail_url($post, 'medium');

        return [
            'id' => (int) $post->ID,
            'slug' => $post->post_name,
            'permalink' => get_permalink($post),
            'name' => get_the_title($post),
            'bio' => (string) (self::getMeta($post->ID, 'bio', '') ?: wp_strip_all_tags($post->post_content)),
            'job_title' => (string) self::getMeta($post->ID, 'job_title', 'Realtor'),
            'license_number' => (string) self::getMeta($post->ID, 'license_number', ''),
            'license_state' => (string) self::getMeta($post->ID, 'license_state', 'PA'),
            'phone' => (string) self::getMeta($post->ID, 'phone', ''),
            'mobile' => (string) self::getMeta($post->ID, 'mobile', ''),
            'email' => (string) self::getMeta($post->ID, 'email', ''),
            'office' => (string) self::getMeta($post->ID, 'office', 'Keystone Homes & Land'),
            'office_phone' => (string) self::getMeta($post->ID, 'office_phone', '(555) 010-0455'),
            'years_experience' => (string) self::getMeta($post->ID, 'years_experience', ''),
            'specialties' => (string) self::getMeta($post->ID, 'specialties', ''),
            'service_areas' => (string) self::getMeta($post->ID, 'service_areas', ''),
            'languages' => (string) self::getMeta($post->ID, 'languages', 'English'),
            'designations' => (string) self::getMeta($post->ID, 'designations', ''),
            'mls_id' => (string) self::getMeta($post->ID, 'mls_id', ''),
            'nrds_id' => (string) self::getMeta($post->ID, 'nrds_id', ''),
            'website' => (string) self::getMeta($post->ID, 'website', ''),
            'calendly' => (string) self::getMeta($post->ID, 'calendly', ''),
            'facebook' => (string) self::getMeta($post->ID, 'facebook', ''),
            'instagram' => (string) self::getMeta($post->ID, 'instagram', ''),
            'linkedin' => (string) self::getMeta($post->ID, 'linkedin', ''),
            'initials' => (string) self::getMeta($post->ID, 'initials', self::initials(get_the_title($post))),
            'avatar_color' => (string) self::getMeta($post->ID, 'avatar_color', 'var(--accent)'),
            'photo' => $photo ?: '',
            'featured' => (bool) self::getMeta($post->ID, 'featured', 0),
        ];
    }

    public static function formatMoney(int $amount): string
    {
        return '$'.number_format($amount);
    }

    public static function nextBookingStatus(string $status): ?string
    {
        return match ($status) {
            'requested' => 'confirmed',
            'confirmed' => 'completed',
            default => null,
        };
    }

    public static function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $letters = array_map(fn ($part) => strtoupper(substr($part, 0, 1)), array_slice($parts, 0, 2));

        return implode('', $letters) ?: 'KH';
    }

    public static function telHref(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone) ?? '';

        return $digits !== '' ? 'tel:+1'.$digits : '#';
    }
}
