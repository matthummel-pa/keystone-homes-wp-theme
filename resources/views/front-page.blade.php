{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  <script type="application/ld+json">
  {
    "@@context":"https://schema.org",
    "@@type":"RealEstateAgent",
    "name":"Keystone Homes & Land (Concept Demo)",
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
      <p class="hero-sub">{!! $copy['hero_text'] ?: 'Farms, historic houses, and acreage across North Ridge, Mill Creek, and Oak Hollow. Filter by township, then book a showing.' !!}</p>
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
          <p>{!! $copy['intent_sell_lead'] ?: ($copy['intent_sell'] ?? 'Run a demo value range for a fictional address, then see how a CMA request would feel. Not an appraisal — a clear next step for sellers comparing options.') !!}</p>
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
            <p>{!! $copy['intent_note_1_text'] ?: 'Zoning, lot size, and Clean and Green (Act 319) change from North Ridge to Oak Hollow. Pick an area before you fall for a photo.' !!}</p>
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
      <header class="section-head reveal">
        <p class="eyebrow">Workflow</p>
        <h2 id="how-heading">From search to showing</h2>
        <p>Four scannable steps agents and buyers both understand.</p>
      </header>
      <div class="step-grid reveal">
        <div class="step">
          <h3>Search</h3>
          <p>Filter sample homes by type, price and acreage.</p>
        </div>
        <div class="step">
          <h3>Shortlist</h3>
          <p>Save favorites or pick a spotlight address.</p>
        </div>
        <div class="step">
          <h3>Book</h3>
          <p>Choose a demo date and time slot to tour.</p>
        </div>
        <div class="step">
          <h3>Confirm</h3>
          <p>See an on-page confirmation — no real emails.</p>
        </div>
      </div>
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
        <p class="eyebrow">Sample market</p>
        <h2 id="market-heading">Pulse at a glance</h2>
        <p>Illustrative numbers for layout — not live market data.</p>
      </header>
      <div class="market-grid reveal">
        <div class="market-stat"><strong>$398k</strong><span>Median (demo)</span><em>↑ Sample trend</em></div>
        <div class="market-stat"><strong>32</strong><span>Days on market</span><em class="down">↓ Demo delta</em></div>
        <div class="market-stat"><strong>1.6</strong><span>Months inventory</span><em>Sample signal</em></div>
        <div class="market-stat"><strong>95%</strong><span>List-to-sale</span><em>Illustrative</em></div>
      </div>
    </div>
  </section>

  <section class="section section-alt" id="value" aria-labelledby="tools-heading">
    <div class="wrap">
      <header class="section-head reveal">
        <p class="eyebrow">Agent tools</p>
        <h2 id="tools-heading">Price it. Watch it.</h2>
        <p>Two grids buyers and sellers actually use — value estimate and listing alerts.</p>
      </header>
      <div class="tools-grid">
        <div class="tool-panel reveal">
          <h3>Demo home value</h3>
          <p class="lede">Instant range for a fictional address. Not an appraisal.</p>
          <form class="form-grid two" id="valueForm">
            <div class="field" style="grid-column:1/-1">
              <label for="vAddress">Street address</label>
              <input id="vAddress" type="text" placeholder="100 Concept Way" required>
            </div>
            <div class="field">
              <label for="vBeds">Beds</label>
              <select id="vBeds"><option>2</option><option selected>3</option><option>4</option><option>5</option></select>
            </div>
            <div class="field">
              <label for="vAcres">Acres</label>
              <select id="vAcres"><option value="0.5">&lt; 1</option><option value="5" selected>1–10</option><option value="20">10–30</option><option value="40">30+</option></select>
            </div>
            <div class="field" style="grid-column:1/-1">
              <button type="submit" class="btn btn-primary" style="width:100%">Estimate value</button>
            </div>
          </form>
          <div class="val-result" id="valueResult" role="status" aria-live="polite"></div>
        </div>
        <div class="alert-panel reveal">
          <h3>Listing alerts</h3>
          <p>Demo inbox signup for new sample matches.</p>
          <form class="form-grid" id="alertForm">
            <div class="field">
              <label for="aEmail">Email</label>
              <input id="aEmail" type="email" placeholder="you@@example.test" required>
            </div>
            <div class="field">
              <label for="aType">Looking for</label>
              <select id="aType"><option>Homes</option><option>Land</option><option>Farms</option><option>Anything</option></select>
            </div>
            <div class="field">
              <label for="aMax">Max price</label>
              <select id="aMax"><option>$400,000</option><option selected>$600,000</option><option>$800,000</option><option>No max</option></select>
            </div>
            <button type="submit" class="btn btn-primary">Create alert</button>
          </form>
          <div class="confirm-msg" id="alertConfirm" role="status" aria-live="polite"><span>Demo alert saved — no email is sent.</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- SEO + scannable service grids -->
  <section class="section" aria-labelledby="seo-heading">
    <div class="wrap">
      <div class="seo-block reveal">
        <div>
          <p class="eyebrow">Guide</p>
          <h2 id="seo-heading">Buying a home or land parcel with a local agent</h2>
          <div class="prose-tight">
            <p>Buyers comparing homes, farms and acreage need clearer next steps than a long brochure. A strong realtor site pairs scannable inventory with tools that move people forward: filters, payment estimates, home-value ranges and showing appointments.</p>
            <h3>Homes for sale vs. land for sale</h3>
            <p>House shoppers usually start with beds, baths and commute. Land buyers start with access, utilities, perc potential and usable acreage. Separate paths — Buy, Sell, Tour — keep both audiences from bouncing.</p>
            <h3>Why showing bookings matter for SEO and conversion</h3>
            <p>Search visitors who can request a tour without leaving the page send a clear intent signal. Even in a concept demo, appointment UX shows how agents capture high-intent leads on listing and homepage templates.</p>
          </div>
        </div>
        <div class="scan-grid cols-2">
          <article class="scan-card">
            <span class="num">Buyers</span>
            <h3>What they scan for</h3>
            <ul>
              <li>Price and payment estimate</li>
              <li>Beds / baths / acreage</li>
              <li>Map location</li>
              <li>Next open house or tour slot</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Sellers</span>
            <h3>What they need fast</h3>
            <ul>
              <li>Home value range</li>
              <li>Days-on-market context</li>
              <li>CMA / agent call</li>
              <li>Prep checklist</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Agents</span>
            <h3>Tools that save time</h3>
            <ul>
              <li>Showing scheduler</li>
              <li>Listing alerts</li>
              <li>Shared market pulse</li>
              <li>Guided FAQ content</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">SEO</span>
            <h3>Content that ranks</h3>
            <ul>
              <li>Clear H1 / H2 structure</li>
              <li>HowTo + FAQ schema</li>
              <li>Area + property-type pages</li>
              <li>Fast LCP hero image</li>
            </ul>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-alt" aria-labelledby="faq-heading">
    <div class="wrap">
      <header class="section-head reveal">
        <p class="eyebrow">FAQ</p>
        <h2 id="faq-heading">Quick answers</h2>
      </header>
      <div class="faq-list reveal">
        <details class="faq-item">
          <summary>Is this a real brokerage?</summary>
          <p>No. Keystone Homes &amp; Land here is a design concept. Contact details, listings and market stats are fictional.</p>
        </details>
        <details class="faq-item">
          <summary>Does “Book a showing” schedule a real tour?</summary>
          <p>It only demonstrates appointment UX. Submitting the form shows an on-page confirmation — nothing is emailed or calendared.</p>
        </details>
        <details class="faq-item">
          <summary>Can agents reuse these patterns?</summary>
          <p>Yes. Search, spotlight grids, showing slots, value estimates and alerts are common high-performing realtor site modules.</p>
        </details>
      </div>
    </div>
  </section>

  <section class="section" aria-labelledby="stories-heading">
    <div class="wrap">
      <header class="section-head reveal">
        <p class="eyebrow">Samples</p>
        <h2 id="stories-heading">What clients might say</h2>
        <p>Placeholder quotes for layout — not real reviews.</p>
      </header>
      <div class="testi-grid reveal">
        <figure class="testi">
          <blockquote><p>“The showing scheduler made it obvious what to do next.”</p></blockquote>
          <figcaption><span class="testi-name">Sample Buyer A</span><span class="testi-loc">Demo review</span></figcaption>
        </figure>
        <figure class="testi">
          <blockquote><p>“Payment estimate beside the photo helped us compare homes faster.”</p></blockquote>
          <figcaption><span class="testi-name">Sample Buyer B</span><span class="testi-loc">Demo review</span></figcaption>
        </figure>
        <figure class="testi">
          <blockquote><p>“We used the value tool before calling — then booked a walk-through.”</p></blockquote>
          <figcaption><span class="testi-name">Sample Seller C</span><span class="testi-loc">Demo review</span></figcaption>
        </figure>
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
