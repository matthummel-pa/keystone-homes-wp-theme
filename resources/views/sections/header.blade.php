@php
  $req = trim($GLOBALS['wp']->request ?? '', '/');
  $isHome = ($req === '' || is_front_page());
  $isAreas = str_starts_with($req, 'areas');
  $isGuide = str_starts_with($req, 'guide');
  $isAgents = str_starts_with($req, 'agents') || is_singular('agent');
  $isContact = str_starts_with($req, 'contact');
  $isBlog = is_home() || is_singular('post') || $req === 'blog' || str_starts_with($req, 'blog/');
  $isListings = str_starts_with($req, 'listings') || is_singular('listing');
  $bookUrl = home_url('/book/');
  $nav = [
    ['label' => 'Home', 'url' => home_url('/'), 'active' => $isHome],
    ['label' => 'Listings', 'url' => home_url('/listings'), 'active' => $isListings],
    ['label' => 'Areas', 'url' => home_url('/areas'), 'active' => $isAreas],
    ['label' => 'Guide', 'url' => home_url('/guide'), 'active' => $isGuide],
    ['label' => 'Blog', 'url' => home_url('/blog'), 'active' => $isBlog],
    ['label' => 'Agents', 'url' => home_url('/agents'), 'active' => $isAgents],
    ['label' => 'Contact', 'url' => home_url('/contact'), 'active' => $isContact],
  ];
@endphp

<a href="#main" class="skip-link">Skip to main content</a>
<header class="site-header">
  <div class="header-inner">
    <a href="{{ home_url('/') }}" class="brand" aria-label="Keystone Real Estate concept, home">
      <svg class="brand-mark" viewBox="0 0 48 48" fill="none" aria-hidden="true">
        <rect width="48" height="48" rx="12" fill="#141210"/>
        <path d="M24 10 L40 22 V38 H8 V22 Z" fill="#1f6b4a"/>
        <rect x="20" y="26" width="8" height="12" fill="#fffcf7"/>
      </svg>
      <span class="brand-text">
        <strong>Keystone Real Estate</strong>
        <span>Concept demo</span>
      </span>
    </a>

    <nav class="main-nav" aria-label="Primary">
      <ul>
        @foreach ($nav as $item)
          <li>
            <a href="{{ $item['url'] }}" @if($item['active']) class="is-active" aria-current="page" @endif>{{ $item['label'] }}</a>
          </li>
        @endforeach
      </ul>
    </nav>

    <div class="header-cta">
      <a class="header-phone" href="tel:+15550100455">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
        <span class="header-phone-num">(555) 010-0455</span>
      </a>
      <a class="btn btn-primary btn-sm" href="{{ $bookUrl }}">Book a showing</a>
    </div>

    <button type="button" class="hamburger" id="hamburgerBtn" aria-expanded="false" aria-controls="mobileNav" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<div class="nav-backdrop" id="navBackdrop" hidden></div>
<nav class="mobile-nav" id="mobileNav" aria-label="Site menu" role="dialog" aria-modal="true" aria-hidden="true" hidden>
  <div class="mobile-nav-head">
    <div class="mobile-nav-brand">
      <svg width="32" height="32" viewBox="0 0 48 48" fill="none" aria-hidden="true">
        <rect width="48" height="48" rx="12" fill="#141210"/>
        <path d="M24 10 L40 22 V38 H8 V22 Z" fill="#1f6b4a"/>
        <rect x="20" y="26" width="8" height="12" fill="#fffcf7"/>
      </svg>
      <div>
        <p class="mobile-nav-kicker">Browse</p>
        <p class="mobile-nav-title">Keystone Real Estate</p>
      </div>
    </div>
    <button type="button" class="mobile-nav-close" id="mobileNavClose" aria-label="Close menu">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
  </div>
  <div class="mobile-nav-links">
    @foreach ($nav as $item)
      <a href="{{ $item['url'] }}" @if($item['active']) class="is-active" aria-current="page" @endif>
        {{ $item['label'] }}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
      </a>
    @endforeach
  </div>
  <div class="mobile-nav-foot">
    <a class="header-phone" href="tel:+15550100455">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
      Call (555) 010-0455
    </a>
    <a class="btn btn-primary" href="{{ $bookUrl }}">Book a showing</a>
  </div>
</nav>
