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
    "email":"hello@@keystone-concept.test",
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

  <section class="hero" id="top" aria-labelledby="hero-heading">
    <figure class="hero-media">
      <img
        src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=1600&q=75"
        srcset="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=800&q=70 800w,
                https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=1600&q=75 1600w"
        sizes="100vw"
        width="1600" height="1067" alt="" decoding="async" fetchpriority="high"
      >
    </figure>
    <div class="hero-veil" aria-hidden="true"></div>
    <div class="hero-inner">
      <p class="hero-brand">Keystone Homes &amp; Land</p>
      <h1 id="hero-heading">Homes worth walking through.</h1>
      <p class="hero-sub">Search sample listings, price a demo home, and book a fictional showing — built to show modern realtor UX.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#search">Search samples</a>
        <a class="btn btn-outline light" href="#book-showing">Book a showing</a>
      </div>
    </div>
  </section>

  <!-- Intent grid -->
  <section class="intent-band" aria-label="Choose a path">
    <div class="wrap">
      <div class="intent-grid">
        <a class="intent-card" href="{{ home_url('/listings') }}">
          <strong>Buy</strong>
          <span>Filter sample homes, farms and land. Map + grid views.</span>
          <em>Browse listings →</em>
        </a>
        <a class="intent-card" href="#value">
          <strong>Sell</strong>
          <span>Run a demo value range, then request a sample CMA.</span>
          <em>Price a home →</em>
        </a>
        <a class="intent-card" href="#book-showing">
          <strong>Tour</strong>
          <span>Pick a sample address and reserve a showing slot.</span>
          <em>Book showing →</em>
        </a>
      </div>
    </div>
  </section>

  <section class="section search-band" id="search" aria-labelledby="search-heading">
    <div class="wrap">
      <header class="section-head left reveal">
        <p class="eyebrow">Find</p>
        <h2 id="search-heading">Search sample inventory</h2>
        <p>Short filters. Fast scan. Every result is fictional demo data.</p>
      </header>
      <form class="listing-search reveal" id="heroSearchForm" role="search" aria-label="Search sample listings">
        <div class="listing-search-row">
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
        <div class="listing-search-actions">
          <button type="submit" class="btn btn-primary">Show matches</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Scannable featured strip -->
  <section class="section section-alt" aria-labelledby="spotlight-heading">
    <div class="wrap">
      <header class="section-head left reveal">
        <p class="eyebrow">Spotlight</p>
        <h2 id="spotlight-heading">Three sample homes to scan</h2>
        <p>Price · beds · acres — then book a fictional walk-through.</p>
      </header>
      <div class="listing-mini-grid reveal">
        <a class="listing-mini" href="#book-showing" data-book-property="Willow Creek Farmhouse">
          <img src="https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?auto=format&fit=crop&w=800&q=70" width="800" height="500" alt="White traditional farmhouse with picket fence" loading="lazy" decoding="async">
          <div>
            <strong>$649,000</strong>
            <span>Willow Creek Farmhouse · 4 bd · 12 acres</span>
            <span class="chip">Sample · Book showing</span>
          </div>
        </a>
        <a class="listing-mini" href="#book-showing" data-book-property="Maple Street Cape">
          <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=800&q=70" width="800" height="500" alt="Traditional Cape Cod style home with porch" loading="lazy" decoding="async">
          <div>
            <strong>$525,000</strong>
            <span>Maple Street Cape · 4 bd · 8 acres</span>
            <span class="chip">Sample · Book showing</span>
          </div>
        </a>
        <a class="listing-mini" href="#book-showing" data-book-property="Harbor Lane Colonial">
          <img src="https://images.unsplash.com/photo-1628624747186-a941c476b7ef?auto=format&fit=crop&w=800&q=70" width="800" height="500" alt="Traditional two-story suburban home" loading="lazy" decoding="async">
          <div>
            <strong>$349,900</strong>
            <span>Harbor Lane Colonial · 3 bd · 0.6 acres</span>
            <span class="chip">Sample · Book showing</span>
          </div>
        </a>
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
        <p class="eyebrow">Appointments</p>
        <h2 id="book-heading">Book a house showing</h2>
        <p>Demo scheduler for touring sample homes. Nothing is sent to a real calendar.</p>
      </header>

      <div class="booking-shell reveal">
        <form id="showingForm" novalidate>
          <div class="form-grid two">
            <div class="field" style="grid-column:1/-1">
              <label for="showProperty">Property to tour</label>
              <select id="showProperty" name="property" required>
                <option value="">Select a sample home…</option>
                <option>Willow Creek Farmhouse — $649,000</option>
                <option>Maple Street Cape — $525,000</option>
                <option>Harbor Lane Colonial — $349,900</option>
                <option>Mill Creek Acreage — $215,000</option>
                <option>Oak Hollow Homestead — $795,000</option>
              </select>
            </div>
            <div class="field">
              <label for="showDate">Preferred date</label>
              <input id="showDate" name="date" type="date" required>
            </div>
            <div class="field">
              <label for="showType">Showing type</label>
              <select id="showType" name="type">
                <option>In-person tour</option>
                <option>Private preview</option>
                <option>Virtual walk-through</option>
              </select>
            </div>
          </div>

          <fieldset style="border:0;padding:0;margin:18px 0 0">
            <legend class="field" style="margin-bottom:8px"><span style="font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-faint)">Available times</span></legend>
            <div class="slot-grid" id="slotGrid" role="group" aria-label="Time slots">
              <button type="button" class="slot" data-time="9:00 AM">9:00 AM</button>
              <button type="button" class="slot" data-time="10:30 AM">10:30 AM</button>
              <button type="button" class="slot" data-time="12:00 PM">12:00 PM</button>
              <button type="button" class="slot" data-time="1:30 PM">1:30 PM</button>
              <button type="button" class="slot" data-time="3:00 PM">3:00 PM</button>
              <button type="button" class="slot" data-time="4:30 PM">4:30 PM</button>
              <button type="button" class="slot" data-time="5:30 PM">5:30 PM</button>
              <button type="button" class="slot" data-time="6:30 PM">6:30 PM</button>
            </div>
            <input type="hidden" id="showTime" name="time" value="" required>
          </fieldset>

          <div class="form-grid two" style="margin-top:18px">
            <div class="field">
              <label for="showName">Your name</label>
              <input id="showName" name="name" type="text" autocomplete="name" placeholder="Alex Buyer" required>
            </div>
            <div class="field">
              <label for="showPhone">Phone</label>
              <input id="showPhone" name="phone" type="tel" autocomplete="tel" placeholder="(555) 010-0199" required>
            </div>
            <div class="field" style="grid-column:1/-1">
              <label for="showEmail">Email</label>
              <input id="showEmail" name="email" type="email" autocomplete="email" placeholder="you@@example.test" required>
            </div>
            <div class="field" style="grid-column:1/-1">
              <label for="showNotes">Notes (optional)</label>
              <textarea id="showNotes" name="notes" rows="3" placeholder="Gate code questions, pets, first-time buyer…"></textarea>
            </div>
            <div class="field" style="grid-column:1/-1">
              <button type="submit" class="btn btn-primary" style="width:100%">Request showing</button>
            </div>
          </div>
          <p class="form-note">Demo only — no emails, texts or calendar invites are sent.</p>
          <div class="confirm-msg" id="showingConfirm" role="status" aria-live="polite"></div>
        </form>

        <aside class="booking-summary" aria-label="Why agents use this">
          <strong>Built for realtor workflows</strong>
          <p style="margin:0 0 12px">Showing appointments are the highest-intent action on a listing site. This pattern keeps property, date and time in one scan.</p>
          <ul class="scan-card" style="box-shadow:none;border:0;padding:0;background:transparent">
            <li>Property locked before time selection</li>
            <li>Slot chips beat long dropdowns</li>
            <li>Mobile-first required fields</li>
            <li>Clear “demo only” confirmation copy</li>
          </ul>
          <div class="chip-row">
            <span class="chip">In-person</span>
            <span class="chip">Private preview</span>
            <span class="chip">Virtual</span>
          </div>
        </aside>
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
          <a class="btn btn-primary" href="#book-showing">Book a showing</a>
          <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse samples</a>
        </div>
      </div>
    </div>
  </section>

@endsection
