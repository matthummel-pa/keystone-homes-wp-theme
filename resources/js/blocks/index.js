/**
 * Acreline custom Gutenberg blocks — editor registration.
 *
 * All blocks are dynamic (server-side rendered): save() returns null.
 * Edit UI uses InspectorControls sidebar panels so the canvas stays clean.
 *
 * Imports resolve to window.wp.* externals at runtime via @roots/vite-plugin.
 */

import { registerBlockType, getCategories, setCategories } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import { createElement as el, Fragment } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

setCategories([
  ...getCategories(),
  // Guard against duplicate
  ...( getCategories().find(c => c.slug === 'acreline') ? [] : [{ slug: 'acreline', title: 'Acreline', icon: null }] ),
]);

// ---------------------------------------------------------------------------
// Shared editor components
// ---------------------------------------------------------------------------

/**
 * Canvas placeholder shown in the block editor (blocks are server-side rendered).
 */
function BlockPlaceholder({ icon, label, preview }) {
  return el('div', { className: 'ks-block-placeholder' },
    el('span', { className: 'ks-block-placeholder__icon', 'aria-hidden': 'true' }, icon),
    el('p', { className: 'ks-block-placeholder__label' }, label),
    preview && el('p', { className: 'ks-block-placeholder__preview' }, preview),
  );
}

/** Thin wrapper so we always spread useBlockProps. */
function withBlockProps(children) {
  const blockProps = useBlockProps({ className: 'ks-block-editor-wrap' });
  return el('div', blockProps, children);
}

// ---------------------------------------------------------------------------
// 1. Home Hero
// ---------------------------------------------------------------------------
registerBlockType('acreline/home-hero', {
  title: __('Home Hero', 'acreline'),
  description: __('Full-width hero with search form for the home page.', 'acreline'),
  category: 'acreline',
  icon: 'cover-image',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow:       { type: 'string', default: 'Farms, land, and historic homes' },
    title:         { type: 'string', default: 'Homes worth <em>walking through.</em>' },
    text:          { type: 'string', default: '' },
    imageUrl:      { type: 'string', default: '' },
    primaryLabel:  { type: 'string', default: 'Show matches' },
    secondaryLabel:{ type: 'string', default: 'Browse all listings' },
  },
  edit({ attributes, setAttributes }) {
    const { eyebrow, title, text, imageUrl, primaryLabel, secondaryLabel } = attributes;
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Hero copy', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title (use <em> for italics)', 'acreline'), value: title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Intro text', 'acreline'), value: text, onChange: v => setAttributes({ text: v }) }),
        ),
        el(PanelBody, { title: __('Hero image', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Image URL', 'acreline'), value: imageUrl, type: 'url', onChange: v => setAttributes({ imageUrl: v }) }),
          imageUrl && el('img', { src: imageUrl, style: { maxWidth: '100%', marginTop: 8, borderRadius: 4 }, alt: '' }),
        ),
        el(PanelBody, { title: __('Search buttons', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Submit label', 'acreline'), value: primaryLabel, onChange: v => setAttributes({ primaryLabel: v }) }),
          el(TextControl, { label: __('Browse link label', 'acreline'), value: secondaryLabel, onChange: v => setAttributes({ secondaryLabel: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🏡', label: __('Home Hero', 'acreline'), preview: title || eyebrow })),
    );
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
    brand:         { type: 'string', default: '' },
    eyebrow:       { type: 'string', default: '' },
    title:         { type: 'string', default: '' },
    text:          { type: 'string', default: '' },
    imageUrl:      { type: 'string', default: '' },
    primaryLabel:  { type: 'string', default: 'Book a showing' },
    primaryUrl:    { type: 'string', default: '' },
    secondaryLabel:{ type: 'string', default: '' },
    secondaryUrl:  { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    const { brand, eyebrow, title, text, imageUrl, primaryLabel, primaryUrl, secondaryLabel, secondaryUrl } = attributes;
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Hero copy', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Brand override (leave blank for site name)', 'acreline'), value: brand, onChange: v => setAttributes({ brand: v }) }),
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title (use <em> for italics)', 'acreline'), value: title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Intro text', 'acreline'), value: text, onChange: v => setAttributes({ text: v }) }),
        ),
        el(PanelBody, { title: __('Hero image', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Image URL', 'acreline'), value: imageUrl, type: 'url', onChange: v => setAttributes({ imageUrl: v }) }),
          imageUrl && el('img', { src: imageUrl, style: { maxWidth: '100%', marginTop: 8, borderRadius: 4 }, alt: '' }),
        ),
        el(PanelBody, { title: __('CTA buttons', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Primary button label', 'acreline'), value: primaryLabel, onChange: v => setAttributes({ primaryLabel: v }) }),
          el(TextControl, { label: __('Primary button URL', 'acreline'), value: primaryUrl, type: 'url', onChange: v => setAttributes({ primaryUrl: v }) }),
          el(TextControl, { label: __('Secondary button label', 'acreline'), value: secondaryLabel, onChange: v => setAttributes({ secondaryLabel: v }) }),
          el(TextControl, { label: __('Secondary button URL', 'acreline'), value: secondaryUrl, type: 'url', onChange: v => setAttributes({ secondaryUrl: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🖼️', label: __('Page Hero', 'acreline'), preview: title || eyebrow })),
    );
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
    title:   { type: 'string', default: 'Pick the path' },
    text:    { type: 'string', default: 'Then we match a listing or a tour. Township first — the rest follows.' },
    buyKicker: { type: 'string', default: 'Buy' },
    buyTitle:  { type: 'string', default: 'Scan homes, farms, and land' },
    buyLead:   { type: 'string', default: '' },
    buyCta:    { type: 'string', default: 'Browse listings' },
    sellKicker: { type: 'string', default: 'Sell' },
    sellTitle:  { type: 'string', default: 'Price it before you list' },
    sellLead:   { type: 'string', default: '' },
    sellCta:    { type: 'string', default: 'Estimate value' },
    tourKicker: { type: 'string', default: 'Tour' },
    tourTitle:  { type: 'string', default: 'Walk it on the ground' },
    tourLead:   { type: 'string', default: '' },
    tourCta:    { type: 'string', default: 'Book a showing' },
    notesLabel: { type: 'string', default: 'Good to know' },
    note1Title: { type: 'string', default: 'Township first' },
    note1Text:  { type: 'string', default: '' },
    note2Title: { type: 'string', default: 'Well and perc' },
    note2Text:  { type: 'string', default: '' },
    note3Title: { type: 'string', default: 'Boots for showings' },
    note3Text:  { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    const a = attributes;
    const s = (key) => (v) => setAttributes({ [key]: v });
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: a.eyebrow, onChange: s('eyebrow') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.title, onChange: s('title') }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: a.text, onChange: s('text') }),
        ),
        el(PanelBody, { title: __('Buy card', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Kicker', 'acreline'), value: a.buyKicker, onChange: s('buyKicker') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.buyTitle, onChange: s('buyTitle') }),
          el(TextareaControl, { label: __('Lead text', 'acreline'), value: a.buyLead, onChange: s('buyLead') }),
          el(TextControl, { label: __('CTA label', 'acreline'), value: a.buyCta, onChange: s('buyCta') }),
        ),
        el(PanelBody, { title: __('Sell card', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Kicker', 'acreline'), value: a.sellKicker, onChange: s('sellKicker') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.sellTitle, onChange: s('sellTitle') }),
          el(TextareaControl, { label: __('Lead text', 'acreline'), value: a.sellLead, onChange: s('sellLead') }),
          el(TextControl, { label: __('CTA label', 'acreline'), value: a.sellCta, onChange: s('sellCta') }),
        ),
        el(PanelBody, { title: __('Tour card', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Kicker', 'acreline'), value: a.tourKicker, onChange: s('tourKicker') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.tourTitle, onChange: s('tourTitle') }),
          el(TextareaControl, { label: __('Lead text', 'acreline'), value: a.tourLead, onChange: s('tourLead') }),
          el(TextControl, { label: __('CTA label', 'acreline'), value: a.tourCta, onChange: s('tourCta') }),
        ),
        el(PanelBody, { title: __('Help notes', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Notes label', 'acreline'), value: a.notesLabel, onChange: s('notesLabel') }),
          el(TextControl, { label: __('Note 1 title', 'acreline'), value: a.note1Title, onChange: s('note1Title') }),
          el(TextareaControl, { label: __('Note 1 text', 'acreline'), value: a.note1Text, onChange: s('note1Text') }),
          el(TextControl, { label: __('Note 2 title', 'acreline'), value: a.note2Title, onChange: s('note2Title') }),
          el(TextareaControl, { label: __('Note 2 text', 'acreline'), value: a.note2Text, onChange: s('note2Text') }),
          el(TextControl, { label: __('Note 3 title', 'acreline'), value: a.note3Title, onChange: s('note3Title') }),
          el(TextareaControl, { label: __('Note 3 text', 'acreline'), value: a.note3Text, onChange: s('note3Text') }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🃏', label: __('Intent Cards (Buy / Sell / Tour)', 'acreline'), preview: a.title })),
    );
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
    title:   { type: 'string', default: 'Three sample homes to scan' },
    text:    { type: 'string', default: 'Price · beds · acres — then book a fictional walk-through.' },
  },
  edit({ attributes, setAttributes }) {
    const { eyebrow, title, text } = attributes;
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '⭐', label: __('Featured Listings Spotlight', 'acreline'), preview: __('Shows listings marked as Featured in WP Admin → Listings.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 5. Booking Section
// ---------------------------------------------------------------------------
registerBlockType('acreline/booking-section', {
  title: __('Booking Form Section', 'acreline'),
  description: __('Showing request form with a header and optional side photo.', 'acreline'),
  category: 'acreline',
  icon: 'calendar-alt',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow: { type: 'string', default: 'Appointments' },
    title:   { type: 'string', default: 'Book a house showing' },
    text:    { type: 'string', default: 'Demo scheduler for touring sample homes.' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: attributes.eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '📅', label: __('Booking Form Section', 'acreline'), preview: __('Renders the showing request form.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 6. Market Stats
// ---------------------------------------------------------------------------
registerBlockType('acreline/market-stats', {
  title: __('Market Stats', 'acreline'),
  description: __('Four sample market statistics with optional trend indicators.', 'acreline'),
  category: 'acreline',
  icon: 'chart-line',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow:  { type: 'string', default: 'Sample market' },
    title:    { type: 'string', default: 'Pulse at a glance' },
    text:     { type: 'string', default: '' },
    stat1Val: { type: 'string', default: '$398k' }, stat1Lbl: { type: 'string', default: 'Median sale price' }, stat1Sub: { type: 'string', default: '↑ 2.1% vs last quarter' },
    stat2Val: { type: 'string', default: '32' },    stat2Lbl: { type: 'string', default: 'Days on market' },    stat2Sub: { type: 'string', default: '↓ 5 days vs last quarter' },
    stat3Val: { type: 'string', default: '1.6' },   stat3Lbl: { type: 'string', default: 'Months of inventory' }, stat3Sub: { type: 'string', default: 'Limited active supply' },
    stat4Val: { type: 'string', default: '95%' },   stat4Lbl: { type: 'string', default: 'List-to-sale ratio' },  stat4Sub: { type: 'string', default: 'Offers near asking' },
  },
  edit({ attributes: a, setAttributes }) {
    const s = (k) => (v) => setAttributes({ [k]: v });
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: a.eyebrow, onChange: s('eyebrow') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.title, onChange: s('title') }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: a.text, onChange: s('text') }),
        ),
        el(PanelBody, { title: __('Statistics', 'acreline'), initialOpen: false },
          ...[1,2,3,4].flatMap(i => [
            el(TextControl, { key: `v${i}`, label: `Stat ${i} value`, value: a[`stat${i}Val`], onChange: s(`stat${i}Val`) }),
            el(TextControl, { key: `l${i}`, label: `Stat ${i} label`, value: a[`stat${i}Lbl`], onChange: s(`stat${i}Lbl`) }),
            el(TextControl, { key: `s${i}`, label: `Stat ${i} sub`, value: a[`stat${i}Sub`], onChange: s(`stat${i}Sub`) }),
          ]),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '📊', label: __('Market Stats', 'acreline'), preview: `${a.stat1Val} · ${a.stat2Val} · ${a.stat3Val} · ${a.stat4Val}` })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 7. How It Works (tour steps)
// ---------------------------------------------------------------------------
registerBlockType('acreline/how-it-works', {
  title: __('How It Works', 'acreline'),
  description: __('Four-step process: filter → read → book → walk.', 'acreline'),
  category: 'acreline',
  icon: 'list-view',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow: { type: 'string', default: 'How a tour starts' },
    title:   { type: 'string', default: 'From search to showing' },
    text:    { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: attributes.eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '👣', label: __('How It Works (4 steps)', 'acreline'), preview: attributes.title })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 8. Agent Tools (value + alerts)
// ---------------------------------------------------------------------------
registerBlockType('acreline/agent-tools', {
  title: __('Agent Tools', 'acreline'),
  description: __('Demo home value estimator and listing alert forms.', 'acreline'),
  category: 'acreline',
  icon: 'admin-tools',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow: { type: 'string', default: 'Agent tools' },
    title:   { type: 'string', default: 'Value range and listing alerts' },
    text:    { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: attributes.eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🛠️', label: __('Agent Tools (Value + Alerts)', 'acreline'), preview: __('Renders demo value estimator and listing alert forms.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 9. SEO Content
// ---------------------------------------------------------------------------
registerBlockType('acreline/seo-content', {
  title: __('SEO Content Block', 'acreline'),
  description: __('Structured buying guide copy with scan cards for SEO.', 'acreline'),
  category: 'acreline',
  icon: 'search',
  supports: { html: false, multiple: false },
  attributes: {},
  edit() {
    return withBlockProps(el(BlockPlaceholder, { icon: '🔍', label: __('SEO Content Block', 'acreline'), preview: __('Buying a home, farm, or land — static guide copy.', 'acreline') }));
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
  icon: 'testimonial',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow: { type: 'string', default: 'Samples' },
    title:   { type: 'string', default: 'What clients might say' },
    text:    { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: attributes.eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '⭐⭐⭐⭐⭐', label: __('Client Reviews', 'acreline'), preview: __('Demo review cards — not real Google reviews.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 11. FAQ List
// ---------------------------------------------------------------------------
registerBlockType('acreline/faq-list', {
  title: __('FAQ List', 'acreline'),
  description: __('Frequently asked questions pulled from Faqs::forContext().', 'acreline'),
  category: 'acreline',
  icon: 'editor-help',
  supports: { html: false, multiple: false },
  attributes: {
    title:     { type: 'string', default: 'Questions buyers ask first' },
    text:      { type: 'string', default: 'Practical answers for house and acreage shoppers.' },
    headClass: { type: 'string', default: 'left' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '❓', label: __('FAQ List', 'acreline'), preview: __('Questions auto-loaded from the page context.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 12. CTA Band
// ---------------------------------------------------------------------------
registerBlockType('acreline/cta-band', {
  title: __('CTA Band', 'acreline'),
  description: __('Full-width call-to-action band with two buttons.', 'acreline'),
  category: 'acreline',
  icon: 'megaphone',
  supports: { html: false },
  attributes: {
    title:         { type: 'string', default: 'Tour a sample home next.' },
    text:          { type: 'string', default: 'Pick an address, choose a slot, and see how a modern realtor booking flow feels.' },
    primaryLabel:  { type: 'string', default: 'Book a showing' },
    primaryUrl:    { type: 'string', default: '' },
    secondaryLabel:{ type: 'string', default: 'Browse samples' },
    secondaryUrl:  { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    const { title, text, primaryLabel, primaryUrl, secondaryLabel, secondaryUrl } = attributes;
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('CTA copy', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Title', 'acreline'), value: title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: text, onChange: v => setAttributes({ text: v }) }),
        ),
        el(PanelBody, { title: __('Buttons', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Primary label', 'acreline'), value: primaryLabel, onChange: v => setAttributes({ primaryLabel: v }) }),
          el(TextControl, { label: __('Primary URL (blank = /book/)', 'acreline'), value: primaryUrl, type: 'url', onChange: v => setAttributes({ primaryUrl: v }) }),
          el(TextControl, { label: __('Secondary label', 'acreline'), value: secondaryLabel, onChange: v => setAttributes({ secondaryLabel: v }) }),
          el(TextControl, { label: __('Secondary URL (blank = /listings)', 'acreline'), value: secondaryUrl, type: 'url', onChange: v => setAttributes({ secondaryUrl: v }) }),
        ),
      ),
      withBlockProps(
        el('div', { style: { background: 'var(--paper-3,#e8e6e1)', padding: '24px', borderRadius: '8px', textAlign: 'center' } },
          el('strong', null, title || __('CTA Band', 'acreline')),
          text && el('p', { style: { margin: '8px 0 0', color: '#555', fontSize: '0.875rem' } }, text),
        )
      ),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 13. Intro Section
// ---------------------------------------------------------------------------
registerBlockType('acreline/intro-section', {
  title: __('Intro Section', 'acreline'),
  description: __('Simple eyebrow / title / text intro section.', 'acreline'),
  category: 'acreline',
  icon: 'align-left',
  supports: { html: false },
  attributes: {
    eyebrow: { type: 'string', default: '' },
    title:   { type: 'string', default: '' },
    text:    { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Content', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: attributes.eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '📝', label: __('Intro Section', 'acreline'), preview: attributes.title || attributes.eyebrow })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 14. Listing Grid (listings page)
// ---------------------------------------------------------------------------
registerBlockType('acreline/listing-grid', {
  title: __('Listing Grid', 'acreline'),
  description: __('Filter toolbar + listing card grid + map view.', 'acreline'),
  category: 'acreline',
  icon: 'table-row-before',
  supports: { html: false, multiple: false },
  attributes: {
    introTitle: { type: 'string', default: 'Buying rural property' },
    introText:  { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Local note', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.introTitle, onChange: v => setAttributes({ introTitle: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.introText, onChange: v => setAttributes({ introText: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🏘️', label: __('Listing Grid', 'acreline'), preview: __('Filter form + listing cards rendered from WP data.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 15. Area Grid
// ---------------------------------------------------------------------------
registerBlockType('acreline/area-grid', {
  title: __('Area Grid', 'acreline'),
  description: __('Up to six area cards showing local market characteristics.', 'acreline'),
  category: 'acreline',
  icon: 'location',
  supports: { html: false, multiple: false },
  attributes: {
    gridEyebrow: { type: 'string', default: 'Area by area' },
    gridTitle:   { type: 'string', default: 'Where the sample office works' },
    gridText:    { type: 'string', default: '' },
    area1Meta: { type: 'string', default: 'West ridge · orchards and stone houses' }, area1Title: { type: 'string', default: 'Oak Hollow' }, area1Body: { type: 'string', default: '' },
    area2Meta: { type: 'string', default: '' }, area2Title: { type: 'string', default: 'Orchard Belt' }, area2Body: { type: 'string', default: '' },
    area3Meta: { type: 'string', default: '' }, area3Title: { type: 'string', default: 'Mill Creek' },   area3Body: { type: 'string', default: '' },
    area4Meta: { type: 'string', default: '' }, area4Title: { type: 'string', default: 'Grain Country' }, area4Body: { type: 'string', default: '' },
    area5Meta: { type: 'string', default: '' }, area5Title: { type: 'string', default: 'Hill Country' }, area5Body: { type: 'string', default: '' },
    area6Meta: { type: 'string', default: '' }, area6Title: { type: 'string', default: 'Border Farms' }, area6Body: { type: 'string', default: '' },
  },
  edit({ attributes: a, setAttributes }) {
    const s = (k) => (v) => setAttributes({ [k]: v });
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Grid header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: a.gridEyebrow, onChange: s('gridEyebrow') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.gridTitle, onChange: s('gridTitle') }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: a.gridText, onChange: s('gridText') }),
        ),
        ...[1,2,3,4,5,6].map(i =>
          el(PanelBody, { key: i, title: `Area ${i}: ${a[`area${i}Title`] || '(empty)'}`, initialOpen: i === 1 },
            el(TextControl, { label: __('Meta', 'acreline'), value: a[`area${i}Meta`], onChange: s(`area${i}Meta`) }),
            el(TextControl, { label: __('Title', 'acreline'), value: a[`area${i}Title`], onChange: s(`area${i}Title`) }),
            el(TextareaControl, { label: __('Body', 'acreline'), value: a[`area${i}Body`], onChange: s(`area${i}Body`) }),
          )
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🗺️', label: __('Area Grid', 'acreline'), preview: `${a.area1Title}, ${a.area2Title}, ${a.area3Title}…` })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 16. Tools Section (guide page)
// ---------------------------------------------------------------------------
registerBlockType('acreline/tools-section', {
  title: __('Tools Section', 'acreline'),
  description: __('Buyer tools: intro copy + land loan estimator + pre-qual check.', 'acreline'),
  category: 'acreline',
  icon: 'calculator',
  supports: { html: false, multiple: false },
  attributes: {
    introTitle: { type: 'string', default: "What's different about buying land" },
    introText:  { type: 'string', default: '' },
    eyebrow:    { type: 'string', default: 'Run Your Numbers' },
    title:      { type: 'string', default: 'Land-loan & pre-qualification tools' },
    text:       { type: 'string', default: '' },
  },
  edit({ attributes: a, setAttributes }) {
    const s = (k) => (v) => setAttributes({ [k]: v });
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Intro copy', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Intro title', 'acreline'), value: a.introTitle, onChange: s('introTitle') }),
          el(TextareaControl, { label: __('Intro text', 'acreline'), value: a.introText, onChange: s('introText') }),
        ),
        el(PanelBody, { title: __('Tools header', 'acreline'), initialOpen: false },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: a.eyebrow, onChange: s('eyebrow') }),
          el(TextControl, { label: __('Title', 'acreline'), value: a.title, onChange: s('title') }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: a.text, onChange: s('text') }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🧮', label: __('Tools Section', 'acreline'), preview: a.introTitle })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 17. How We Work (agents page)
// ---------------------------------------------------------------------------
registerBlockType('acreline/how-we-work', {
  title: __('How We Work', 'acreline'),
  description: __('Three-step "how the office works" section.', 'acreline'),
  category: 'acreline',
  icon: 'groups',
  supports: { html: false, multiple: false },
  attributes: {
    eyebrow: { type: 'string', default: 'How We Work' },
    title:   { type: 'string', default: 'What working with this office looks like' },
    text:    { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Section header', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Eyebrow', 'acreline'), value: attributes.eyebrow, onChange: v => setAttributes({ eyebrow: v }) }),
          el(TextControl, { label: __('Title', 'acreline'), value: attributes.title, onChange: v => setAttributes({ title: v }) }),
          el(TextareaControl, { label: __('Text', 'acreline'), value: attributes.text, onChange: v => setAttributes({ text: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🤝', label: __('How We Work (3 steps)', 'acreline'), preview: attributes.title })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 18. Office Info
// ---------------------------------------------------------------------------
registerBlockType('acreline/office-info', {
  title: __('Office Info', 'acreline'),
  description: __('Address, phone, email, hours — pulled from Customizer → Identity.', 'acreline'),
  category: 'acreline',
  icon: 'building',
  supports: { html: false, multiple: false },
  attributes: {
    officeTitle: { type: 'string', default: '' },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Office', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Office heading override (blank = brand name)', 'acreline'), value: attributes.officeTitle, onChange: v => setAttributes({ officeTitle: v }) }),
          el('p', { style: { fontSize: '0.8rem', color: '#646970' } }, __('Phone, address, email, and hours come from Appearance → Customize → Identity.', 'acreline')),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🏢', label: __('Office Info', 'acreline'), preview: __('Address · Phone · Email · Hours from Customizer.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 19. Contact Form
// ---------------------------------------------------------------------------
registerBlockType('acreline/contact-form', {
  title: __('Contact Form', 'acreline'),
  description: __('Office info + contact form side by side.', 'acreline'),
  category: 'acreline',
  icon: 'email',
  supports: { html: false, multiple: false },
  attributes: {
    formTitle: { type: 'string', default: 'Send us a message' },
    formText:  { type: 'string', default: "Tell us what you're looking for and we'll be in touch." },
  },
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Form copy', 'acreline'), initialOpen: true },
          el(TextControl, { label: __('Form title', 'acreline'), value: attributes.formTitle, onChange: v => setAttributes({ formTitle: v }) }),
          el(TextareaControl, { label: __('Form intro', 'acreline'), value: attributes.formText, onChange: v => setAttributes({ formText: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '✉️', label: __('Contact Form', 'acreline'), preview: attributes.formTitle })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 20. Book Note (book page standalone form)
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
  edit({ attributes, setAttributes }) {
    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: __('Disclaimer note', 'acreline'), initialOpen: true },
          el(TextareaControl, { label: __('Note text', 'acreline'), value: attributes.note, onChange: v => setAttributes({ note: v }) }),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '📋', label: __('Book Note + Form', 'acreline'), preview: attributes.note })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// 21. Custom Block (acreline/custom — generated from Block Generator)
// ---------------------------------------------------------------------------
registerBlockType('acreline/custom', {
  title: __('Custom Block', 'acreline'),
  description: __('A block generated via Tools → Block Generator.', 'acreline'),
  category: 'acreline',
  icon: 'lightbulb',
  supports: { html: false },
  attributes: {
    blockId: { type: 'string', default: '' },
    fields:  { type: 'object', default: {} },
  },
  edit({ attributes, setAttributes }) {
    const { blockId, fields } = attributes;
    const customBlocks = (window.ACRELINE_BLOCKS || {}).customBlocks || {};
    const def = customBlocks[blockId];

    // Block selector
    if (!blockId || !def) {
      const options = Object.entries(customBlocks);
      return withBlockProps(
        el('div', { className: 'ks-block-placeholder' },
          el('span', { className: 'ks-block-placeholder__icon' }, '🧩'),
          el('p', { className: 'ks-block-placeholder__label' }, __('Custom Block', 'acreline')),
          options.length === 0
            ? el('p', null, __('No custom blocks yet. Create one in Tools → Block Generator.', 'acreline'))
            : el('select', {
                value: blockId,
                onChange: (e) => setAttributes({ blockId: e.target.value, fields: {} }),
                style: { marginTop: 8, display: 'block', width: '100%' },
              },
              el('option', { value: '' }, __('— choose a block —', 'acreline')),
              ...options.map(([id, d]) => el('option', { key: id, value: id }, d.title || id)),
            ),
        )
      );
    }

    const s = (k) => (v) => setAttributes({ fields: { ...fields, [k]: v } });

    return el(Fragment, null,
      el(InspectorControls, null,
        el(PanelBody, { title: def.title || blockId, initialOpen: true },
          ...(def.fields || []).map(f =>
            f.type === 'textarea'
              ? el(TextareaControl, { key: f.name, label: f.label || f.name, value: fields[f.name] || '', onChange: s(f.name) })
              : el(TextControl, { key: f.name, label: f.label || f.name, value: fields[f.name] || '', type: f.type === 'url' ? 'url' : 'text', onChange: s(f.name) })
          ),
        ),
      ),
      withBlockProps(el(BlockPlaceholder, { icon: '🧩', label: def.title || blockId, preview: __('Custom block — rendered server-side.', 'acreline') })),
    );
  },
  save: () => null,
});

// ---------------------------------------------------------------------------
// Editor styles for placeholder chrome
// ---------------------------------------------------------------------------
const style = document.createElement('style');
style.textContent = `
  .ks-block-editor-wrap { border: 2px dashed #c3c4c7; border-radius: 6px; padding: 2px; }
  .ks-block-placeholder { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px; padding: 20px; text-align: center; background: #f9f9f9; border-radius: 4px; }
  .ks-block-placeholder__icon { font-size: 2rem; line-height: 1; }
  .ks-block-placeholder__label { font-weight: 600; font-size: 0.875rem; color: #1e1e1e; margin: 0; }
  .ks-block-placeholder__preview { font-size: 0.75rem; color: #555; margin: 0; max-width: 40ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
`;
document.head.appendChild(style);
