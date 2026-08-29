<article @php(post_class('h-entry prose'))>
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <ol>
      <li><a href="{{ home_url('/') }}">Home</a></li>
      <li><a href="{{ home_url('/blog') }}">Blog</a></li>
      <li><span aria-current="page">{!! get_the_title() !!}</span></li>
    </ol>
  </nav>

  <header class="page-hero">
    <div class="page-hero-inner">
      <p class="hero-brand">Keystone Homes &amp; Land</p>
      <p class="hero-eyebrow">{{ get_the_category_list(' · ') ?: 'Notes' }} · {{ get_the_date() }}</p>
      <h1 class="p-name">{!! $title !!}</h1>
      @if (has_excerpt())
        <p>{{ get_the_excerpt() }}</p>
      @endif
    </div>
  </header>

  <div class="wrap section e-content">
    @php(the_content())

    @if ($pagination())
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    @endif
  </div>

  <section class="section section-alt">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>Tour a sample home next.</h2>
        <p>Pick an address, choose a slot, and see how a modern realtor booking flow feels.</p>
        <div class="cta-actions">
          <a class="btn btn-primary" href="{{ home_url('/#book-showing') }}">Book a showing</a>
          <a class="btn btn-outline light" href="{{ home_url('/blog') }}">All posts</a>
        </div>
      </div>
    </div>
  </section>
</article>
