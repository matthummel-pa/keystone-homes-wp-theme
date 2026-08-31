{{--
  Template Name: Listings
--}}

@extends('layouts.app')

@section('content')
@include('partials.breadcrumbs')

@include('partials.page-hero', [
  'heroBrand' => ($copy['hero_brand'] ?? '') !== '' ? $copy['hero_brand'] : ($identity['brand'] ?? 'Acreline'),
  'heroEyebrow' => $copy['hero_eyebrow'] ?: 'Sample inventory',
  'heroTitle' => $copy['hero_title'] ?: 'Sample homes &amp; land <em>for demo tours</em>',
  'heroText' => $copy['hero_text'] ?: 'Farms, historic houses, and acreage across three sample areas. Filter by type, price, and acres — this is fictional inventory, not a live MLS.',
  'heroActions' => [
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
    ['href' => home_url('/guide'), 'label' => 'Buyer tools', 'class' => 'btn btn-outline light'],
  ],
])


  <section class="section section-alt">
    <div class="wrap">
      <form class="listings-toolbar reveal" id="filterForm" aria-label="Filter sample listings">
        <div class="filters-grid">
          <div class="field">
            <label for="fType">Type</label>
            <select id="fType" name="type">
              <option value="all">All types</option>
              <option value="home">Home</option>
              <option value="farm">Farm</option>
              <option value="land">Land</option>
              <option value="historic">Historic</option>
            </select>
          </div>
          <div class="field">
            <label for="fPrice">Price</label>
            <select id="fPrice" name="price">
              <option value="all">Any price</option>
              <option value="0-250000">Under $250k</option>
              <option value="250000-500000">$250k – $500k</option>
              <option value="500000-750000">$500k – $750k</option>
              <option value="750000-999999999">$750k+</option>
            </select>
          </div>
          <div class="field">
            <label for="fAcreage">Acreage</label>
            <select id="fAcreage" name="acreage">
              <option value="all">Any acreage</option>
              <option value="0-1">Under 1 acre</option>
              <option value="1-10">1 – 10 acres</option>
              <option value="10-30">10 – 30 acres</option>
              <option value="30-999">30+ acres</option>
            </select>
          </div>
          <div class="field">
            <label for="fTownship">Area</label>
            <select id="fTownship" name="township">
              <option value="all">All sample areas</option>
              @forelse ($catalogTownships as $town)
                <option value="{{ $town }}">{{ \App\Support\Catalog::townshipLabel($town) }}</option>
              @empty
                <option value="Cumberland">North Ridge</option>
                <option value="Straban">Mill Creek</option>
                <option value="Franklin">Oak Hollow</option>
              @endforelse
            </select>
          </div>
          <div class="field">
            <label for="fSort">Sort by</label>
            <select id="fSort" name="sort">
              <option value="default">Featured</option>
              <option value="price-asc">Price: Low to High</option>
              <option value="price-desc">Price: High to Low</option>
              <option value="acreage-desc">Acreage: Largest first</option>
            </select>
          </div>
        </div>
        <div class="toolbar-bottom">
          <p class="result-count" aria-live="polite" id="resultCount"><strong>8</strong> properties found</p>
          <div class="toolbar-actions">
            <button type="button" class="reset-btn" id="resetFilters">Reset filters</button>
            <div class="view-toggle" role="group" aria-label="Listing view">
              <button type="button" class="active" id="gridViewBtn" aria-pressed="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Grid
              </button>
              <button type="button" id="mapViewBtn" aria-pressed="false">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 20l-6-3V4l6 3 6-3 6 3v13l-6-3-6 3z"/><line x1="9" y1="7" x2="9" y2="20"/><line x1="15" y1="4" x2="15" y2="17"/></svg>
                Map
              </button>
            </div>
          </div>
        </div>
      </form>

      <div class="listing-grid reveal" id="listingGrid"></div>
      <p class="empty-state" id="emptyState" style="display:none;">No properties match those filters yet. Try widening your search or <button type="button" class="reset-btn" id="emptyResetBtn">reset filters</button>.</p>

      <div class="map-view reveal" id="mapView" aria-label="Map of listings">
        <div class="map-roads"></div>
        <div class="map-road-3"></div>
        <div class="map-field" style="width:140px;height:100px;left:8%;top:12%;background:#8fae5c;"></div>
        <div class="map-field" style="width:180px;height:120px;right:6%;top:8%;background:#7a9e4f;"></div>
        <div class="map-field" style="width:120px;height:90px;left:20%;bottom:10%;background:#9bb768;"></div>
        <div class="map-field" style="width:160px;height:110px;right:14%;bottom:6%;background:#8fae5c;"></div>
        <div id="mapPins"></div>
        <div class="map-legend">
          <span><i class="legend-dot" style="background:#1f6b4a;"></i>Home</span>
          <span><i class="legend-dot" style="background:#5c6f3e;"></i>Farm</span>
          <span><i class="legend-dot" style="background:#d7a340;"></i>Land</span>
          <span><i class="legend-dot" style="background:#4d5a5e;"></i>Historic</span>
        </div>
      </div>
    </div>
  </section>

  <section class="section" aria-labelledby="listing-help-heading">
    <div class="wrap mkt-lead reveal">
      <p class="eyebrow">How to read a card</p>
      <div>
        <h2 id="listing-help-heading">{!! $copy['intro_title'] ?? 'Buying rural property' !!}</h2>
        <p class="lede">{!! $copy['intro_text'] ?? 'Every sample parcel sits in an area — zoning, lot size, and farmland tax rules change from one ridge to the next. Filter first, then book a walk. Replace this inventory with your own market.' !!}</p>
      </div>
    </div>
    <div class="wrap">
      <div class="scan-grid cols-3 reveal">
        <article class="scan-card">
          <span class="num">1</span>
          <h3>Township before photo</h3>
          <p>North Ridge, Mill Creek, and Oak Hollow are concept labels for real township patterns — lot size, orchard ground, and mountain woodlots do not behave the same.</p>
        </article>
        <article class="scan-card">
          <span class="num">2</span>
          <h3>Match the product</h3>
          <p>Homes lead with beds. Land leads with acres and access. Farms mix both. Historic houses are about the building, not the acreage count on the card.</p>
        </article>
        <article class="scan-card">
          <span class="num">3</span>
          <h3>Then walk it</h3>
          <p>Open the listing, then <a href="{{ home_url('/book/') }}">book a showing</a>. New to wells or perc tests? Start with the <a href="{{ home_url('/guide') }}">buyer guide</a> and the <a href="{{ home_url('/areas') }}">area pages</a>.</p>
        </article>
      </div>
    </div>
  </section>

  @include('partials.faq-list', [
    'faqTitle' => 'Before you filter',
    'faqText' => 'Answers stay on the page — no tap-to-open. Township first, then type, then a showing.',
    'faqHeadClass' => 'left',
    'faqSectionClass' => 'section-alt',
    'faqEyebrow' => 'Listing help',
  ])

  <!-- ============================= CTA BAND ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>{!! ($copy['cta_title'] ?? '') ?: 'See a property you like?' !!}</h2>
        <p>{!! ($copy['cta_text'] ?? '') ?: 'Book a walkthrough with a sample agent, or run the numbers first with the land-loan and pre-qualification tools.' !!}</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] ?? 'Book a showing' }}</a>
          <a class="btn btn-outline light" href="{{ home_url('/guide') }}">Financing Tools</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= LISTING DETAIL MODAL ============================= -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" id="modalDialog">
    <button class="modal-close" id="modalCloseBtn" aria-label="Close listing details">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="modal-gallery" id="modalGallery"></div>
    <div class="modal-body">
      <p class="eyebrow" id="modalTag">Type</p>
      <h3 id="modalTitle">Listing title</h3>
      <p class="card-address" id="modalAddress">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span>Address</span>
      </p>
      <div class="modal-price-row">
        <span class="modal-price" id="modalPrice">$0</span>
        <span class="status-tag status-active" id="modalStatus">Active</span>
      </div>
      <div class="modal-specs" id="modalSpecs"></div>
      <p class="modal-desc" id="modalDesc"></p>

      <div class="calc-box">
        <h4><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg> Mortgage / Land Loan Estimate</h4>
        <div class="calc-grid">
          <div class="field">
            <label for="calcPrice">Price ($)</label>
            <input type="number" id="calcPrice" min="0" step="1000">
          </div>
          <div class="field">
            <label for="calcDown">Down payment (%)</label>
            <input type="number" id="calcDown" min="0" max="100" value="20">
          </div>
          <div class="field">
            <label for="calcRate">Rate (%)</label>
            <input type="number" id="calcRate" min="0" step="0.05" value="6.75">
          </div>
          <div class="field">
            <label for="calcTerm">Term (years)</label>
            <select id="calcTerm">
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="30" selected>30</option>
            </select>
          </div>
        </div>
        <div class="calc-result">
          <div>
            <span>Estimated monthly payment (P&amp;I)</span><br>
            <strong id="calcMonthly">$0</strong>
          </div>
          <span>Excludes taxes, insurance &amp; land-loan rate premium</span>
        </div>
      </div>

      <div class="modal-actions">
        <a href="{{ home_url('/book/') }}" class="btn btn-primary" id="modalScheduleBtn">Request Info / Book a Tour</a>
        <button type="button" class="btn btn-outline" id="modalSaveBtn">Save Listing</button>
      </div>
    </div>
  </div>
</div>

<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
