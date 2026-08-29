<?php

/**
 * Seed listing, agent, and sample booking posts. Run via:
 *   wp eval-file bin/seed-cpts.php --path="$HOME/wp" --allow-root
 */

use App\Support\Catalog;

$themeDir = dirname(__DIR__);

function ks_find_id(string $type, string $slug): int
{
    $found = get_posts([
        'post_type' => $type,
        'name' => $slug,
        'post_status' => 'any',
        'numberposts' => 1,
        'fields' => 'ids',
    ]);

    return $found ? (int) $found[0] : 0;
}

function ks_upsert(string $type, string $slug, string $title, array $meta, string $content = ''): int
{
    $id = ks_find_id($type, $slug);
    $payload = [
        'post_type' => $type,
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_content' => $content,
    ];

    if ($id) {
        $payload['ID'] = $id;
        wp_update_post($payload);
    } else {
        $id = (int) wp_insert_post($payload);
        WP_CLI::log("Created {$type} /{$slug}");
    }

    foreach ($meta as $key => $value) {
        Catalog::updateMeta($id, $key, $value);
    }

    return $id;
}

$agents = json_decode((string) file_get_contents($themeDir.'/resources/seed/agents.json'), true) ?: [];
$agentIds = [];
foreach ($agents as $agent) {
    $meta = $agent;
    unset($meta['slug'], $meta['name']);
    $agentIds[$agent['slug']] = ks_upsert(Catalog::AGENT, $agent['slug'], $agent['name'], $meta, $agent['bio'] ?? '');
}

$listings = json_decode((string) file_get_contents($themeDir.'/resources/seed/listings.json'), true) ?: [];
foreach ($listings as $item) {
    $meta = $item;
    unset($meta['slug'], $meta['title'], $meta['agent']);
    $agentSlug = $item['agent'] ?? '';
    if ($agentSlug && isset($agentIds[$agentSlug])) {
        $meta['listing_agent'] = $agentIds[$agentSlug];
    }
    ks_upsert(Catalog::LISTING, $item['slug'], $item['title'], $meta, $item['description'] ?? '');
}

if (! ks_find_id(Catalog::BOOKING, 'sample-showing-requested')) {
    $firstListing = $listings[0] ?? null;
    $listingId = $firstListing ? ks_find_id(Catalog::LISTING, $firstListing['slug']) : 0;
    $bookingId = ks_upsert(Catalog::BOOKING, 'sample-showing-requested', 'Alex Buyer — sample showing', [
        'listing_id' => $listingId,
        'listing_title' => $firstListing['title'] ?? 'Sample listing',
        'showing_date' => gmdate('Y-m-d', time() + DAY_IN_SECONDS * 3),
        'showing_time' => '10:30 AM',
        'showing_type' => 'in-person',
        'client_name' => 'Alex Buyer',
        'client_email' => 'alex@example.test',
        'client_phone' => '(555) 010-0199',
        'notes' => 'Seeded sample request so the Bookings pipeline is visible.',
        'status' => 'requested',
        'agent_id' => $agentIds['renee-musselman'] ?? 0,
    ]);
    WP_CLI::log("Created sample booking #{$bookingId}");
}

WP_CLI::success('Keystone listings, agents, and bookings seeded.');
