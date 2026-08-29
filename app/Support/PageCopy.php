<?php

namespace App\Support;

class PageCopy
{
    /**
     * @return array<string, array<string, array{label: string, type: string, default: string}>>
     */
    public static function schemas(): array
    {
        $hero = fn (string $eyebrow, string $title, string $text) => [
            'hero_brand' => ['label' => 'Hero brand', 'type' => 'text', 'default' => 'Keystone Homes & Land'],
            'hero_eyebrow' => ['label' => 'Hero eyebrow', 'type' => 'text', 'default' => $eyebrow],
            'hero_title' => ['label' => 'Hero title (use <em> for italics)', 'type' => 'text', 'default' => $title],
            'hero_text' => ['label' => 'Hero intro', 'type' => 'textarea', 'default' => $text],
            'hero_image' => ['label' => 'Hero image', 'type' => 'image', 'default' => ''],
        ];

        $cta = [
            'cta_title' => ['label' => 'Bottom CTA title', 'type' => 'text', 'default' => ''],
            'cta_text' => ['label' => 'Bottom CTA text', 'type' => 'textarea', 'default' => ''],
            'cta_primary' => ['label' => 'Primary CTA label', 'type' => 'text', 'default' => 'Book a showing'],
            'cta_secondary' => ['label' => 'Secondary CTA label', 'type' => 'text', 'default' => 'Contact the office'],
        ];

        return [
            'home' => $hero(
                'Adams County, Pennsylvania',
                'Homes worth <em>walking through.</em>',
                'Farms, historic houses, and acreage across North Ridge, Mill Creek, and Oak Hollow. Filter by township, then book a showing.'
            ) + [
                'intent_eyebrow' => ['label' => 'Start-here eyebrow', 'type' => 'text', 'default' => 'Start here'],
                'intent_title' => ['label' => 'Start-here title', 'type' => 'text', 'default' => 'Buy, sell, or walk a place in Adams County'],
                'intent_text' => ['label' => 'Start-here intro', 'type' => 'textarea', 'default' => 'Farms, historic houses, and acreage need different next steps. Scan sample inventory, run a value range, or book a showing — stay on the page, no brochure maze.'],
                'intent_buy_title' => ['label' => 'Buy card title', 'type' => 'text', 'default' => 'Buy a home, farm, or land'],
                'intent_buy_lead' => ['label' => 'Buy card text', 'type' => 'textarea', 'default' => 'Filter sample homes, working farms, and acreage by township — North Ridge, Mill Creek, and Oak Hollow. Scan price, beds, and usable acres on a grid or map.'],
                'intent_buy_b1' => ['label' => 'Buy bullet 1', 'type' => 'text', 'default' => 'Homes, farms, land, and historic houses'],
                'intent_buy_b2' => ['label' => 'Buy bullet 2', 'type' => 'text', 'default' => 'Township, price, and acreage filters'],
                'intent_buy_cta' => ['label' => 'Buy card CTA', 'type' => 'text', 'default' => 'Browse listings'],
                'intent_sell_title' => ['label' => 'Sell card title', 'type' => 'text', 'default' => 'Price a place before you list'],
                'intent_sell_lead' => ['label' => 'Sell card text', 'type' => 'textarea', 'default' => 'Run a demo value range for a fictional address, then see how a CMA request would feel. Not an appraisal — a clear next step for sellers comparing options.'],
                'intent_sell_b1' => ['label' => 'Sell bullet 1', 'type' => 'text', 'default' => 'Instant sample value range'],
                'intent_sell_b2' => ['label' => 'Sell bullet 2', 'type' => 'text', 'default' => 'Alert path for new matches'],
                'intent_sell_cta' => ['label' => 'Sell card CTA', 'type' => 'text', 'default' => 'Estimate value'],
                'intent_tour_title' => ['label' => 'Tour card title', 'type' => 'text', 'default' => 'Walk it with an agent'],
                'intent_tour_lead' => ['label' => 'Tour card text', 'type' => 'textarea', 'default' => 'Pick a sample listing, a date, and a time. The request is saved for the listing agent. Rural Adams County showings often mean a lane, a well, and boots.'],
                'intent_tour_b1' => ['label' => 'Tour bullet 1', 'type' => 'text', 'default' => 'Date and time-slot picker'],
                'intent_tour_b2' => ['label' => 'Tour bullet 2', 'type' => 'text', 'default' => 'Paired with the listing agent'],
                'intent_tour_cta' => ['label' => 'Tour card CTA', 'type' => 'text', 'default' => 'Book a showing'],
                'intent_notes_label' => ['label' => 'Help notes label', 'type' => 'text', 'default' => 'Good to know before you filter'],
                'intent_note_1_title' => ['label' => 'Help note 1 title', 'type' => 'text', 'default' => 'Township first'],
                'intent_note_1_text' => ['label' => 'Help note 1 text', 'type' => 'textarea', 'default' => 'Zoning, lot size, and Clean and Green (Act 319) change from North Ridge to Oak Hollow. Pick an area before you fall for a photo.'],
                'intent_note_2_title' => ['label' => 'Help note 2 title', 'type' => 'text', 'default' => 'Water and waste'],
                'intent_note_2_text' => ['label' => 'Help note 2 text', 'type' => 'textarea', 'default' => 'Rural parcels often mean a well and a perc test, not municipal hookups. Walk that before you write an offer.'],
                'intent_note_3_title' => ['label' => 'Help note 3 title', 'type' => 'text', 'default' => 'Showings are muddy'],
                'intent_note_3_text' => ['label' => 'Help note 3 text', 'type' => 'textarea', 'default' => 'Lanes, gates, and wet ground. Wear boots. Mention pets or if you are new to land — the agent can prep.'],
                'search_eyebrow' => ['label' => 'Search eyebrow', 'type' => 'text', 'default' => 'Find'],
                'search_title' => ['label' => 'Search title', 'type' => 'text', 'default' => 'Search sample inventory'],
                'search_text' => ['label' => 'Search intro', 'type' => 'textarea', 'default' => 'Short filters. Fast scan. Every result is fictional demo data.'],
                'hero_cta_primary' => ['label' => 'Hero search button', 'type' => 'text', 'default' => 'Show matches'],
                'hero_cta_secondary' => ['label' => 'Hero browse link', 'type' => 'text', 'default' => 'Browse all listings'],
                'spotlight_eyebrow' => ['label' => 'Spotlight eyebrow', 'type' => 'text', 'default' => 'Spotlight'],
                'spotlight_title' => ['label' => 'Spotlight title', 'type' => 'text', 'default' => 'Three sample homes to scan'],
                'spotlight_text' => ['label' => 'Spotlight intro', 'type' => 'textarea', 'default' => 'Price · beds · acres — then book a fictional walk-through.'],
                'book_eyebrow' => ['label' => 'Booking eyebrow', 'type' => 'text', 'default' => 'Appointments'],
                'book_title' => ['label' => 'Booking title', 'type' => 'text', 'default' => 'Book a house showing'],
                'book_text' => ['label' => 'Booking intro', 'type' => 'textarea', 'default' => 'Demo scheduler for touring sample homes. Requests are saved to Bookings as Requested.'],
            ],
            'listings' => $hero('Sample inventory', 'Sample homes &amp; land <em>for demo tours</em>', 'Eight fictional properties for layout and filter testing. Switch grid or map — nothing here is a live MLS feed.') + [
                'intro_title' => ['label' => 'Local note title', 'type' => 'text', 'default' => 'Buying rural property in Adams County'],
                'intro_text' => ['label' => 'Local note', 'type' => 'textarea', 'default' => 'Every parcel we list sits in a specific Adams County township, and that matters more than most buyers expect. Zoning, minimum lot sizes, agricultural-security areas and clean-and-green (Act 319) tax enrollment all change from Franklin Township to Cumberland to Straban.'],
            ] + $cta + [
                'cta_title' => ['label' => 'Bottom CTA title', 'type' => 'text', 'default' => 'See a property you like?'],
                'cta_text' => ['label' => 'Bottom CTA text', 'type' => 'textarea', 'default' => 'Book a walkthrough with a local Keystone agent, or run the numbers first with our land-loan and pre-qualification tools.'],
                'cta_secondary' => ['label' => 'Secondary CTA label', 'type' => 'text', 'default' => 'Financing tools'],
            ],
            'areas' => $hero('Sample markets', 'Areas we <em>demo</em>', 'Fictional North Ridge, Mill Creek and Oak Hollow profiles — written for scannable area-page SEO.') + [
                'intro_title' => ['label' => 'Intro title', 'type' => 'text', 'default' => 'Land, farms &amp; homesteads across Adams County'],
                'intro_text' => ['label' => 'Intro', 'type' => 'textarea', 'default' => 'Our office sits at 100 Concept Way on the north edge of Gettysburg. Rural Adams County is fruit-belt country — the ridges hold orchards and the valley floors are strong farmland. The six townships below are where we spend most of our boot leather.'],
                'grid_eyebrow' => ['label' => 'Grid eyebrow', 'type' => 'text', 'default' => 'Township by Township'],
                'grid_title' => ['label' => 'Grid title', 'type' => 'text', 'default' => 'Where we work'],
                'grid_text' => ['label' => 'Grid intro', 'type' => 'textarea', 'default' => 'A quick, honest read on six rural Adams County townships — what the ground is like, what tends to come up for sale, and what a buyer should watch for.'],
                'area_1_meta' => ['label' => 'Area 1 meta', 'type' => 'text', 'default' => 'Northwest of Gettysburg · off US-30 &amp; Herr\'s Ridge Rd'],
                'area_1_title' => ['label' => 'Area 1 title', 'type' => 'text', 'default' => 'Franklin Township'],
                'area_1_body' => ['label' => 'Area 1 body', 'type' => 'textarea', 'default' => 'Franklin Township runs from Herr\'s Ridge out toward Cashtown and the base of South Mountain — century stone homesteads, working orchards, and wooded building lots with long views.'],
                'area_2_meta' => ['label' => 'Area 2 meta', 'type' => 'text', 'default' => 'North of Gettysburg · Biglerville &amp; the fruit belt · US-15 / PA-34'],
                'area_2_title' => ['label' => 'Area 2 title', 'type' => 'text', 'default' => 'Menallen Township'],
                'area_2_body' => ['label' => 'Area 2 body', 'type' => 'textarea', 'default' => 'Menallen wraps around Biglerville and is the heart of Adams County apple country — packing houses, the fruit research station, and mile after mile of orchard.'],
                'area_3_meta' => ['label' => 'Area 3 meta', 'type' => 'text', 'default' => 'Northeast · around Biglerville &amp; Table Rock · PA-34'],
                'area_3_title' => ['label' => 'Area 3 title', 'type' => 'text', 'default' => 'Butler Township'],
                'area_3_body' => ['label' => 'Area 3 body', 'type' => 'textarea', 'default' => 'Butler Township mixes orchard ground with open rolling farmland and quiet residential lots — often more value per acre than parcels hugging the battlefield.'],
                'area_4_meta' => ['label' => 'Area 4 meta', 'type' => 'text', 'default' => 'North-central · Idaville &amp; Bendersville · PA-234'],
                'area_4_title' => ['label' => 'Area 4 title', 'type' => 'text', 'default' => 'Tyrone Township'],
                'area_4_body' => ['label' => 'Area 4 body', 'type' => 'textarea', 'default' => 'Tyrone Township is working-farm country: larger tracts of tillable and orchard ground. Buyers here are usually after real acreage rather than a single homesite.'],
                'area_5_meta' => ['label' => 'Area 5 meta', 'type' => 'text', 'default' => 'West · South Mountain, Fairfield &amp; Cashtown · PA-116'],
                'area_5_title' => ['label' => 'Area 5 title', 'type' => 'text', 'default' => 'Hamiltonban Township'],
                'area_5_body' => ['label' => 'Area 5 body', 'type' => 'textarea', 'default' => 'Hamiltonban is the county\'s mountain township — cabins, wooded acreage, hunting ground and recreational parcels toward Michaux State Forest.'],
                'area_6_meta' => ['label' => 'Area 6 meta', 'type' => 'text', 'default' => 'Southwest · Fairfield &amp; the Maryland line · PA-116'],
                'area_6_title' => ['label' => 'Area 6 title', 'type' => 'text', 'default' => 'Liberty Township'],
                'area_6_body' => ['label' => 'Area 6 body', 'type' => 'textarea', 'default' => 'Liberty Township runs down to the Mason-Dixon line below Fairfield — small farms, pasture and wooded homesteads with an easy commute toward Frederick, Maryland.'],
            ] + $cta + [
                'cta_title' => ['label' => 'Bottom CTA title', 'type' => 'text', 'default' => 'Walk a township with us'],
                'cta_text' => ['label' => 'Bottom CTA text', 'type' => 'textarea', 'default' => 'Tell us which corner of Sample County you want to understand, and we\'ll match you with the agent who knows that ground.'],
            ],
            'guide' => $hero('Buyer tools', 'A clearer path to <em>buying land or a home</em>', 'Short guides and demo calculators. Use with the showing scheduler for a full agent workflow.') + [
                'intro_title' => ['label' => 'Intro title', 'type' => 'text', 'default' => 'What\'s different about buying land'],
                'intro_text' => ['label' => 'Intro', 'type' => 'textarea', 'default' => 'When you buy an existing home, utilities are usually sorted. Out in the townships you often have to prove water, septic and access yourself — and those answers change the value of the ground.'],
                'tools_eyebrow' => ['label' => 'Tools eyebrow', 'type' => 'text', 'default' => 'Run Your Numbers'],
                'tools_title' => ['label' => 'Tools title', 'type' => 'text', 'default' => 'Land-loan &amp; pre-qualification tools'],
                'tools_text' => ['label' => 'Tools intro', 'type' => 'textarea', 'default' => 'Friendly estimates to help you plan — not loan offers. A licensed lender will verify everything with full documentation.'],
            ] + $cta + [
                'cta_title' => ['label' => 'Bottom CTA title', 'type' => 'text', 'default' => 'Ready to walk a sample parcel?'],
                'cta_text' => ['label' => 'Bottom CTA text', 'type' => 'textarea', 'default' => 'Book a demo showing or browse the sample inventory.'],
                'cta_secondary' => ['label' => 'Secondary CTA label', 'type' => 'text', 'default' => 'Browse listings'],
            ],
            'agents' => $hero('Sample team', 'Agents who know the <em>demo ground</em>', 'Team profiles are Agent posts. Contact numbers are fictional 555 lines.') + [
                'intro_title' => ['label' => 'Intro title', 'type' => 'text', 'default' => 'A small, local team by design'],
                'intro_text' => ['label' => 'Intro', 'type' => 'textarea', 'default' => 'Keystone Homes &amp; Land was founded in Sample Borough in 2009 around a simple idea: rural property deserves an agent who understands rural property. Farms, orchards, raw land and century homesteads all come with questions a typical residential agent rarely faces.'],
                'how_eyebrow' => ['label' => 'How-we-work eyebrow', 'type' => 'text', 'default' => 'How We Work'],
                'how_title' => ['label' => 'How-we-work title', 'type' => 'text', 'default' => 'What working with Keystone looks like'],
                'how_text' => ['label' => 'How-we-work intro', 'type' => 'textarea', 'default' => 'No pressure, no jargon, and a straight answer about the ground under your feet.'],
            ] + $cta + [
                'cta_title' => ['label' => 'Bottom CTA title', 'type' => 'text', 'default' => 'Talk to a Keystone agent'],
                'cta_text' => ['label' => 'Bottom CTA text', 'type' => 'textarea', 'default' => 'Reach the office at (555) 010-0455, or book a no-pressure showing and we\'ll match you with the agent who knows your corner of Sample County best.'],
            ],
            'contact' => $hero('Concept office', 'Get in touch <em>(demo only)</em>', 'Fictional address and phone. Prefer booking a sample showing for the full appointment UX.') + [
                'office_title' => ['label' => 'Office heading', 'type' => 'text', 'default' => 'Keystone Homes &amp; Land'],
                'office_address' => ['label' => 'Address', 'type' => 'textarea', 'default' => "100 Concept Way\nSample Borough, PA 00000"],
                'office_phone' => ['label' => 'Phone', 'type' => 'text', 'default' => '(555) 010-0455'],
                'office_email' => ['label' => 'Email', 'type' => 'text', 'default' => 'hello@keystone-concept.test'],
                'office_hours' => ['label' => 'Hours', 'type' => 'textarea', 'default' => "Mon–Fri: 8:30am – 5:30pm\nSaturday: 9:00am – 1:00pm\nSunday: By appointment"],
                'form_title' => ['label' => 'Form title', 'type' => 'text', 'default' => 'Send us a message'],
                'form_text' => ['label' => 'Form intro', 'type' => 'textarea', 'default' => 'Tell us what you\'re looking for — or what you\'re thinking of selling — and we\'ll be in touch.'],
            ],
            'book' => $hero('Appointments', 'Book a house showing', 'Pick a listing, date and time. The request is saved as a Booking in Requested status — nothing is emailed.') + [
                'book_note' => ['label' => 'Form note', 'type' => 'text', 'default' => 'Demo only — no emails, texts or calendar invites are sent. Staff can advance the booking in WP Admin → Bookings.'],
            ],
            'blog' => $hero('Guide', 'Realtor notes you can publish', 'Sample posts for showings, buyer checklists, and land vs home search — ready to adapt for local SEO.') + $cta + [
                'cta_title' => ['label' => 'Bottom CTA title', 'type' => 'text', 'default' => 'Ready to tour a sample home?'],
                'cta_text' => ['label' => 'Bottom CTA text', 'type' => 'textarea', 'default' => 'Use the showing scheduler — property, date and time in one flow.'],
                'cta_secondary' => ['label' => 'Secondary CTA label', 'type' => 'text', 'default' => 'Browse samples'],
            ],
            'simple' => $hero('', '', '') + [
                'body' => ['label' => 'Page body', 'type' => 'textarea', 'default' => ''],
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function templateMap(): array
    {
        return [
            'front-page.blade.php' => 'home',
            'page-listings.blade.php' => 'listings',
            'page-areas.blade.php' => 'areas',
            'page-guide.blade.php' => 'guide',
            'page-agents.blade.php' => 'agents',
            'page-contact.blade.php' => 'contact',
            'page-book.blade.php' => 'book',
            'home.blade.php' => 'blog',
            'page.blade.php' => 'simple',
        ];
    }

    public static function schemaKeyForPost(int $postId): string
    {
        $slug = get_post_field('post_name', $postId);
        $bySlug = [
            'home' => 'home',
            'listings' => 'listings',
            'areas' => 'areas',
            'guide' => 'guide',
            'agents' => 'agents',
            'contact' => 'contact',
            'book' => 'book',
            'blog' => 'blog',
        ];
        if (isset($bySlug[$slug])) {
            return $bySlug[$slug];
        }

        $template = (string) get_page_template_slug($postId);
        $base = $template !== '' ? basename($template) : '';

        return self::templateMap()[$base] ?? 'simple';
    }

    public static function schemaKeyForContext(?int $postId = null): string
    {
        $virtual = DemoPages::currentSlug() ?? DemoPages::requestSlug();
        if ($virtual === 'blog') {
            return 'blog';
        }
        if ($virtual && isset(self::schemas()[$virtual])) {
            return $virtual;
        }

        $id = $postId ?? (int) (get_queried_object_id() ?: get_the_ID());
        if (function_exists('is_front_page') && is_front_page() && ! is_page()) {
            return 'home';
        }
        if ($id > 0) {
            return self::schemaKeyForPost($id);
        }
        if (function_exists('is_home') && is_home()) {
            return 'blog';
        }

        return 'simple';
    }

    /**
     * @return array<string, array{label: string, type: string, default: string}>
     */
    public static function schemaForPost(int $postId): array
    {
        $schemas = self::schemas();
        $key = self::schemaKeyForPost($postId);

        return $schemas[$key] ?? $schemas['simple'];
    }

    public static function field(string $key, string $default = '', ?int $postId = null): string
    {
        $id = $postId ?: (int) (get_queried_object_id() ?: get_the_ID());
        $stored = $id ? get_post_meta($id, Catalog::metaKey($key), true) : '';
        $value = ($stored === '' || $stored === false) ? $default : $stored;

        return wp_kses((string) $value, [
            'em' => [],
            'strong' => [],
            'br' => [],
            'a' => ['href' => [], 'class' => []],
        ]);
    }

    /**
     * @return array<string, string>
     */
    public static function all(?int $postId = null): array
    {
        $key = self::schemaKeyForContext($postId);
        $id = $postId ?: (int) (get_queried_object_id() ?: get_the_ID());
        if ($key === 'home' && function_exists('is_page') && ! is_page()) {
            $id = (int) get_option('page_on_front');
        }
        if (DemoPages::currentSlug()) {
            $id = 0;
        }
        $schemas = self::schemas();
        $schema = $schemas[$key] ?? $schemas['simple'];
        $out = [];
        foreach ($schema as $field => $def) {
            $out[$field] = self::field($field, $def['default'] ?? '', $id ?: null);
        }

        return $out;
    }

    /**
     * @return list<array{meta: string, title: string, body: string}>
     */
    public static function areaCards(?int $postId = null): array
    {
        $id = $postId ?: (int) get_the_ID();
        $copy = self::all($id);
        $cards = [];
        for ($i = 1; $i <= 6; $i++) {
            $title = $copy["area_{$i}_title"] ?? '';
            if ($title === '') {
                continue;
            }
            $cards[] = [
                'meta' => $copy["area_{$i}_meta"] ?? '',
                'title' => $title,
                'body' => $copy["area_{$i}_body"] ?? '',
            ];
        }

        return $cards;
    }
}
