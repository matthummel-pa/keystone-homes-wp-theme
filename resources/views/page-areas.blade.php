{{--
  Template Name: Areas
--}}

@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
@include('partials.breadcrumbs')

@include('partials.page-hero', [
  'heroBrand' => $copy['hero_brand'] ?: 'Keystone Real Estate',
  'heroEyebrow' => $copy['hero_eyebrow'] ?: 'Sample markets',
  'heroTitle' => $copy['hero_title'] ?: 'Areas we <em>demo</em>',
  'heroText' => $copy['hero_text'] ?: 'Township-by-township reads of rural Adams County — orchards, farms, and wooded lots from Franklin to Liberty. Fictional profiles for a scannable area page.',
  'heroActions' => [
    ['href' => home_url('/listings'), 'label' => 'Browse listings', 'class' => 'btn btn-primary'],
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-outline light'],
  ],
])


  <!-- ============================= INTRO PROSE ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>{!! $copy['intro_title'] ?? 'Land, farms &amp; homesteads across Adams County' !!}</h2>
      <p>{!! $copy['intro_text'] ?? 'Our office sits at 100 Concept Way on the north edge of Gettysburg. The townships below are where we spend most of our boot leather.' !!}</p>
    </div>
  </section>

  <!-- ============================= TOWNSHIP CARDS ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">{{ $copy['grid_eyebrow'] ?? 'Township by Township' }}</p>
        <h2>{!! $copy['grid_title'] ?? 'Where we work' !!}</h2>
        <p>{!! $copy['grid_text'] ?? 'A quick, honest read on six rural townships — what the ground is like and what a buyer should watch for.' !!}</p>
      </div>

      <div class="area-grid">
        @foreach ($areaCards as $area)
          <div class="area-card reveal">
            <p class="area-meta">{!! $area['meta'] !!}</p>
            <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>{!! $area['title'] !!}</h3>
            <p>{!! $area['body'] !!}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ============================= NEARBY MARKETS ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">Nearby Land Markets</p>
        <h2>Towns &amp; markets just beyond the townships</h2>
        <p>We also list and sell property in the boroughs and market towns that ring rural Adams County — each an easy drive from our Gettysburg office.</p>
      </div>
      <div class="nearby-grid reveal">
        <div class="nearby-card">
          <h4>Biglerville</h4>
          <p>The capital of the fruit belt, 9 miles north on US-15/PA-34. Orchard farms, packing houses and in-town homes near the National Apple Museum.</p>
        </div>
        <div class="nearby-card">
          <h4>Cashtown</h4>
          <p>Historic crossroads west on US-30 at the foot of the mountain. Country homes, small acreage and the landmark Cashtown Inn nearby.</p>
        </div>
        <div class="nearby-card">
          <h4>Fairfield</h4>
          <p>A walkable mountain borough 8 miles southwest on PA-116. Gateway to Carroll Valley, ski country and wooded recreational land.</p>
        </div>
        <div class="nearby-card">
          <h4>New Oxford</h4>
          <p>Antiques town 8 miles east on US-30. Farmland and family homes with quick access toward Hanover and York.</p>
        </div>
        <div class="nearby-card">
          <h4>Littlestown</h4>
          <p>Southeast on PA-97 toward the Maryland line. Open farm ground, newer subdivisions and value per acre for commuting buyers.</p>
        </div>
        <div class="nearby-card">
          <h4>McSherrystown &amp; Hanover</h4>
          <p>The county's busier eastern edge. Denser boroughs with nearby farmland — handy for buyers who want acreage close to services and employers.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= GETTYSBURG ANCHOR ============================= -->
  <section class="section section-alt">
    <div class="wrap prose reveal">
      <h2>Getting here &amp; getting around</h2>
      <p>Gettysburg is the hub of it all. Our office at 100 Concept Way is about a mile north of Lincoln Square — from US-15, take the Gettysburg exits and head toward town; from US-30, you're minutes away whether you're coming from Chambersburg to the west or York to the east. Downtown parking is easiest in the lots off Race Horse Alley and along Stratton Street, and most of the historic district around Steinwehr Avenue, Baltimore Street and the David Wills House is walkable once you're in.</p>
      <p>Even buyers hunting pure farmland like to know what's close, so here's the short list: the Gettysburg National Military Park and its landmarks — Seminary Ridge, Little Round Top, the Eternal Light Peace Memorial — sit right at the edge of town; Sachs Covered Bridge spans Marsh Creek down toward Liberty Township; and the orchards, wineries and farm stands of the fruit belt spread north toward Biglerville. When we show you a parcel, we'll tell you honestly how far it really is from a grocery store, a school and a hospital — not just how pretty the view is.</p>
      <p>Ready to narrow it down? Browse our <a href="{{ home_url('/listings') }}">current listings</a>, read the <a href="{{ home_url('/guide') }}">Land Buyer's Guide</a>, or <a href="{{ home_url('/contact') }}">reach out to the office</a> and we'll point you toward the townships that fit what you're after.</p>
    </div>
  </section>

  <!-- ============================= CTA BAND ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>{!! $copy['cta_title'] ?? 'Walk a township with us' !!}</h2>
        <p>{!! $copy['cta_text'] ?? 'Tell us which corner you want to understand, and we\'ll match you with the agent who knows that ground.' !!}</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] ?? 'Book a showing' }}</a>
          <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse Listings</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
