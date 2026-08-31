<?php

namespace App\Support;

/**
 * Assigned WordPress menus, with the concept page list as fallback.
 */
class Navigation
{
    /**
     * @return list<array{label: string, url: string, active: bool}>
     */
    public static function items(string $location = 'primary_navigation'): array
    {
        $locations = get_nav_menu_locations();
        $menuId = (int) ($locations[$location] ?? 0);
        if ($menuId > 0) {
            $items = wp_get_nav_menu_items($menuId);
            if (is_array($items) && $items !== []) {
                $out = [];
                foreach ($items as $item) {
                    if ((int) $item->menu_item_parent !== 0) {
                        continue;
                    }
                    $url = (string) $item->url;
                    $out[] = [
                        'label' => (string) $item->title,
                        'url' => $url,
                        'active' => self::itemIsCurrent($item, $url),
                    ];
                }
                if ($out !== []) {
                    return $out;
                }
            }
        }

        return $location === 'footer_navigation' ? self::footerFallback() : self::fallback();
    }

    /**
     * @return list<array{label: string, url: string, active: bool}>
     */
    public static function fallback(): array
    {
        $req = trim($GLOBALS['wp']->request ?? '', '/');
        $isHome = ($req === '' || is_front_page());
        $isAreas = str_starts_with($req, 'areas');
        $isGuide = str_starts_with($req, 'guide');
        $isAgents = str_starts_with($req, 'agents') || is_singular('agent');
        $isContact = str_starts_with($req, 'contact');
        $isBlog = is_home() || is_singular('post') || $req === 'blog' || str_starts_with($req, 'blog/');
        $isListings = str_starts_with($req, 'listings') || is_singular('listing');

        return [
            ['label' => __('Home', 'acreline'), 'url' => home_url('/'), 'active' => $isHome],
            ['label' => __('Listings', 'acreline'), 'url' => self::pageUrl('listings'), 'active' => $isListings],
            ['label' => __('Areas', 'acreline'), 'url' => self::pageUrl('areas'), 'active' => $isAreas],
            ['label' => __('Guide', 'acreline'), 'url' => self::pageUrl('guide'), 'active' => $isGuide],
            ['label' => __('Blog', 'acreline'), 'url' => self::pageUrl('blog', '/blog'), 'active' => $isBlog],
            ['label' => __('Agents', 'acreline'), 'url' => self::pageUrl('agents'), 'active' => $isAgents],
            ['label' => __('Contact', 'acreline'), 'url' => self::pageUrl('contact'), 'active' => $isContact],
        ];
    }

    /**
     * @return list<array{label: string, url: string, active: bool}>
     */
    public static function footerFallback(): array
    {
        $req = trim($GLOBALS['wp']->request ?? '', '/');

        return [
            ['label' => __('Listings', 'acreline'), 'url' => self::pageUrl('listings'), 'active' => str_starts_with($req, 'listings') || is_singular('listing')],
            ['label' => __('Areas', 'acreline'), 'url' => self::pageUrl('areas'), 'active' => str_starts_with($req, 'areas')],
            ['label' => __('Book a showing', 'acreline'), 'url' => Identity::bookUrl(), 'active' => str_starts_with($req, 'book')],
            ['label' => __('Buyer guide', 'acreline'), 'url' => self::pageUrl('guide'), 'active' => str_starts_with($req, 'guide')],
            ['label' => __('Agents', 'acreline'), 'url' => self::pageUrl('agents'), 'active' => str_starts_with($req, 'agents') || is_singular('agent')],
            ['label' => __('Contact', 'acreline'), 'url' => self::pageUrl('contact'), 'active' => str_starts_with($req, 'contact')],
        ];
    }

    public static function pageUrl(string $slug, string $fallbackPath = ''): string
    {
        $page = get_page_by_path($slug);
        if ($page instanceof \WP_Post) {
            return (string) get_permalink($page);
        }

        return home_url($fallbackPath !== '' ? $fallbackPath : '/'.$slug);
    }

    private static function itemIsCurrent(\WP_Post $item, string $url): bool
    {
        if (! empty($item->current) || ! empty($item->current_item_ancestor) || ! empty($item->current_item_parent)) {
            return true;
        }

        $objectId = (int) ($item->object_id ?? 0);
        if ($objectId > 0 && is_singular() && get_queried_object_id() === $objectId) {
            return true;
        }

        $current = untrailingslashit((string) home_url(add_query_arg([])));
        $target = untrailingslashit($url);

        return $target !== '' && $current === $target;
    }
}
