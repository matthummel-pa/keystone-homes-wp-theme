<?php

namespace App\Support;

/**
 * Render marketing templates when WordPress pages have not been created yet.
 */
class DemoPages
{
    /**
     * Public path slug => Blade view name.
     *
     * @var array<string, string>
     */
    public const VIEWS = [
        'listings' => 'page-listings',
        'areas' => 'page-areas',
        'guide' => 'page-guide',
        'agents' => 'page-agents',
        'contact' => 'page-contact',
        'book' => 'page-book',
        'blog' => 'home',
    ];

    public static function currentSlug(): ?string
    {
        $slug = $GLOBALS['ks_virtual_page'] ?? null;

        return is_string($slug) && $slug !== '' ? $slug : null;
    }

    public static function requestSlug(): ?string
    {
        $path = (string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        $homePath = (string) parse_url((string) home_url('/'), PHP_URL_PATH);
        $path = trim($path, '/');
        $homePath = trim($homePath, '/');
        if ($homePath !== '' && str_starts_with($path, $homePath.'/')) {
            $path = substr($path, strlen($homePath) + 1);
        } elseif ($path === $homePath) {
            $path = '';
        }
        if ($path === '') {
            return null;
        }
        $slug = explode('/', $path)[0] ?? '';

        return isset(self::VIEWS[$slug]) ? $slug : null;
    }

    public static function viewForSlug(?string $slug): ?string
    {
        return $slug && isset(self::VIEWS[$slug]) ? self::VIEWS[$slug] : null;
    }

    public static function pageExists(string $slug): bool
    {
        $found = get_posts([
            'post_type' => 'page',
            'name' => $slug,
            'post_status' => 'publish',
            'numberposts' => 1,
            'fields' => 'ids',
        ]);

        return $found !== [];
    }

    public static function maybeServe(): void
    {
        $slug = self::requestSlug();
        if (! $slug || self::pageExists($slug)) {
            return;
        }
        if (! is_404() && ! is_home()) {
            return;
        }

        $GLOBALS['ks_virtual_page'] = $slug;

        global $wp_query;
        $wp_query->is_404 = false;
        $wp_query->is_page = $slug !== 'blog';
        $wp_query->is_singular = $slug !== 'blog';
        $wp_query->is_home = $slug === 'blog';
        $wp_query->is_front_page = false;

        if ($slug === 'blog') {
            $wp_query->query([
                'post_type' => 'post',
                'post_status' => 'publish',
                'paged' => max(1, (int) get_query_var('paged')),
            ]);
        }

        status_header(200);
        nocache_headers();
    }

    public static function templateFile(string $template): string
    {
        $slug = self::currentSlug();
        $view = self::viewForSlug($slug);
        if (! $view) {
            return $template;
        }
        $file = get_theme_file_path("resources/views/{$view}.blade.php");

        return is_readable($file) ? $file : $template;
    }
}
