<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Blog</span></li>
  </ol>
</nav>

@include('partials.page-hero', [
  'heroBrand' => $copy['hero_brand'] ?? 'Keystone Homes &amp; Land',
  'heroEyebrow' => $copy['hero_eyebrow'] ?? 'Guide',
  'heroTitle' => $copy['hero_title'] ?? 'Realtor notes you can publish',
  'heroText' => $copy['hero_text'] ?? 'Showings, buyer checklists, and land vs home search — short posts you can adapt for local Adams County SEO.',
  'heroActions' => [
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
    ['href' => home_url('/guide'), 'label' => 'Buyer tools', 'class' => 'btn btn-outline light'],
  ],
])

<section class="section section-alt">
  <div class="wrap">
    @if (! have_posts())
      <p class="empty-state">Sample posts load with Tools → Seed Keystone demo. Until then, use <a href="{{ home_url('/guide') }}">the buyer’s guide</a> or <a href="{{ home_url('/listings') }}">browse listings</a>.</p>
    @else
      <div class="blog-grid reveal">
        @while(have_posts()) @php(the_post())
          <a class="blog-card" href="{{ get_permalink() }}">
            <img
              src="{{ \App\Support\HeroImage::cardUrl((int) get_the_ID()) }}"
              width="900"
              height="560"
              alt="{{ \App\Support\HeroImage::cardAlt((int) get_the_ID()) }}"
              loading="lazy"
              decoding="async"
            >
            <div class="blog-card-body">
                <span class="blog-meta">{{ wp_strip_all_tags(get_the_category_list(' · ')) ?: 'Notes' }} · {{ max(1, (int) ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200)) }} min</span>
              <h2>{!! get_the_title() !!}</h2>
              <p>{{ get_the_excerpt() }}</p>
              <span class="teaser-link">Read post →</span>
            </div>
          </a>
        @endwhile
      </div>
      {!! get_the_posts_navigation() !!}
    @endif
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="cta-band reveal">
      <h2>Ready to tour a sample home?</h2>
      <p>Use the demo showing scheduler on the homepage — property, date and time in one flow.</p>
      <div class="cta-actions">
        <a class="btn btn-primary" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] ?? 'Book a showing' }}</a>
        <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse samples</a>
      </div>
    </div>
  </div>
</section>
