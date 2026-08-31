<?php

namespace App\Support;

class Breadcrumbs
{
    /**
     * @return list<array{label: string, url: string}>
     */
    public static function items(): array
    {
        $home = [
            'label' => __('Home', 'keystone-homes'),
            'url' => home_url('/'),
        ];

        if (is_front_page()) {
            return [$home];
        }

        $trail = [$home];

        if (is_home()) {
            $trail[] = ['label' => __('Blog', 'keystone-homes'), 'url' => ''];

            return $trail;
        }

        if (is_singular('listing')) {
            $trail[] = ['label' => __('Listings', 'keystone-homes'), 'url' => Navigation::pageUrl('listings')];
            $trail[] = ['label' => (string) get_the_title(), 'url' => ''];

            return $trail;
        }

        if (is_singular('agent')) {
            $trail[] = ['label' => __('Agents', 'keystone-homes'), 'url' => Navigation::pageUrl('agents')];
            $trail[] = ['label' => (string) get_the_title(), 'url' => ''];

            return $trail;
        }

        if (is_singular('post')) {
            $blog = get_option('page_for_posts');
            $blogUrl = $blog ? (string) get_permalink((int) $blog) : Navigation::pageUrl('blog', '/blog');
            $trail[] = ['label' => __('Blog', 'keystone-homes'), 'url' => $blogUrl];
            $trail[] = ['label' => (string) get_the_title(), 'url' => ''];

            return $trail;
        }

        if (is_page()) {
            $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
            foreach ($ancestors as $ancestorId) {
                $trail[] = [
                    'label' => (string) get_the_title($ancestorId),
                    'url' => (string) get_permalink($ancestorId),
                ];
            }
            $trail[] = ['label' => (string) get_the_title(), 'url' => ''];

            return $trail;
        }

        if (is_search()) {
            $trail[] = ['label' => __('Search', 'keystone-homes'), 'url' => ''];

            return $trail;
        }

        if (is_404()) {
            $trail[] = ['label' => __('Not found', 'keystone-homes'), 'url' => ''];

            return $trail;
        }

        $trail[] = ['label' => (string) wp_get_document_title(), 'url' => ''];

        return $trail;
    }

    /**
     * @return array<string, mixed>
     */
    public static function jsonLd(): array
    {
        $items = [];
        foreach (self::items() as $index => $crumb) {
            $entry = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['label'],
            ];
            if ($crumb['url'] !== '') {
                $entry['item'] = $crumb['url'];
            }
            $items[] = $entry;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }
}
