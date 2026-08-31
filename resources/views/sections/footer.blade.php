@php
  $bookUrl = $identity['bookUrl'] ?? home_url('/book/');
  $phone = $identity['phone'] ?? '(555) 010-0455';
  $phoneHref = $identity['phoneHref'] ?? 'tel:+15550100455';
  $email = $identity['email'] ?? 'hello@keystone-concept.test';
  $brand = $identity['brand'] ?? 'Keystone Real Estate';
  $cta = $identity['ctaLabel'] ?? 'Book a showing';
  $explore = $footerNav ?? [];
@endphp

<footer class="site-footer">
  <div class="wrap">
    <div class="footer-cta">
      <div>
        <p class="eyebrow">{{ __('Next step', 'keystone-homes') }}</p>
        <h2>{{ __('Tour a sample home', 'keystone-homes') }}</h2>
        <p>{{ __('Pick a listing, choose a slot, and see how a modern realtor booking flow feels.', 'keystone-homes') }}</p>
      </div>
      <div class="footer-cta-actions">
        <a class="btn btn-primary" href="{{ esc_url($bookUrl) }}">{{ $cta }}</a>
        <a class="btn btn-outline light" href="{{ esc_url($phoneHref) }}">{{ __('Call the office', 'keystone-homes') }}</a>
      </div>
    </div>

    <div class="footer-grid">
      <div class="footer-intro">
        <div class="footer-brand">
          <svg width="34" height="34" viewBox="0 0 48 48" fill="none" aria-hidden="true">
            <rect width="48" height="48" rx="12" fill="var(--accent)"/>
            <path d="M24 10 L40 22 V38 H8 V22 Z" fill="#141210"/>
            <rect x="20" y="26" width="8" height="12" fill="#fffcf7"/>
          </svg>
          <strong>{{ $brand }}</strong>
        </div>
        <p>{{ $identity['footerBlurb'] ?? '' }}</p>
        @include('partials.social-links')
      </div>
      <div>
        <h2 class="footer-heading">{{ __('Office', 'keystone-homes') }}</h2>
        <address>
          {!! nl2br(esc_html($identity['address'] ?? '')) !!}<br>
          <a href="{{ esc_url($phoneHref) }}">{{ $phone }}</a><br>
          <a href="mailto:{{ esc_attr($email) }}">{{ $email }}</a>
        </address>
      </div>
      <div>
        <h2 class="footer-heading">{{ __('Hours', 'keystone-homes') }}</h2>
        <p>{!! nl2br(esc_html($identity['hours'] ?? '')) !!}</p>
      </div>
      <nav aria-labelledby="footer-links-heading">
        <h2 class="footer-heading" id="footer-links-heading">{{ __('Explore', 'keystone-homes') }}</h2>
        <ul class="footer-links">
          @foreach ($explore as $item)
            <li><a href="{{ esc_url($item['url']) }}" @if(! empty($item['active'])) aria-current="page" @endif>{{ $item['label'] }}</a></li>
          @endforeach
        </ul>
      </nav>
    </div>

    @if (is_active_sidebar('sidebar-footer'))
      <div class="footer-widgets">
        @php(dynamic_sidebar('sidebar-footer'))
      </div>
    @endif

    <p class="footer-service-area">{{ __('Serving a fictional Sample County market for design demonstration purposes.', 'keystone-homes') }}</p>
    <div class="footer-bottom">
      <div class="equal-housing">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 21v-6h6v6"/></svg>
        <span>{{ __('Equal Housing Opportunity (concept)', 'keystone-homes') }}</span>
      </div>
      <p>
        &copy; <span data-year>{{ date('Y') }}</span> {{ $brand }}
        @if (! empty($identity['showCredit']))
          @if (! empty($identity['creditUrl']))
            · <a href="{{ esc_url($identity['creditUrl']) }}" rel="nofollow noopener">{{ $identity['creditText'] }}</a>
          @else
            · {{ $identity['creditText'] }}
          @endif
        @endif
      </p>
    </div>
  </div>
</footer>
