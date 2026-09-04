/**
 * Acreline custom Gutenberg blocks — editor registration.
 *
 * All blocks are dynamic (server-side rendered): save() returns null.
 * Edit UI uses ServerSideRender so the canvas displays the real PHP output
 * (same HTML as the public page). Attribute editing lives in the Inspector
 * Controls sidebar.
 *
 * The full frontend CSS (app.css) is injected into the editor canvas via
 * block_editor_settings_all in app/setup.php, so design tokens, cards, and
 * sections render identically to the live site.
 */

import { registerBlockType, setCategories, getCategories } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Spinner } from '@wordpress/components';
import { createElement as el, Fragment } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';

// ---------------------------------------------------------------------------
// Block category
// ---------------------------------------------------------------------------
setCategories([
    ...getCategories(),
    ...(getCategories().find((c) => c.slug === 'acreline')
        ? []
        : [{ slug: 'acreline', title: 'Acreline', icon: null }]),
]);

// ---------------------------------------------------------------------------
// Shared helpers
// ---------------------------------------------------------------------------

/**
 * Edit component wrapper: sidebar InspectorControls + live ServerSideRender.
 *
 * @param {string}   blockName   Fully-qualified block name (e.g. 'acreline/hero')
 * @param {object}   attributes  Current attribute values
 * @param {Function} sidebarFn   Function that returns InspectorControls children
 */
function SsrEdit({ blockName, attributes, sidebarFn }) {
    const blockProps = useBlockProps({ className: 'ks-block-ssr' });

    return el(
        Fragment,
        null,
        el(InspectorControls, null, sidebarFn()),
        el(
            'div',
            blockProps,
            el(ServerSideRender, {
                block: blockName,
                attributes,
                LoadingResponsePlaceholder: () =>
                    el('div', { style: { padding: '24px', textAlign: 'center', opacity: 0.5 } }, el(Spinner)),
            }),
        ),
    );
}

/** Quick shorthand: single text field. */
function tf(label, key, attrs, setAttrs, opts = {}) {
    return el(TextControl, {
        label,
        value: attrs[key] || '',
        onChange: (v) => setAttrs({ [key]: v }),
        ...opts,
    });
}

/** Quick shorthand: textarea field. */
function ta(label, key, attrs, setAttrs) {
    return el(TextareaControl, {
        label,
        value: attrs[key] || '',
        onChange: (v) => setAttrs({ [key]: v }),
    });
}

// ---------------------------------------------------------------------------
// 1. Home Hero
// ---------------------------------------------------------------------------
registerBlockType('acreline/home-hero', {
    title: __('Home Hero', 'acreline'),
    description: __('Full-width hero with integrated listing search form.', 'acreline'),
    category: 'acreline',
    icon: 'cover-image',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Farms, land, and historic homes' },
        title: { type: 'string', default: 'Homes worth <em>walking through.</em>' },
        text: { type: 'string', default: '' },
        imageUrl: { type: 'string', default: '' },
        primaryLabel: { type: 'string', default: 'Show matches' },
        secondaryLabel: { type: 'string', default: 'Browse all listings' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/home-hero',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('Hero copy', 'acreline'), initialOpen: true },
                        tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                        tf(__('Title (use <em> for italics)', 'acreline'), 'title', a, s),
                        ta(__('Intro text', 'acreline'), 'text', a, s),
                    ),
                    el(PanelBody, { title: __('Hero image', 'acreline'), initialOpen: false },
                        tf(__('Image URL (blank = featured image)', 'acreline'), 'imageUrl', a, s, { type: 'url' }),
                        a.imageUrl && el('img', { src: a.imageUrl, style: { maxWidth: '100%', marginTop: 8, borderRadius: 4 }, alt: '' }),
                    ),
                    el(PanelBody, { title: __('Search buttons', 'acreline'), initialOpen: false },
                        tf(__('Submit label', 'acreline'), 'primaryLabel', a, s),
                        tf(__('Browse link label', 'acreline'), 'secondaryLabel', a, s),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 2. Page Hero
// ---------------------------------------------------------------------------
registerBlockType('acreline/page-hero', {
    title: __('Page Hero', 'acreline'),
    description: __('Standard page hero with photo, eyebrow, title, and CTA buttons.', 'acreline'),
    category: 'acreline',
    icon: 'admin-page',
    supports: { html: false },
    attributes: {
        brand: { type: 'string', default: '' },
        eyebrow: { type: 'string', default: '' },
        title: { type: 'string', default: '' },
        text: { type: 'string', default: '' },
        imageUrl: { type: 'string', default: '' },
        primaryLabel: { type: 'string', default: 'Book a showing' },
        primaryUrl: { type: 'string', default: '' },
        secondaryLabel: { type: 'string', default: '' },
        secondaryUrl: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/page-hero',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('Hero copy', 'acreline'), initialOpen: true },
                        tf(__('Brand override (blank = site name)', 'acreline'), 'brand', a, s),
                        tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                        tf(__('Title (use <em> for italics)', 'acreline'), 'title', a, s),
                        ta(__('Intro text', 'acreline'), 'text', a, s),
                    ),
                    el(PanelBody, { title: __('Hero image', 'acreline'), initialOpen: false },
                        tf(__('Image URL (blank = featured image)', 'acreline'), 'imageUrl', a, s, { type: 'url' }),
                        a.imageUrl && el('img', { src: a.imageUrl, style: { maxWidth: '100%', marginTop: 8, borderRadius: 4 }, alt: '' }),
                    ),
                    el(PanelBody, { title: __('CTA buttons', 'acreline'), initialOpen: false },
                        tf(__('Primary label', 'acreline'), 'primaryLabel', a, s),
                        tf(__('Primary URL', 'acreline'), 'primaryUrl', a, s, { type: 'url' }),
                        tf(__('Secondary label', 'acreline'), 'secondaryLabel', a, s),
                        tf(__('Secondary URL', 'acreline'), 'secondaryUrl', a, s, { type: 'url' }),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 3. Intent Cards (buy / sell / tour)
// ---------------------------------------------------------------------------
registerBlockType('acreline/intent-cards', {
    title: __('Intent Cards', 'acreline'),
    description: __('Buy / Sell / Tour three-card section with help notes.', 'acreline'),
    category: 'acreline',
    icon: 'grid-view',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Start here' },
        title: { type: 'string', default: 'Pick the path' },
        text: { type: 'string', default: 'Then we match a listing or a tour. Township first — the rest follows.' },
        buyKicker: { type: 'string', default: 'Buy' },
        buyTitle: { type: 'string', default: 'Scan homes, farms, and land' },
        buyLead: { type: 'string', default: '' },
        buyCta: { type: 'string', default: 'Browse listings' },
        sellKicker: { type: 'string', default: 'Sell' },
        sellTitle: { type: 'string', default: 'Price it before you list' },
        sellLead: { type: 'string', default: '' },
        sellCta: { type: 'string', default: 'Estimate value' },
        tourKicker: { type: 'string', default: 'Tour' },
        tourTitle: { type: 'string', default: 'Walk it on the ground' },
        tourLead: { type: 'string', default: '' },
        tourCta: { type: 'string', default: 'Book a showing' },
        notesLabel: { type: 'string', default: 'Good to know' },
        note1Title: { type: 'string', default: 'Township first' },
        note1Text: { type: 'string', default: '' },
        note2Title: { type: 'string', default: 'Well and perc' },
        note2Text: { type: 'string', default: '' },
        note3Title: { type: 'string', default: 'Boots for showings' },
        note3Text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/intent-cards',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                        tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                        tf(__('Title', 'acreline'), 'title', a, s),
                        ta(__('Text', 'acreline'), 'text', a, s),
                    ),
                    el(PanelBody, { title: __('Buy card', 'acreline'), initialOpen: false },
                        tf(__('Kicker', 'acreline'), 'buyKicker', a, s),
                        tf(__('Title', 'acreline'), 'buyTitle', a, s),
                        ta(__('Lead text', 'acreline'), 'buyLead', a, s),
                        tf(__('CTA label', 'acreline'), 'buyCta', a, s),
                    ),
                    el(PanelBody, { title: __('Sell card', 'acreline'), initialOpen: false },
                        tf(__('Kicker', 'acreline'), 'sellKicker', a, s),
                        tf(__('Title', 'acreline'), 'sellTitle', a, s),
                        ta(__('Lead text', 'acreline'), 'sellLead', a, s),
                        tf(__('CTA label', 'acreline'), 'sellCta', a, s),
                    ),
                    el(PanelBody, { title: __('Tour card', 'acreline'), initialOpen: false },
                        tf(__('Kicker', 'acreline'), 'tourKicker', a, s),
                        tf(__('Title', 'acreline'), 'tourTitle', a, s),
                        ta(__('Lead text', 'acreline'), 'tourLead', a, s),
                        tf(__('CTA label', 'acreline'), 'tourCta', a, s),
                    ),
                    el(PanelBody, { title: __('Help notes', 'acreline'), initialOpen: false },
                        tf(__('Notes label', 'acreline'), 'notesLabel', a, s),
                        tf(__('Note 1 title', 'acreline'), 'note1Title', a, s),
                        ta(__('Note 1 text', 'acreline'), 'note1Text', a, s),
                        tf(__('Note 2 title', 'acreline'), 'note2Title', a, s),
                        ta(__('Note 2 text', 'acreline'), 'note2Text', a, s),
                        tf(__('Note 3 title', 'acreline'), 'note3Title', a, s),
                        ta(__('Note 3 text', 'acreline'), 'note3Text', a, s),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 4. Spotlight (featured listings)
// ---------------------------------------------------------------------------
registerBlockType('acreline/spotlight', {
    title: __('Featured Listings Spotlight', 'acreline'),
    description: __('Grid of featured listings pulled dynamically from WP.', 'acreline'),
    category: 'acreline',
    icon: 'star-filled',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Spotlight' },
        title: { type: 'string', default: 'Three sample homes to scan' },
        text: { type: 'string', default: 'Price · beds · acres — then book a fictional walk-through.' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/spotlight',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                    el('p', { style: { fontSize: '0.75rem', color: '#646970', margin: '8px 0 0' } },
                        __('Listings shown are those marked Featured in WP Admin → Listings.', 'acreline'),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 5. Booking Section
// ---------------------------------------------------------------------------
registerBlockType('acreline/booking-section', {
    title: __('Booking Form Section', 'acreline'),
    description: __('Showing request form with header copy.', 'acreline'),
    category: 'acreline',
    icon: 'calendar-alt',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Appointments' },
        title: { type: 'string', default: 'Book a house showing' },
        text: { type: 'string', default: 'Demo scheduler for touring sample homes.' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/booking-section',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 6. Market Stats
// ---------------------------------------------------------------------------
registerBlockType('acreline/market-stats', {
    title: __('Market Stats', 'acreline'),
    description: __('Four editable market-statistic tiles.', 'acreline'),
    category: 'acreline',
    icon: 'chart-line',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Sample market' },
        title: { type: 'string', default: 'Pulse at a glance' },
        text: { type: 'string', default: '' },
        stat1Val: { type: 'string', default: '$398k' },
        stat1Lbl: { type: 'string', default: 'Median sale price' },
        stat1Sub: { type: 'string', default: '↑ 2.1% vs last quarter' },
        stat2Val: { type: 'string', default: '32' },
        stat2Lbl: { type: 'string', default: 'Days on market' },
        stat2Sub: { type: 'string', default: '↓ 5 days vs last quarter' },
        stat3Val: { type: 'string', default: '1.6' },
        stat3Lbl: { type: 'string', default: 'Months of inventory' },
        stat3Sub: { type: 'string', default: 'Limited active supply' },
        stat4Val: { type: 'string', default: '95%' },
        stat4Lbl: { type: 'string', default: 'List-to-sale ratio' },
        stat4Sub: { type: 'string', default: 'Offers near asking' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/market-stats',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                        tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                        tf(__('Title', 'acreline'), 'title', a, s),
                        ta(__('Text', 'acreline'), 'text', a, s),
                    ),
                    el(PanelBody, { title: __('Statistics', 'acreline'), initialOpen: false },
                        ...[1, 2, 3, 4].flatMap((i) => [
                            tf(`Stat ${i} value`, `stat${i}Val`, a, s),
                            tf(`Stat ${i} label`, `stat${i}Lbl`, a, s),
                            tf(`Stat ${i} sub-line`, `stat${i}Sub`, a, s),
                        ]),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 7. How It Works (tour steps)
// ---------------------------------------------------------------------------
registerBlockType('acreline/how-it-works', {
    title: __('How It Works', 'acreline'),
    description: __('Four-step tour process: filter → read → book → walk.', 'acreline'),
    category: 'acreline',
    icon: 'list-view',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'How a tour starts' },
        title: { type: 'string', default: 'From search to showing' },
        text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/how-it-works',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 8. Agent Tools (value estimator + listing alerts)
// ---------------------------------------------------------------------------
registerBlockType('acreline/agent-tools', {
    title: __('Agent Tools', 'acreline'),
    description: __('Demo home value estimator and listing alert forms.', 'acreline'),
    category: 'acreline',
    icon: 'admin-tools',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Agent tools' },
        title: { type: 'string', default: 'Value range and listing alerts' },
        text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/agent-tools',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 9. SEO Content
// ---------------------------------------------------------------------------
registerBlockType('acreline/seo-content', {
    title: __('SEO Content Block', 'acreline'),
    description: __('Buying guide copy and scan cards for rural real estate.', 'acreline'),
    category: 'acreline',
    icon: 'search',
    supports: { html: false, multiple: false },
    attributes: {},
    edit() {
        return el(SsrEdit, {
            blockName: 'acreline/seo-content',
            attributes: {},
            sidebarFn: () =>
                el(PanelBody, { title: __('SEO Content', 'acreline'), initialOpen: true },
                    el('p', { style: { fontSize: '0.8rem', color: '#646970', margin: 0 } },
                        __('Static buying guide copy — edit in app/blocks.php or replace with your market-specific text.', 'acreline'),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 10. Reviews
// ---------------------------------------------------------------------------
registerBlockType('acreline/reviews', {
    title: __('Client Reviews', 'acreline'),
    description: __('Demo review cards shaped like a Google Places response.', 'acreline'),
    category: 'acreline',
    icon: 'star-half',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'Samples' },
        title: { type: 'string', default: 'What clients might say' },
        text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/reviews',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 11. FAQ List
// ---------------------------------------------------------------------------
registerBlockType('acreline/faq-list', {
    title: __('FAQ List', 'acreline'),
    description: __('Frequently asked questions, auto-loaded by page context.', 'acreline'),
    category: 'acreline',
    icon: 'editor-help',
    supports: { html: false, multiple: false },
    attributes: {
        title: { type: 'string', default: 'Questions buyers ask first' },
        text: { type: 'string', default: 'Practical answers for house and acreage shoppers.' },
        headClass: { type: 'string', default: 'left' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/faq-list',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 12. CTA Band
// ---------------------------------------------------------------------------
registerBlockType('acreline/cta-band', {
    title: __('CTA Band', 'acreline'),
    description: __('Full-width call-to-action section with two buttons.', 'acreline'),
    category: 'acreline',
    icon: 'megaphone',
    supports: { html: false },
    attributes: {
        title: { type: 'string', default: 'Tour a sample home next.' },
        text: { type: 'string', default: 'Pick an address, choose a slot, and see how a modern realtor booking flow feels.' },
        primaryLabel: { type: 'string', default: 'Book a showing' },
        primaryUrl: { type: 'string', default: '' },
        secondaryLabel: { type: 'string', default: 'Browse samples' },
        secondaryUrl: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/cta-band',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('CTA copy', 'acreline'), initialOpen: true },
                        tf(__('Title', 'acreline'), 'title', a, s),
                        ta(__('Text', 'acreline'), 'text', a, s),
                    ),
                    el(PanelBody, { title: __('Buttons', 'acreline'), initialOpen: false },
                        tf(__('Primary label', 'acreline'), 'primaryLabel', a, s),
                        tf(__('Primary URL (blank = /book/)', 'acreline'), 'primaryUrl', a, s, { type: 'url' }),
                        tf(__('Secondary label', 'acreline'), 'secondaryLabel', a, s),
                        tf(__('Secondary URL (blank = /listings)', 'acreline'), 'secondaryUrl', a, s, { type: 'url' }),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 13. Intro Section
// ---------------------------------------------------------------------------
registerBlockType('acreline/intro-section', {
    title: __('Intro Section', 'acreline'),
    description: __('Eyebrow / title / lede text intro.', 'acreline'),
    category: 'acreline',
    icon: 'align-left',
    supports: { html: false },
    attributes: {
        eyebrow: { type: 'string', default: '' },
        title: { type: 'string', default: '' },
        text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/intro-section',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Content', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 14. Listing Grid
// ---------------------------------------------------------------------------
registerBlockType('acreline/listing-grid', {
    title: __('Listing Grid', 'acreline'),
    description: __('Filter toolbar + listing card grid + map view.', 'acreline'),
    category: 'acreline',
    icon: 'table-row-before',
    supports: { html: false, multiple: false },
    attributes: {
        introTitle: { type: 'string', default: 'Buying rural property' },
        introText: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/listing-grid',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Local note', 'acreline'), initialOpen: true },
                    tf(__('Title', 'acreline'), 'introTitle', a, s),
                    ta(__('Text', 'acreline'), 'introText', a, s),
                    el('p', { style: { fontSize: '0.75rem', color: '#646970', margin: '8px 0 0' } },
                        __('Filter form and listing cards are non-interactive in the editor.', 'acreline'),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 15. Area Grid
// ---------------------------------------------------------------------------
registerBlockType('acreline/area-grid', {
    title: __('Area Grid', 'acreline'),
    description: __('Up to six area cards with local market copy.', 'acreline'),
    category: 'acreline',
    icon: 'location',
    supports: { html: false, multiple: false },
    attributes: {
        gridEyebrow: { type: 'string', default: 'Area by area' },
        gridTitle: { type: 'string', default: 'Where the sample office works' },
        gridText: { type: 'string', default: '' },
        area1Meta: { type: 'string', default: 'West ridge · orchards and stone houses' },
        area1Title: { type: 'string', default: 'Oak Hollow' },
        area1Body: { type: 'string', default: '' },
        area2Meta: { type: 'string', default: '' },
        area2Title: { type: 'string', default: 'Orchard Belt' },
        area2Body: { type: 'string', default: '' },
        area3Meta: { type: 'string', default: '' },
        area3Title: { type: 'string', default: 'Mill Creek' },
        area3Body: { type: 'string', default: '' },
        area4Meta: { type: 'string', default: '' },
        area4Title: { type: 'string', default: 'Grain Country' },
        area4Body: { type: 'string', default: '' },
        area5Meta: { type: 'string', default: '' },
        area5Title: { type: 'string', default: 'Hill Country' },
        area5Body: { type: 'string', default: '' },
        area6Meta: { type: 'string', default: '' },
        area6Title: { type: 'string', default: 'Border Farms' },
        area6Body: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/area-grid',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('Grid header', 'acreline'), initialOpen: true },
                        tf(__('Eyebrow', 'acreline'), 'gridEyebrow', a, s),
                        tf(__('Title', 'acreline'), 'gridTitle', a, s),
                        ta(__('Text', 'acreline'), 'gridText', a, s),
                    ),
                    ...[1, 2, 3, 4, 5, 6].map((i) =>
                        el(
                            PanelBody,
                            { key: i, title: `Area ${i}: ${a[`area${i}Title`] || '(empty)'}`, initialOpen: i === 1 },
                            tf(__('Meta', 'acreline'), `area${i}Meta`, a, s),
                            tf(__('Title', 'acreline'), `area${i}Title`, a, s),
                            ta(__('Body', 'acreline'), `area${i}Body`, a, s),
                        ),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 16. Tools Section (guide page)
// ---------------------------------------------------------------------------
registerBlockType('acreline/tools-section', {
    title: __('Tools Section', 'acreline'),
    description: __('Land loan + pre-qual calculators with intro copy.', 'acreline'),
    category: 'acreline',
    icon: 'calculator',
    supports: { html: false, multiple: false },
    attributes: {
        introTitle: { type: 'string', default: "What's different about buying land" },
        introText: { type: 'string', default: '' },
        eyebrow: { type: 'string', default: 'Run Your Numbers' },
        title: { type: 'string', default: 'Land-loan & pre-qualification tools' },
        text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/tools-section',
            attributes: a,
            sidebarFn: () =>
                el(
                    Fragment,
                    null,
                    el(PanelBody, { title: __('Intro copy', 'acreline'), initialOpen: true },
                        tf(__('Intro title', 'acreline'), 'introTitle', a, s),
                        ta(__('Intro text', 'acreline'), 'introText', a, s),
                    ),
                    el(PanelBody, { title: __('Tools header', 'acreline'), initialOpen: false },
                        tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                        tf(__('Title', 'acreline'), 'title', a, s),
                        ta(__('Text', 'acreline'), 'text', a, s),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 17. How We Work (agents page)
// ---------------------------------------------------------------------------
registerBlockType('acreline/how-we-work', {
    title: __('How We Work', 'acreline'),
    description: __('Three-step office process section.', 'acreline'),
    category: 'acreline',
    icon: 'groups',
    supports: { html: false, multiple: false },
    attributes: {
        eyebrow: { type: 'string', default: 'How We Work' },
        title: { type: 'string', default: 'What working with this office looks like' },
        text: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/how-we-work',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
                    tf(__('Eyebrow', 'acreline'), 'eyebrow', a, s),
                    tf(__('Title', 'acreline'), 'title', a, s),
                    ta(__('Text', 'acreline'), 'text', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 18. Office Info
// ---------------------------------------------------------------------------
registerBlockType('acreline/office-info', {
    title: __('Office Info', 'acreline'),
    description: __('Address, phone, email, and hours from Customizer → Identity.', 'acreline'),
    category: 'acreline',
    icon: 'building',
    supports: { html: false, multiple: false },
    attributes: {
        officeTitle: { type: 'string', default: '' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/office-info',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Office', 'acreline'), initialOpen: true },
                    tf(__('Heading override (blank = brand name)', 'acreline'), 'officeTitle', a, s),
                    el('p', { style: { fontSize: '0.75rem', color: '#646970', margin: '8px 0 0' } },
                        __('Phone, address, email, and hours come from Appearance → Customize → Identity.', 'acreline'),
                    ),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 19. Contact Form
// ---------------------------------------------------------------------------
registerBlockType('acreline/contact-form', {
    title: __('Contact Form', 'acreline'),
    description: __('Office info + contact message form side by side.', 'acreline'),
    category: 'acreline',
    icon: 'email',
    supports: { html: false, multiple: false },
    attributes: {
        formTitle: { type: 'string', default: 'Send us a message' },
        formText: { type: 'string', default: "Tell us what you're looking for and we'll be in touch." },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/contact-form',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Form copy', 'acreline'), initialOpen: true },
                    tf(__('Form title', 'acreline'), 'formTitle', a, s),
                    ta(__('Form intro', 'acreline'), 'formText', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 20. Book Note + Form
// ---------------------------------------------------------------------------
registerBlockType('acreline/book-note', {
    title: __('Booking Note + Form', 'acreline'),
    description: __('Demo disclaimer note above the standalone booking form.', 'acreline'),
    category: 'acreline',
    icon: 'sticky',
    supports: { html: false, multiple: false },
    attributes: {
        note: { type: 'string', default: 'Demo only — no emails, texts or calendar invites are sent.' },
    },
    edit({ attributes: a, setAttributes: s }) {
        return el(SsrEdit, {
            blockName: 'acreline/book-note',
            attributes: a,
            sidebarFn: () =>
                el(PanelBody, { title: __('Disclaimer note', 'acreline'), initialOpen: true },
                    ta(__('Note text', 'acreline'), 'note', a, s),
                ),
        });
    },
    save: () => null,
});

// ---------------------------------------------------------------------------
// 21. Custom Block (acreline/custom — from Block Generator)
// ---------------------------------------------------------------------------
registerBlockType('acreline/custom', {
    title: __('Custom Block', 'acreline'),
    description: __('A block created via Tools → Block Generator.', 'acreline'),
    category: 'acreline',
    icon: 'lightbulb',
    supports: { html: false },
    attributes: {
        blockId: { type: 'string', default: '' },
        fields: { type: 'object', default: {} },
    },
    edit({ attributes, setAttributes }) {
        const { blockId, fields } = attributes;
        const customBlocks = (window.ACRELINE_BLOCKS || {}).customBlocks || {};
        const def = customBlocks[blockId];

        if (!blockId || !def) {
            const options = Object.entries(customBlocks);
            const blockProps = useBlockProps();

            return el(
                'div',
                blockProps,
                el('div', { style: { padding: '20px', textAlign: 'center', background: '#f9f9f9', borderRadius: '4px' } },
                    el('span', { style: { fontSize: '1.5rem' } }, '🧩'),
                    el('p', { style: { fontWeight: 600, margin: '8px 0 4px' } }, __('Custom Block', 'acreline')),
                    options.length === 0
                        ? el('p', { style: { fontSize: '0.8rem', color: '#646970' } },
                            __('No custom blocks yet. Create one in Tools → Block Generator.', 'acreline'),
                        )
                        : el(
                            'select',
                            {
                                value: blockId,
                                onChange: (e) => setAttributes({ blockId: e.target.value, fields: {} }),
                                style: { marginTop: 8, display: 'block', width: '100%' },
                            },
                            el('option', { value: '' }, __('— choose a block —', 'acreline')),
                            ...options.map(([id, d]) =>
                                el('option', { key: id, value: id }, d.title || id),
                            ),
                        ),
                ),
            );
        }

        const setField = (k) => (v) => setAttributes({ fields: { ...fields, [k]: v } });

        return el(SsrEdit, {
            blockName: 'acreline/custom',
            attributes,
            sidebarFn: () =>
                el(PanelBody, { title: def.title || blockId, initialOpen: true },
                    ...(def.fields || []).map((f) =>
                        f.type === 'textarea'
                            ? ta(f.label || f.name, f.name, fields, setField)
                            : tf(f.label || f.name, f.name, fields, setField, {
                                type: f.type === 'url' ? 'url' : 'text',
                            }),
                    ),
                ),
        });
    },
    save: () => null,
});
