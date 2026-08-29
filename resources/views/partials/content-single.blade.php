<article @php(post_class('h-entry prose'))>
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <ol>
      <li><a href="{{ home_url('/') }}">Home</a></li>
      <li><a href="{{ home_url('/blog') }}">Blog</a></li>
      <li><span aria-current="page">{!! get_the_title() !!}</span></li>
    </ol>
  </nav>

  @include('partials.page-hero', [
    'heroBrand' => 'Keystone Homes &amp; Land',
    'heroEyebrow' => (wp_strip_all_tags(get_the_category_list(' · ')) ?: 'Notes').' · '.get_the_date(),
    'heroTitle' => $title,
    'heroText' => has_excerpt() ? get_the_excerpt() : 'A short note for buyers comparing farms, historic houses, and acreage in Adams County.',
    'headingId' => 'post-hero-heading',
    'heroActions' => [
      ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
      ['href' => home_url('/blog'), 'label' => 'All posts', 'class' => 'btn btn-outline light'],
    ],
  ])

  <div class="wrap section e-content">
    @php(the_content())

    @if ($pagination())
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    @endif
  </div>

  @if ($relatedPosts)
  <section class="section section-alt" aria-labelledby="related-posts-heading">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">Keep reading</p>
        <h2 id="related-posts-heading">More notes for buyers</h2>
      </div>
      <div class="blog-grid reveal">
        @foreach ($relatedPosts as $related)
          <a class="blog-card" href="{{ $related['url'] }}">
            <img src="{{ $related['image'] }}" width="900" height="560" alt="{{ $related['alt'] }}" loading="lazy" decoding="async">
            <div class="blog-card-body">
              <span class="blog-meta">{{ $related['meta'] }}</span>
              <h3>{!! $related['title'] !!}</h3>
              <p>{{ $related['excerpt'] }}</p>
              <span class="teaser-link">Read post →</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <section class="section">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>Tour a sample home next.</h2>
        <p>Pick an address, choose a slot, and see how a modern realtor booking flow feels.</p>
        <div class="cta-actions">
          <a class="btn btn-primary" href="{{ home_url('/book/') }}">Book a showing</a>
          <a class="btn btn-outline light" href="{{ home_url('/blog') }}">All posts</a>
        </div>
      </div>
    </div>
  </section>
</article>
