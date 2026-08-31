<?php

/**
 * Seed listing, agent, and sample booking posts. Run via:
 *   wp eval-file bin/seed-cpts.php --path="$HOME/wp" --allow-root
 *   wp ks seed --path="$HOME/wp" --allow-root
 */

use App\Support\DemoContent;

DemoContent::cpts();

if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::success('Acreline listings, agents, and bookings seeded.');
}
