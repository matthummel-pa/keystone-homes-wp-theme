<?php

namespace App\View\Composers;

use App\Support\HeroImage;
use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content',
        'partials.content-*',
    ];

    /**
     * Retrieve the post title.
     */
    public function title(): string
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
                /* translators: %s is replaced with the search query */
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    /**
     * Retrieve the pagination links.
     */
    public function pagination(): string
    {
        return wp_link_pages([
            'echo' => 0,
            'before' => '<p>'.__('Pages:', 'sage'),
            'after' => '</p>',
        ]);
    }

    /**
     * @return list<array{id: int, title: string, url: string, excerpt: string, image: string, alt: string, meta: string}>
     */
    public function relatedPosts(): array
    {
        if (! is_singular('post')) {
            return [];
        }

        $posts = get_posts([
            'numberposts' => 2,
            'post__not_in' => [(int) get_the_ID()],
            'post_status' => 'publish',
            'orderby' => 'date',
        ]);

        $out = [];
        foreach ($posts as $post) {
            $id = (int) $post->ID;
            $cats = wp_strip_all_tags(get_the_category_list(' · ', '', $id));
            $out[] = [
                'id' => $id,
                'title' => get_the_title($id),
                'url' => (string) get_permalink($id),
                'excerpt' => get_the_excerpt($id),
                'image' => HeroImage::cardUrl($id),
                'alt' => HeroImage::cardAlt($id),
                'meta' => ($cats !== '' ? $cats : 'Notes').' · '.get_the_date('', $id),
            ];
        }

        return $out;
    }
}
