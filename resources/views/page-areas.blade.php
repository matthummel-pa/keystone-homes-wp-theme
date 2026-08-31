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
  'heroText' => $copy['hero_text'] ?: 'Fictional North Ridge, Mill Creek, and Oak Hollow profiles — written so you can swap in your own counties.',
  'heroActions' => [
    ['href' => home_url('/listings'), 'label' => 'Browse listings', 'class' => 'btn btn-primary'],
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-outline light'],
  ],
])


  <!-- ============================= INTRO PROSE ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>{!! $copy['intro_title'] ?? 'Land, farms &amp; homesteads in a sample market' !!}</h2>
      <p>{!! $copy['intro_text'] ?? 'The office sits at 100 Concept Way in Sample Borough. Ridges hold orchards, valley floors hold tillable ground, and the six area cards below show how a land office talks about its territory. Replace the names with yours.' !!}</p>
    </div>
  </section>

  <!-- ============================= TOWNSHIP CARDS ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">{{ $copy['grid_eyebrow'] ?? 'Area by area' }}</p>
        <h2>{!! $copy['grid_title'] ?? 'Where the sample office works' !!}</h2>
        <p>{!! $copy['grid_text'] ?? 'A quick read on six rural area types — what the ground is like, what tends to list, and what a buyer should watch for.' !!}</p>
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
        <h2>Towns &amp; markets just beyond the sample areas</h2>
        <p>We also list and sell property in the boroughs and market towns that ring the sample county — each an easy drive from the Concept Way office. Rename these for your market.</p>
      </div>
      <div class="nearby-grid reveal">
        <div class="nearby-card">
          <h4>North Ridge</h4>
          <p>The fruit-belt hub north of the square. Orchard farms, packing houses, and in-town homes a short drive from the ridgeline listings.</p>
        </div>
        <div class="nearby-card">
          <h4>West Hollow</h4>
          <p>Historic crossroads west on the old pike at the foot of the mountain. Country homes, small acreage, and a quieter commute than the north end.</p>
        </div>
        <div class="nearby-card">
          <h4>South Fork</h4>
          <p>A walkable mountain borough southwest of the seat. Gateway to timber, ski country, and wooded recreational land.</p>
        </div>
        <div class="nearby-card">
          <h4>East Creek</h4>
          <p>Market town east toward the highway. Farmland and family homes with a quicker weekday drive to jobs and grocery stores.</p>
        </div>
        <div class="nearby-card">
          <h4>Mill Crossing</h4>
          <p>Southeast toward the next county line. Open farm ground, newer subdivisions, and value per acre for commuting buyers.</p>
        </div>
        <div class="nearby-card">
          <h4>Orchard Ridge</h4>
          <p>The county's busier eastern edge. Denser boroughs with nearby farmland — handy for buyers who want acreage close to services and employers.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= GETTYSBURG ANCHOR ============================= -->
  <section class="section section-alt">
    <div class="wrap prose reveal">
      <h2>Getting here &amp; getting around</h2>
      <p>The county seat is the hub. The sample office at 100 Concept Way sits about a mile north of the square — from the highway, take the town exits and head toward the courthouse. Downtown parking is easiest in the lots off the alley behind Main, and most of the older district is walkable once you are in. Swap these directions for your own market in the page fields.</p>
      <p>Even buyers hunting pure farmland like to know what's close, so here's the short list: a historic district and Saturday market sit at the edge of town; a covered bridge spans the creek toward Border Farms; and the orchards, wineries, and farm stands of the fruit belt spread north toward North Ridge. When we show you a parcel, we'll tell you honestly how far it really is from a grocery store, a school, and a hospital — not just how pretty the view is.</p>
      <p>Ready to narrow it down? Browse our <a href="{{ home_url('/listings') }}">current listings</a>, read the <a href="{{ home_url('/guide') }}">Land Buyer's Guide</a>, or <a href="{{ home_url('/contact') }}">reach out to the office</a> and we'll point you toward the areas that fit what you're after.</p>
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
