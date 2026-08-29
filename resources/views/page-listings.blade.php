{{--
  Template Name: Listings
--}}

@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Listings</span></li>
  </ol>
</nav>

<!-- ============================= PAGE HERO ============================= -->
<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">{!! $copy['hero_brand'] !!}</p>
    <p class="hero-eyebrow">{{ $copy['hero_eyebrow'] }}</p>
    <h1>{!! $copy['hero_title'] !!}</h1>
    <p>{!! $copy['hero_text'] !!}</p>
  </div>
</section>


  <section class="section section-alt">
    <div class="wrap">
      <form class="listings-toolbar reveal" id="filterForm">
        <div class="filters-grid">
          <div class="field">
            <label for="fType">Type</label>
            <select id="fType">
              <option value="all">All types</option>
              <option value="home">Home</option>
              <option value="farm">Farm</option>
              <option value="land">Land</option>
              <option value="historic">Historic</option>
            </select>
          </div>
          <div class="field">
            <label for="fPrice">Price</label>
            <select id="fPrice">
              <option value="all">Any price</option>
              <option value="0-250000">Under $250k</option>
              <option value="250000-500000">$250k – $500k</option>
              <option value="500000-750000">$500k – $750k</option>
              <option value="750000-999999999">$750k+</option>
            </select>
          </div>
          <div class="field">
            <label for="fAcreage">Acreage</label>
            <select id="fAcreage">
              <option value="all">Any acreage</option>
              <option value="0-1">Under 1 acre</option>
              <option value="1-10">1 – 10 acres</option>
              <option value="10-30">10 – 30 acres</option>
              <option value="30-999">30+ acres</option>
            </select>
          </div>
          <div class="field">
            <label for="fTownship">Township</label>
            <select id="fTownship">
              <option value="all">All townships</option>
              @forelse ($catalogTownships as $town)
                <option value="{{ $town }}">{{ $town }} Twp</option>
              @empty
                <option value="Cumberland">Cumberland Twp</option>
                <option value="Straban">Straban Twp</option>
                <option value="Franklin">Franklin Twp</option>
              @endforelse
            </select>
          </div>
          <div class="field">
            <label for="fSort">Sort by</label>
            <select id="fSort">
              <option value="default">Featured</option>
              <option value="price-asc">Price: Low to High</option>
              <option value="price-desc">Price: High to Low</option>
              <option value="acreage-desc">Acreage: Largest first</option>
            </select>
          </div>
        </div>
        <div class="toolbar-bottom">
          <p class="result-count" aria-live="polite" id="resultCount"><strong>8</strong> properties found</p>
          <div style="display:flex;gap:16px;align-items:center;flex-wrap:wrap;">
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

  <!-- ============================= LOCAL NOTE ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>{!! $copy['intro_title'] !!}</h2>
      <p>{!! $copy['intro_text'] !!}</p>
      <p>Keystone agents pull the township zoning, check well and septic feasibility, and flag easements or floodplain before you write an offer. If you're new to land, start with our <a href="{{ home_url('/guide') }}">Land Buyer's Guide</a> — it explains perc tests, well yields and land loans in plain language — then read up on the specific <a href="{{ home_url('/areas') }}">townships we serve</a>.</p>
    </div>
  </section>

  <!-- ============================= CTA BAND ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>{!! $copy['cta_title'] !!}</h2>
        <p>{!! $copy['cta_text'] !!}</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] }}</a>
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

      <div style="display:flex;gap:12px;margin-top:22px;flex-wrap:wrap;">
        <a href="{{ home_url('/book/') }}" class="btn btn-primary" id="modalScheduleBtn">Request Info / Book a Tour</a>
        <button type="button" class="btn btn-outline" id="modalSaveBtn">Save Listing</button>
      </div>
    </div>
  </div>
</div>

<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
