<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Blog</span></li>
  </ol>
</nav>

<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">Keystone Homes &amp; Land</p>
    <p class="hero-eyebrow">Guide</p>
    <h1>Realtor notes you can publish</h1>
    <p>Sample posts for showings, buyer checklists, and land vs home search — ready to adapt for local SEO.</p>
  </div>
</section>

<section class="section section-alt">
  <div class="wrap">
    @if (! have_posts())
      <p class="empty-state">No posts yet. Seed sample articles from <code>bin/setup-wp.sh</code>.</p>
    @else
      <div class="blog-grid reveal">
        @while(have_posts()) @php(the_post())
          <a class="blog-card" href="{{ get_permalink() }}">
            @if (has_post_thumbnail())
              {!! get_the_post_thumbnail(null, 'large', ['loading' => 'lazy', 'decoding' => 'async']) !!}
            @else
              <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=900&q=70" width="900" height="600" alt="" loading="lazy" decoding="async">
            @endif
            <div class="blog-card-body">
              <span class="blog-meta">{{ get_the_category_list(' · ') ?: 'Notes' }} · {{ ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200) }} min</span>
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
        <a class="btn btn-primary" href="{{ home_url('/#book-showing') }}">Book a showing</a>
        <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse samples</a>
      </div>
    </div>
  </div>
</section>
