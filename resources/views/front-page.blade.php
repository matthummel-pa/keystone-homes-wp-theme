{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  <script type="application/ld+json">
  {
    "@@context":"https://schema.org",
    "@@type":"RealEstateAgent",
    "name":"Keystone Real Estate (Concept Demo)",
    "description":"Fictional concept brokerage for design demonstration. Not a live MLS or licensed office.",
    "url":"{{ home_url('/') }}",
    "telephone":"+1-555-010-0455",
    "email":@json('hello@keystone-concept.test'),
    "priceRange":"$$",
    "address":{
      "@@type":"PostalAddress",
      "streetAddress":"100 Concept Way",
      "addressLocality":"Sample Borough",
      "addressRegion":"PA",
      "postalCode":"00000",
      "addressCountry":"US"
    }
  }
  </script>

  @php
    $listingCount = count($catalogListings ?? []);
    $townshipCount = count($catalogTownships ?? []);
  @endphp
  <section class="hero" id="top" aria-labelledby="hero-heading">
    <figure class="hero-media">
      @include('partials.hero-image')
    </figure>
    <div class="hero-veil" aria-hidden="true"></div>
    <div class="hero-inner">
      <p class="hero-eyebrow">{{ $copy['hero_eyebrow'] ?: 'Adams County, Pennsylvania' }}</p>
      <h1 id="hero-heading">{!! $copy['hero_title'] ?: 'Homes worth <em>walking through.</em>' !!}</h1>
      <p class="hero-sub">{!! $copy['hero_text'] ?: 'Farms, historic houses, and acreage in North Ridge, Mill Creek, and Oak Hollow. Filter by township, then schedule a showing.' !!}</p>
      <ul class="hero-proof">
        <li><strong>{{ $listingCount ?: 8 }}</strong> sample listings</li>
        <li><strong>{{ $townshipCount ?: 3 }}</strong> townships</li>
        <li><a href="{{ home_url('/book/') }}">Book a showing</a></li>
      </ul>
      <form class="hero-search" id="heroSearchForm" role="search" aria-label="Search sample listings">
        <div class="hero-search-row">
          <div class="field">
            <label for="hsType">Type</label>
            <select id="hsType" name="type">
              <option value="all">Any</option>
              <option value="home">Home</option>
              <option value="farm">Farm</option>
              <option value="land">Land</option>
              <option value="historic">Historic</option>
            </select>
          </div>
          <div class="field">
            <label for="hsPrice">Price</label>
            <select id="hsPrice" name="price">
              <option value="all">Any</option>
              <option value="0-250000">Under $250k</option>
              <option value="250000-500000">$250k–$500k</option>
              <option value="500000-750000">$500k–$750k</option>
              <option value="750000-999999999">$750k+</option>
            </select>
          </div>
          <div class="field">
            <label for="hsAcreage">Acreage</label>
            <select id="hsAcreage" name="acreage">
              <option value="all">Any</option>
              <option value="0-1">&lt; 1 acre</option>
              <option value="1-10">1–10</option>
              <option value="10-30">10–30</option>
              <option value="30-999">30+</option>
            </select>
          </div>
          <div class="field">
            <label for="hsTownship">Area</label>
            <select id="hsTownship" name="township">
              <option value="all">Any sample area</option>
              <option value="Cumberland">North Ridge</option>
              <option value="Straban">Mill Creek</option>
              <option value="Franklin">Oak Hollow</option>
            </select>
          </div>
        </div>
        <div class="hero-search-actions">
          <a class="hero-search-link" href="{{ home_url('/listings') }}">{{ $copy['hero_cta_secondary'] ?: 'Browse all listings' }}</a>
          <button type="submit" class="btn btn-primary">{{ $copy['hero_cta_primary'] ?: 'Show matches' }}</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Buy / sell / tour -->
  <section class="intent-band" id="search" aria-labelledby="intent-heading">
    <div class="wrap">
      <header class="section-head left intent-head reveal">
        <p class="eyebrow">{{ $copy['intent_eyebrow'] ?: 'Start here' }}</p>
        <h2 id="intent-heading">{!! $copy['intent_title'] ?: 'Buy, sell, or walk a place in Adams County' !!}</h2>
        <p>{!! $copy['intent_text'] ?: 'Farms, historic houses, and acreage need different next steps. Scan sample inventory, run a value range, or book a showing — stay on the page, no brochure maze.' !!}</p>
      </header>
      <div class="intent-grid reveal">
        <a class="intent-card" href="{{ home_url('/listings') }}">
          <span class="intent-kicker">Buyers</span>
          <h3>{!! $copy['intent_buy_title'] ?: 'Buy a home, farm, or land' !!}</h3>
          <p>{!! $copy['intent_buy_lead'] ?: ($copy['intent_buy'] ?? 'Filter sample homes, working farms, and acreage by township — North Ridge, Mill Creek, and Oak Hollow. Scan price, beds, and usable acres on a grid or map.') !!}</p>
          <ul>
            <li>{!! $copy['intent_buy_b1'] ?: 'Homes, farms, land, and historic houses' !!}</li>
            <li>{!! $copy['intent_buy_b2'] ?: 'Township, price, and acreage filters' !!}</li>
          </ul>
          <span class="intent-go">{{ $copy['intent_buy_cta'] ?: 'Browse listings' }} →</span>
        </a>
        <a class="intent-card" href="#value">
          <span class="intent-kicker">Sellers</span>
          <h3>{!! $copy['intent_sell_title'] ?: 'Price a place before you list' !!}</h3>
          <p>{!! $copy['intent_sell_lead'] ?: ($copy['intent_sell'] ?: 'Run a demo value range for a fictional address, then see how a CMA request would feel. Not an appraisal — a clear next step for sellers comparing options.') !!}</p>
          <ul>
            <li>{!! $copy['intent_sell_b1'] ?: 'Instant sample value range' !!}</li>
            <li>{!! $copy['intent_sell_b2'] ?: 'Alert path for new matches' !!}</li>
          </ul>
          <span class="intent-go">{{ $copy['intent_sell_cta'] ?: 'Estimate value' }} →</span>
        </a>
        <a class="intent-card" href="{{ home_url('/book/') }}">
          <span class="intent-kicker">Tours</span>
          <h3>{!! $copy['intent_tour_title'] ?: 'Walk it with an agent' !!}</h3>
          <p>{!! $copy['intent_tour_lead'] ?: ($copy['intent_tour'] ?? 'Pick a sample listing, a date, and a time. The request is saved for the listing agent. Rural Adams County showings often mean a lane, a well, and boots.') !!}</p>
          <ul>
            <li>{!! $copy['intent_tour_b1'] ?: 'Date and time-slot picker' !!}</li>
            <li>{!! $copy['intent_tour_b2'] ?: 'Paired with the listing agent' !!}</li>
          </ul>
          <span class="intent-go">{{ $copy['intent_tour_cta'] ?: 'Book a showing' }} →</span>
        </a>
      </div>
      <div class="intent-notes reveal">
        <p class="intent-notes-label">{{ $copy['intent_notes_label'] ?: 'Good to know before you filter' }}</p>
        <div class="intent-notes-grid">
          <article class="intent-note">
            <strong>{!! $copy['intent_note_1_title'] ?: 'Township first' !!}</strong>
            <p>{!! $copy['intent_note_1_text'] ?: 'Zoning, lot size, and Clean and Green (Act 319) change from North Ridge to Oak Hollow. Choose a township before you compare photos.' !!}</p>
          </article>
          <article class="intent-note">
            <strong>{!! $copy['intent_note_2_title'] ?: 'Water and waste' !!}</strong>
            <p>{!! $copy['intent_note_2_text'] ?: 'Rural parcels often mean a well and a perc test, not municipal hookups. Walk that before you write an offer.' !!}</p>
          </article>
          <article class="intent-note">
            <strong>{!! $copy['intent_note_3_title'] ?: 'Showings are muddy' !!}</strong>
            <p>{!! $copy['intent_note_3_text'] ?: 'Lanes, gates, and wet ground. Wear boots. Mention pets or if you are new to land — the agent can prep.' !!}</p>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- Scannable featured strip -->
  <section class="section section-alt" aria-labelledby="spotlight-heading">
    <div class="wrap">
      <header class="section-head left reveal">
        <p class="eyebrow">{{ $copy['spotlight_eyebrow'] ?: 'Spotlight' }}</p>
        <h2 id="spotlight-heading">{!! $copy['spotlight_title'] ?: 'Three sample homes to scan' !!}</h2>
        <p>{!! $copy['spotlight_text'] ?: 'Price · beds · acres — then book a fictional walk-through.' !!}</p>
      </header>
      <div class="listing-mini-grid reveal">
        @forelse ($spotlightListings as $listing)
          <a class="listing-mini" href="{{ home_url('/book/') }}?listing_id={{ $listing['id'] }}" data-listing-id="{{ $listing['id'] }}">
            @if ($listing['image'])
              <img src="{{ $listing['image'] }}" width="800" height="500" alt="" loading="lazy" decoding="async">
            @else
              <div class="listing-mini-photo" style="background:{{ $listing['grad'] }};height:150px"></div>
            @endif
            <div>
              <strong>{{ \App\Support\Catalog::formatMoney((int) $listing['price']) }}</strong>
              <span>
                {{ $listing['title'] }}
                @if ($listing['type'] !== 'land')
                  · {{ $listing['beds'] }} bd
                @endif
                · {{ $listing['acres'] }} acres
              </span>
              <span class="chip">Listing · Book showing</span>
            </div>
          </a>
        @empty
          <p class="empty-state">Add featured listings in WP Admin → Listings.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- How it works -->
  <section class="section" aria-labelledby="how-heading">
    <div class="wrap">
      <header class="section-head left reveal">
        <p class="eyebrow">How a tour starts</p>
        <h2 id="how-heading">From search to showing</h2>
        <p>Township first, then a walk on the ground — not office theater. This demo stops at on-page confirmation.</p>
      </header>
      <ol class="step-grid reveal">
        <li class="step">
          <figure class="step-photo">
            <img
              src="{{ get_theme_file_uri('public/images/tour-step-township.jpg') }}"
              width="1200"
              height="800"
              alt="Country road past a white farmhouse and red barn in a rural Pennsylvania township"
              loading="lazy"
              decoding="async"
            >
          </figure>
          <div class="step-copy">
            <h3>Filter the township</h3>
            <p>Start with the township so zoning and Clean and Green are not compared across Oak Hollow land and a North Ridge house.</p>
          </div>
        </li>
        <li class="step">
          <figure class="step-photo">
            <img
              src="{{ get_theme_file_uri('public/images/tour-step-card.jpg') }}"
              width="1200"
              height="800"
              alt="Hands reviewing papers at a worn farmhouse kitchen table"
              loading="lazy"
              decoding="async"
            >
          </figure>
          <div class="step-copy">
            <h3>Read the card</h3>
            <p>Price and beds on a house; usable acres, access, and utilities on land. Spotlight homes below already select the listing.</p>
          </div>
        </li>
        <li class="step">
          <figure class="step-photo">
            <img
              src="{{ get_theme_file_uri('public/images/tour-step-book.jpg') }}"
              width="1200"
              height="800"
              alt="Writing a showing time at a farmhouse table beside muddy work boots"
              loading="lazy"
              decoding="async"
            >
          </figure>
          <div class="step-copy">
            <h3>Book the hour</h3>
            <p>Pick a date and a time. Evening slots exist because farm showings often happen after commute.</p>
          </div>
        </li>
        <li class="step">
          <figure class="step-photo">
            <img
              src="{{ get_theme_file_uri('public/images/tour-step-walk.jpg') }}"
              width="1200"
              height="800"
              alt="An agent walking buyers up a gravel lane toward a white farmhouse"
              loading="lazy"
              decoding="async"
            >
          </figure>
          <div class="step-copy">
            <h3>Walk the ground</h3>
            <p>Wear boots and walk the lane. Here you get an on-page receipt — no email, no calendar invite.</p>
          </div>
          <a class="btn btn-primary" href="{{ home_url('/book/') }}">Book a showing</a>
        </li>
      </ol>
    </div>
  </section>

  <!-- BOOK SHOWING — key realtor tool -->
  <section class="section section-alt" id="book-showing" aria-labelledby="book-heading">
    <div class="wrap">
      <header class="section-head left reveal">
        <p class="eyebrow">{{ $copy['book_eyebrow'] ?: 'Appointments' }}</p>
        <h2 id="book-heading">{!! $copy['book_title'] ?: 'Book a house showing' !!}</h2>
        <p>{!! $copy['book_text'] ?: 'Demo scheduler for touring sample homes. Requests are saved to Bookings as Requested.' !!}</p>
      </header>

      <div class="booking-shell reveal">
        @include('partials.booking-form')
        @include('partials.booking-photo')
      </div>
    </div>
  </section>

  <!-- Market + tools grids -->
  <section class="section" aria-labelledby="market-heading">
    <div class="wrap">
      <header class="section-head reveal">
        <p class="eyebrow">Adams County market</p>
        <h2 id="market-heading">Pulse at a glance</h2>
        <p>A sample snapshot of how this inventory would read in a listing conversation — not a live CMA or MLS feed.</p>
      </header>
      <div class="market-grid reveal">
        <article class="market-stat">
          <strong>$398k</strong>
          <span>Median sale price</span>
          <em class="is-up"><span aria-hidden="true">↑</span> 2.1% vs last quarter</em>
        </article>
        <article class="market-stat">
          <strong>32</strong>
          <span>Days on market</span>
          <em class="is-down"><span aria-hidden="true">↓</span> 5 days vs last quarter</em>
        </article>
        <article class="market-stat">
          <strong>1.6</strong>
          <span>Months of inventory</span>
          <em>Limited active supply</em>
        </article>
        <article class="market-stat">
          <strong>95%</strong>
          <span>List-to-sale ratio</span>
          <em>Offers near asking</em>
        </article>
      </div>
    </div>
  </section>

  <section class="section section-alt" id="value" aria-labelledby="tools-heading">
    <div class="wrap">
      <header class="section-head reveal">
        <p class="eyebrow">Agent tools</p>
        <h2 id="tools-heading">Value range and listing alerts</h2>
        <p>Two tools buyers and sellers use first: a sample value range, then an alert for new matches.</p>
      </header>
      <div class="tools-grid">
        <div class="tool-panel reveal">
          <h3>Demo home value</h3>
          <p class="lede">Instant range for a fictional address. Not an appraisal.</p>
          <form class="form-grid two" id="valueForm">
            <div class="field field-span">
              <label for="vAddress">Street address</label>
              <input id="vAddress" type="text" autocomplete="street-address" placeholder="100 Concept Way" required>
            </div>
            <div class="field">
              <label for="vBeds">Beds</label>
              <select id="vBeds"><option>2</option><option selected>3</option><option>4</option><option>5</option></select>
            </div>
            <div class="field">
              <label for="vAcres">Acres</label>
              <select id="vAcres"><option value="0.5">&lt; 1</option><option value="5" selected>1–10</option><option value="20">10–30</option><option value="40">30+</option></select>
            </div>
            <div class="field field-span">
              <button type="submit" class="btn btn-primary btn-block">Estimate value</button>
            </div>
          </form>
          <div class="val-result" id="valueResult" role="status" aria-live="polite"></div>
        </div>
        <div class="alert-panel reveal">
          <h3>Listing alerts</h3>
          <p>Demo inbox signup for new sample matches.</p>
          <form class="form-grid two" id="alertForm">
            <div class="field field-span">
              <label for="aEmail">Email</label>
              <input id="aEmail" type="email" autocomplete="email" placeholder="{{ 'you@keystone-concept.test' }}" required>
            </div>
            <div class="field">
              <label for="aType">Looking for</label>
              <select id="aType"><option>Homes</option><option>Land</option><option>Farms</option><option>Anything</option></select>
            </div>
            <div class="field">
              <label for="aMax">Max price</label>
              <select id="aMax"><option>$400,000</option><option selected>$600,000</option><option>$800,000</option><option>No max</option></select>
            </div>
            <div class="field field-span">
              <button type="submit" class="btn btn-primary btn-block">Create alert</button>
            </div>
          </form>
          <div class="confirm-msg" id="alertConfirm" role="status" aria-live="polite"><span>Demo alert saved — no email is sent.</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Buyer help — local, scannable -->
  <section class="section" aria-labelledby="seo-heading">
    <div class="wrap">
      <div class="seo-block reveal">
        <div>
          <p class="eyebrow">Adams County notes</p>
          <h2 id="seo-heading">Buying a home, farm, or land in Adams County</h2>
          <div class="prose-tight">
            <p>Rural Adams County is orchard and farm country: fruit on the ridges, tillable ground in the valleys, and older houses that still rely on a private well. Compare listings the way a local agent would — township first, then the utilities and access that change value.</p>
            <h3>When you are buying a house</h3>
            <p>Start with price, bedrooms, and the commute. Acreage matters when you want a shop or barn; it does not replace water, septic, and a lane you can use in January. Confirm well or public water before you schedule a second visit.</p>
            <h3>When you are buying land</h3>
            <p>Start with usable acres, recorded access, and septic feasibility. A parcel without a perc answer is a different product than a finished farmhouse. Price per acre lets you compare North Ridge to Oak Hollow without mixing house inventory into the set.</p>
          </div>
          <p class="help-links">
            <a href="{{ home_url('/guide') }}">Buyer guide →</a>
            <a href="{{ home_url('/areas') }}">Township notes →</a>
            <a href="{{ home_url('/listings') }}">Sample listings →</a>
          </p>
        </div>
        <div class="scan-grid cols-2">
          <article class="scan-card">
            <span class="num">Houses</span>
            <h3>Review first</h3>
            <ul>
              <li>Price, bedrooms, and baths</li>
              <li>Township and commute</li>
              <li>Well or public water</li>
              <li>A showing that fits the week</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Land</span>
            <h3>Review first</h3>
            <ul>
              <li>Usable acres, not only deed acres</li>
              <li>Perc and septic status</li>
              <li>Road frontage and driveway</li>
              <li>Clean and Green rollback risk</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Farms</span>
            <h3>Walk the working ground</h3>
            <ul>
              <li>Barn, shop, and outbuildings</li>
              <li>Tillable versus wooded split</li>
              <li>Livestock or orchard use</li>
              <li>Water rights and irrigation</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Next</span>
            <h3>Recommended next steps</h3>
            <ul>
              <li>Filter the sample listings</li>
              <li>Read the township notes</li>
              <li>Run a sample value range</li>
              <li>Schedule a showing</li>
            </ul>
          </article>
        </div>
      </div>
    </div>
  </section>

  @include('partials.faq-list', [
    'faqTitle' => 'Questions buyers ask first',
    'faqText' => 'Practical answers for house and acreage shoppers. Listings on this page are samples.',
    'faqHeadClass' => 'left',
  ])

  <section class="section" aria-labelledby="stories-heading">
    <div class="wrap">
      <header class="section-head reveal">
        <p class="eyebrow">Samples</p>
        <h2 id="stories-heading">What clients might say</h2>
        <p>Placeholder quotes for layout — not real reviews. Sample names and photos only; nothing here is a live Google review.</p>
        <p class="testi-avg">4.9 sample average — demo scores, not a brokerage claim.</p>
      </header>
      {{--
        Future: replace [data-reviews-source="demo"] cards from a server-proxied Google Places
        reviews payload (author_name, rating, text, profile_photo_url, relative_time_description).
        Do not call Google from the browser. Theme stays static until an endpoint exists.
        Do not emit Review / AggregateRating schema for these demo cards.
      --}}
      <div
        id="client-reviews"
        class="testi-grid reveal"
        data-reviews-source="demo"
        data-reviews-provider="google"
      >
        @php
          $starD = 'M12 2.5l2.86 5.8 6.4.93-4.63 4.51 1.09 6.36L12 16.98 6.28 20.1l1.09-6.36L2.74 9.23l6.4-.93L12 2.5z';
          $reviewCards = $reviews ?? [];
        @endphp
        @foreach ($reviewCards as $review)
          @php
            $rating = (float) ($review['rating'] ?? 0);
            $score = number_format($rating, 1);
            $author = $review['author_name'] ?? 'Sample reviewer';
            $text = $review['text'] ?? '';
            $photo = $review['profile_photo_url'] ?? '';
            $relative = $review['relative_time_description'] ?? '';
            $photoUrl = $photo !== '' ? \App\View\Composers\FrontPage::publicUri($photo) : '';
            $initials = '';
            foreach (array_slice(preg_split('/\s+/', trim($author)) ?: [], 0, 2) as $part) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
          @endphp
          <article
            class="review-card testi"
            data-author-name="{{ $author }}"
            data-rating="{{ $score }}"
            data-relative-time="{{ $relative }}"
            data-profile-photo-url="{{ $photoUrl }}"
            data-text="{{ $text }}"
          >
            <div class="review-card__head">
              @if ($photo !== '')
                <img
                  class="review-card__photo"
                  src="{{ $photoUrl }}"
                  alt="Portrait of {{ $author }}"
                  width="52"
                  height="52"
                  loading="lazy"
                  decoding="async"
                >
              @else
                <span class="review-card__photo review-card__photo--fallback" aria-hidden="true">{{ $initials }}</span>
              @endif
              <div class="review-card__identity">
                <p class="review-card__author testi-name">{{ $author }}</p>
                @if (! empty($review['location']))
                  <span class="review-card__loc testi-loc">{{ $review['location'] }}</span>
                @endif
                <div class="review-card__meta testi-rating">
                  <span class="visually-hidden">Sample rating {{ $score }} out of 5</span>
                  <span class="testi-stars" aria-hidden="true">
                    @for ($i = 1; $i <= 5; $i++)
                      @php $fill = max(0, min(1, $rating - ($i - 1))); @endphp
                      <span class="testi-star{{ $fill >= 1 ? ' is-full' : ($fill > 0 ? ' is-partial' : ' is-empty') }}"@if ($fill > 0 && $fill < 1) style="--star-fill: {{ (int) round($fill * 100) }}%"@endif>
                        <svg viewBox="0 0 24 24" focusable="false">
                          <path class="testi-star-empty" d="{{ $starD }}"/>
                          <path class="testi-star-fill" d="{{ $starD }}"/>
                        </svg>
                      </span>
                    @endfor
                  </span>
                  <span class="testi-score" aria-hidden="true">{{ $score }}</span>
                  @if ($relative !== '')
                    <span class="review-card__time">{{ $relative }}</span>
                  @endif
                </div>
              </div>
            </div>
            <blockquote class="review-card__text"><p>“{{ $text }}”</p></blockquote>
          </article>
        @endforeach
        <p class="reviews-empty" hidden>Reviews will appear here once the Google feed is connected.</p>
      </div>
    </div>
  </section>

  <section class="section section-alt" aria-labelledby="cta-heading">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2 id="cta-heading">Tour a sample home next.</h2>
        <p>Pick an address, choose a slot, and see how a modern realtor booking flow feels.</p>
        <div class="cta-actions">
          <a class="btn btn-primary" href="{{ home_url('/book/') }}">Book a showing</a>
          <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse samples</a>
        </div>
      </div>
    </div>
  </section>

@endsection
