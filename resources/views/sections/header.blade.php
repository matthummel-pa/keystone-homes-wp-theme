@php
  $req = trim($GLOBALS['wp']->request ?? '', '/');
  $isHome = ($req === '' || is_front_page());
  $isAreas = str_starts_with($req, 'areas');
  $isGuide = str_starts_with($req, 'guide');
  $isAgents = str_starts_with($req, 'agents') || is_singular('agent');
  $isContact = str_starts_with($req, 'contact');
  $isBook = str_starts_with($req, 'book') || is_singular('booking');
  $isBlog = is_home() || is_singular('post') || $req === 'blog' || str_starts_with($req, 'blog/');
  $isListings = str_starts_with($req, 'listings') || is_singular('listing');
  $bookUrl = home_url('/book/');
@endphp

<a href="#main" class="skip-link">Skip to main content</a>
<header class="site-header">
  <div class="header-inner">
    <a href="{{ home_url('/') }}" class="brand" aria-label="Keystone Homes & Land concept, home">
      <svg class="brand-mark" viewBox="0 0 48 48" fill="none" aria-hidden="true">
        <rect width="48" height="48" rx="12" fill="#141210"/>
        <path d="M24 10 L40 22 V38 H8 V22 Z" fill="#1f6b4a"/>
        <rect x="20" y="26" width="8" height="12" fill="#fffcf7"/>
      </svg>
      <span class="brand-text">
        <strong>Keystone Homes &amp; Land</strong>
        <span>Concept demo</span>
      </span>
    </a>

    <nav class="main-nav" aria-label="Primary">
      <ul>
        <li><a href="{{ home_url('/') }}" @if($isHome) class="is-active" aria-current="page" @endif>Home</a></li>
        <li><a href="{{ home_url('/listings') }}" @if($isListings) class="is-active" aria-current="page" @endif>Listings</a></li>
        <li><a href="{{ home_url('/areas') }}" @if($isAreas) class="is-active" aria-current="page" @endif>Areas</a></li>
        <li><a href="{{ home_url('/guide') }}" @if($isGuide) class="is-active" aria-current="page" @endif>Guide</a></li>
        <li><a href="{{ home_url('/blog') }}" @if($isBlog) class="is-active" aria-current="page" @endif>Blog</a></li>
        <li><a href="{{ home_url('/agents') }}" @if($isAgents) class="is-active" aria-current="page" @endif>Agents</a></li>
        <li><a href="{{ $bookUrl }}" @if($isBook) class="is-active" aria-current="page" @endif>Book showing</a></li>
        <li><a href="{{ home_url('/contact') }}" @if($isContact) class="is-active" aria-current="page" @endif>Contact</a></li>
      </ul>
    </nav>

    <div class="header-cta">
      <a class="header-phone" href="tel:+15550100455">(555) 010-0455</a>
      <a class="btn btn-primary btn-sm" href="{{ $bookUrl }}">Book a showing</a>
    </div>

    <button type="button" class="hamburger" id="hamburgerBtn" aria-expanded="false" aria-controls="mobileNav" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>

  <nav class="mobile-nav" id="mobileNav" aria-label="Mobile" hidden>
    <a href="{{ home_url('/') }}" @if($isHome) class="is-active" aria-current="page" @endif>Home</a>
    <a href="{{ home_url('/listings') }}" @if($isListings) class="is-active" aria-current="page" @endif>Listings</a>
    <a href="{{ home_url('/areas') }}" @if($isAreas) class="is-active" aria-current="page" @endif>Areas</a>
    <a href="{{ home_url('/guide') }}" @if($isGuide) class="is-active" aria-current="page" @endif>Guide</a>
    <a href="{{ home_url('/blog') }}" @if($isBlog) class="is-active" aria-current="page" @endif>Blog</a>
    <a href="{{ home_url('/agents') }}" @if($isAgents) class="is-active" aria-current="page" @endif>Agents</a>
    <a href="{{ $bookUrl }}" @if($isBook) class="is-active" aria-current="page" @endif>Book showing</a>
    <a href="{{ home_url('/contact') }}" @if($isContact) class="is-active" aria-current="page" @endif>Contact</a>
    <a class="header-phone" href="tel:+15550100455">Call (555) 010-0455</a>
    <a class="btn btn-primary" href="{{ $bookUrl }}">Book a showing</a>
  </nav>
</header>
