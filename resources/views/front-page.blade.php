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
              <input id="aEmail" type="email" autocomplete="email" placeholder="you@@example.test" required>
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

  <!-- Buyer help — local, scannable -->
  <section class="section" aria-labelledby="seo-heading">
    <div class="wrap">
      <div class="seo-block reveal">
        <div>
          <p class="eyebrow">Adams County notes</p>
          <h2 id="seo-heading">Buying a farm, house, or land parcel here</h2>
          <div class="prose-tight">
            <p>Rural Adams County is fruit-belt and farm country: orchards on the ridges, tillable ground in the valleys, and century houses that still sit on a well. A useful realtor page tells you what to scan before you fall for a photo.</p>
            <h3>If you are shopping a house</h3>
            <p>Lead with type, price, beds, and commute. Acreage is extra unless you want a shop, a barn, or hobby ground. Still ask about well-or-public-water and how you reach the lane in January.</p>
            <h3>If you are shopping land</h3>
            <p>Lead with usable acres, legal access, and septic. A parcel without a perc answer is not the same product as a turnkey farmhouse. Price-per-acre helps you compare North Ridge to Oak Hollow without mixing house inventory in.</p>
          </div>
          <p class="help-links">
            <a href="{{ home_url('/guide') }}">Buyer tools →</a>
            <a href="{{ home_url('/areas') }}">Township reads →</a>
            <a href="{{ home_url('/listings') }}">Sample inventory →</a>
          </p>
        </div>
        <div class="scan-grid cols-2">
          <article class="scan-card">
            <span class="num">Houses</span>
            <h3>Scan this first</h3>
            <ul>
              <li>Price, beds, and baths</li>
              <li>Township and commute</li>
              <li>Well vs public water</li>
              <li>A showing slot that fits</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Land</span>
            <h3>Scan this first</h3>
            <ul>
              <li>Usable acres, not just deed acres</li>
              <li>Perc / septic status</li>
              <li>Road frontage and driveway</li>
              <li>Clean and Green / rollback risk</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Farms</span>
            <h3>Walk the working pieces</h3>
            <ul>
              <li>Barn, shop, and outbuilding use</li>
              <li>Tillable vs wooded split</li>
              <li>Livestock or orchard notes</li>
              <li>Who holds the water rights story</li>
            </ul>
          </article>
          <article class="scan-card">
            <span class="num">Next</span>
            <h3>Keep moving</h3>
            <ul>
              <li>Filter the sample grid</li>
              <li>Read a township page</li>
              <li>Run the demo value tool</li>
              <li>Book a fictional walk-through</li>
            </ul>
          </article>
        </div>
      </div>
    </div>
  </section>

  @include('partials.faq-list', [
    'faqTitle' => 'Questions before you filter',
    'faqText' => 'Short answers for house shoppers and acreage buyers. Sample listings stay fictional.',
    'faqHeadClass' => 'left',
  ])

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
