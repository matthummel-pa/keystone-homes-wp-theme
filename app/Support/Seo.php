<?php

namespace App\Support;

/**
 * Native title, description, canonical, Open Graph, Twitter, and JSON-LD.
 * Yields when a major SEO plugin is active.
 */
class Seo
{
    public const SITE = 'Keystone Homes & Land';

    public const FALLBACK = 'Sample farms, historic houses, and acreage in Adams County. Filter listings and book a fictional showing — Keystone Homes & Land concept demo.';

    public static function boot(): void
    {
        add_filter('document_title_parts', [self::class, 'titleParts']);
        add_filter('document_title_separator', fn () => '|');
        add_action('wp_head', [self::class, 'printTags'], 2);
    }

    public static function pluginOwnsHead(): bool
    {
        return defined('WPSEO_VERSION')
            || defined('RANK_MATH_VERSION')
            || defined('AIOSEO_VERSION')
            || defined('SEOPRESS_VERSION')
            || defined('THE_SEO_FRAMEWORK_VERSION');
    }

    /**
     * @param  array<string, string>  $parts
     * @return array<string, string>
     */
    public static function titleParts(array $parts): array
    {
        if (is_front_page()) {
            return [
                'title' => 'Keystone Homes & Land · Adams County farms',
                'tagline' => '',
                'site' => '',
            ];
        }

        $copy = PageCopy::all();
        if (is_404()) {
            $parts['title'] = 'Page not found';
        } elseif (is_singular('listing') || is_singular('agent') || is_singular('post')) {
            $parts['title'] = self::clip(self::plain((string) get_the_title()), 42);
        } elseif (! empty($copy['hero_title'])) {
            $parts['title'] = self::clip(self::plain($copy['hero_title']), 42);
        }

        $parts['site'] = self::SITE;
        unset($parts['tagline']);

        return $parts;
    }

    public static function printTags(): void
    {
        if (is_admin() || wp_doing_ajax() || (function_exists('wp_is_serving_rest_request') && wp_is_serving_rest_request())) {
            return;
        }
        if (defined('REST_REQUEST') && REST_REQUEST) {
            return;
        }
        if (is_feed()) {
            return;
        }
        if (self::pluginOwnsHead()) {
            return;
        }

        $meta = self::meta();

        echo '<meta name="description" content="'.esc_attr($meta['description']).'">'."\n";
        echo '<link rel="canonical" href="'.esc_url($meta['url']).'">'."\n";
        echo '<meta property="og:locale" content="en_US">'."\n";
        echo '<meta property="og:site_name" content="'.esc_attr(self::SITE).'">'."\n";
        echo '<meta property="og:type" content="'.esc_attr($meta['type']).'">'."\n";
        echo '<meta property="og:title" content="'.esc_attr($meta['og_title']).'">'."\n";
        echo '<meta property="og:description" content="'.esc_attr($meta['description']).'">'."\n";
        echo '<meta property="og:url" content="'.esc_url($meta['url']).'">'."\n";
        echo '<meta property="og:image" content="'.esc_url($meta['image']).'">'."\n";
        echo '<meta property="og:image:width" content="1600">'."\n";
        echo '<meta property="og:image:height" content="900">'."\n";
        echo '<meta property="og:image:alt" content="'.esc_attr($meta['image_alt']).'">'."\n";
        echo '<meta name="twitter:card" content="summary_large_image">'."\n";
        echo '<meta name="twitter:title" content="'.esc_attr($meta['og_title']).'">'."\n";
        echo '<meta name="twitter:description" content="'.esc_attr($meta['description']).'">'."\n";
        echo '<meta name="twitter:image" content="'.esc_url($meta['image']).'">'."\n";

        if ($meta['jsonld'] !== []) {
            echo '<script type="application/ld+json">'.wp_json_encode($meta['jsonld'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>'."\n";
        }
    }

    /**
     * @return array{url: string, description: string, og_title: string, image: string, image_alt: string, type: string, jsonld: list<array<string, mixed>>}
     */
    public static function meta(): array
    {
        $copy = PageCopy::all();
        $context = PageCopy::schemaKeyForContext();
        $hero = HeroImage::forRequest(is_array($copy) ? ($copy['hero_image'] ?? '') : '', $context);
        $url = self::canonical();
        $description = self::description($copy);
        $ogTitle = self::ogTitle($copy);

        return [
            'url' => $url,
            'description' => $description,
            'og_title' => $ogTitle,
            'image' => $hero['url'],
            'image_alt' => $hero['alt'],
            'type' => is_singular('post') ? 'article' : 'website',
            'jsonld' => self::jsonLd($url, $ogTitle, $description, $hero),
        ];
    }

    public static function canonical(): string
    {
        if (is_front_page()) {
            return home_url('/');
        }
        if (is_home()) {
            $id = (int) get_option('page_for_posts');

            return $id > 0 ? (string) get_permalink($id) : home_url('/blog/');
        }
        if (is_singular()) {
            return (string) get_permalink();
        }

        return home_url('/');
    }

    /**
     * @param  array<string, string>  $copy
     */
    public static function description(array $copy): string
    {
        if (is_singular('listing')) {
            $listing = Catalog::listing((int) get_the_ID());
            if ($listing && $listing['desc'] !== '') {
                return self::fitDescription($listing['desc']);
            }
        }
        if (is_singular('agent')) {
            $agent = Catalog::agent((int) get_the_ID());
            if ($agent && $agent['bio'] !== '') {
                return self::fitDescription($agent['bio']);
            }
        }
        if (is_singular('post')) {
            if (has_excerpt()) {
                return self::fitDescription(get_the_excerpt());
            }
        }
        if (is_404()) {
            return 'That Keystone demo page is missing. Browse sample listings, book a showing, or return home to keep walking the Adams County concept site today.';
        }

        $fromCopy = self::plain($copy['hero_text'] ?? '');
        if ($fromCopy !== '') {
            return self::fitDescription($fromCopy);
        }

        $context = PageCopy::schemaKeyForContext();
        $defaults = self::defaultDescriptions();

        return $defaults[$context] ?? self::FALLBACK;
    }

    /**
     * @param  array<string, string>  $copy
     */
    public static function ogTitle(array $copy): string
    {
        if (is_front_page()) {
            return 'Keystone Homes & Land · Adams County farms';
        }
        if (is_singular()) {
            return self::clip(self::plain((string) get_the_title()).' | '.self::SITE, 70);
        }
        if (! empty($copy['hero_title'])) {
            return self::clip(self::plain($copy['hero_title']).' | '.self::SITE, 70);
        }

        return self::SITE;
    }

    /**
     * @param  array{url: string, alt: string}  $hero
     * @return list<array<string, mixed>>
     */
    public static function jsonLd(string $url, string $title, string $description, array $hero): array
    {
        $graph = [];
        $crumbs = self::breadcrumbs($url);
        if ($crumbs !== []) {
            $graph[] = $crumbs;
        }

        if (is_singular('post')) {
            $graph[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => self::plain((string) get_the_title()),
                'description' => $description,
                'image' => $hero['url'],
                'url' => $url,
                'datePublished' => get_the_date('c'),
                'dateModified' => get_the_modified_date('c'),
                'author' => [
                    '@type' => 'Organization',
                    'name' => self::SITE,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => self::SITE,
                    'url' => home_url('/'),
                ],
            ];
        } elseif (! is_singular('listing') && ! is_front_page()) {
            $graph[] = [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => $title,
                'description' => $description,
                'url' => $url,
                'image' => $hero['url'],
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => self::SITE,
                    'url' => home_url('/'),
                ],
            ];
        }

        return $graph;
    }

    /**
     * @return array<string, mixed>
     */
    public static function breadcrumbs(string $currentUrl): array
    {
        $items = [
            ['name' => 'Home', 'url' => home_url('/')],
        ];

        if (is_front_page()) {
            return [];
        }
        if (is_singular('listing')) {
            $items[] = ['name' => 'Listings', 'url' => home_url('/listings')];
            $items[] = ['name' => self::plain((string) get_the_title()), 'url' => $currentUrl];
        } elseif (is_singular('agent')) {
            $items[] = ['name' => 'Agents', 'url' => home_url('/agents')];
            $items[] = ['name' => self::plain((string) get_the_title()), 'url' => $currentUrl];
        } elseif (is_singular('post') || is_home()) {
            $items[] = ['name' => 'Blog', 'url' => home_url('/blog')];
            if (is_singular('post')) {
                $items[] = ['name' => self::plain((string) get_the_title()), 'url' => $currentUrl];
            }
        } elseif (is_404()) {
            $items[] = ['name' => 'Page not found', 'url' => $currentUrl];
        } else {
            $items[] = ['name' => self::plain((string) (PageCopy::all()['hero_title'] ?? get_the_title())), 'url' => $currentUrl];
        }

        $list = [];
        foreach ($items as $i => $item) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $list,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function defaultDescriptions(): array
    {
        return [
            'home' => 'Farms, historic houses, and acreage across Adams County townships. Filter sample inventory, estimate payments, and book a fictional house showing today.',
            'listings' => 'Browse eight fictional farms, historic houses, and acreage parcels. Filter by type, price, acres, and township — then book a demo tour with an agent.',
            'areas' => 'Township-by-township reads of rural Adams County: orchards, farms, and wooded lots from Franklin to Liberty. Fictional area pages written for local SEO.',
            'guide' => 'Plain-language notes on wells, septic, access, and land loans in Adams County. Demo calculators plus a path to book a sample parcel showing next.',
            'agents' => 'Meet the sample Keystone team. Local agents for farms, orchards, and century houses — fictional 555 lines and concept bios, not a live roster yet.',
            'contact' => 'Reach the Keystone concept office at 100 Concept Way, Sample Borough, PA. Call (555) 010-0455 or book a fictional house showing online today.',
            'book' => 'Pick a sample listing, date, and time slot. Showing requests save as Bookings in Requested status — this demo does not send email or texts out.',
            'blog' => 'Short realtor notes on house showings, first-time buyer checklists, and land vs home search — ready to adapt for Adams County local SEO work.',
            'simple' => self::FALLBACK,
        ];
    }

    public static function plain(string $html): string
    {
        $text = wp_strip_all_tags(html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        return trim((string) preg_replace('/\s+/', ' ', $text));
    }

    public static function clip(string $text, int $max): string
    {
        if (mb_strlen($text) <= $max) {
            return $text;
        }
        $cut = mb_substr($text, 0, $max - 1);
        $space = mb_strrpos($cut, ' ');
        if ($space !== false && $space > (int) ($max * 0.55)) {
            $cut = mb_substr($cut, 0, $space);
        }

        return rtrim($cut, '.,;: ').'…';
    }

    public static function fitDescription(string $text): string
    {
        $text = self::plain($text);
        $len = mb_strlen($text);
        if ($len >= 140 && $len <= 160) {
            return $text;
        }
        if ($len > 160) {
            return self::clip($text, 160);
        }

        return $text !== '' ? $text : self::FALLBACK;
    }
}
