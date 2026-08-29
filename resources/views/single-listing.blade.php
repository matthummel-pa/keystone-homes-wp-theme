@extends('layouts.app')

@section('content')
@php
  $listing = \App\Support\Catalog::listing((int) get_the_ID());
  $agent = $listing && $listing['listing_agent'] ? \App\Support\Catalog::agent((int) $listing['listing_agent']) : null;
@endphp
@if ($listing)
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><a href="{{ home_url('/listings') }}">Listings</a></li>
    <li><span aria-current="page">{{ $listing['title'] }}</span></li>
  </ol>
</nav>

<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">{{ $listing['typeLabel'] }} · {{ $listing['township'] }} Township</p>
    <p class="hero-eyebrow">{{ strtoupper($listing['status']) }}@if ($listing['mls_number']) · MLS {{ $listing['mls_number'] }}@endif</p>
    <h1>{{ $listing['title'] }}</h1>
    <p>{{ $listing['address'] }}</p>
  </div>
</section>

<section class="section">
  <div class="wrap listing-single">
    <div class="listing-single-main">
      <div class="listing-single-photo" style="@if ($listing['image']) background-image:url({{ $listing['image'] }});background-size:cover;background-position:center;@else background:{{ $listing['grad'] }};@endif"></div>
      <p class="modal-price">{{ \App\Support\Catalog::formatMoney((int) $listing['price']) }}</p>
      <div class="modal-specs">
        @if ($listing['type'] !== 'land')
          <div><strong>{{ $listing['beds'] }}</strong><span>Beds</span></div>
          <div><strong>{{ $listing['baths'] }}</strong><span>Baths</span></div>
          <div><strong>{{ number_format((int) $listing['sqft']) }}</strong><span>Sq Ft</span></div>
        @endif
        <div><strong>{{ $listing['acres'] }}</strong><span>Acres</span></div>
        @if ($listing['year_built'])
          <div><strong>{{ $listing['year_built'] }}</strong><span>Year built</span></div>
        @endif
      </div>
      <div class="prose">
        <p>{{ $listing['desc'] }}</p>
      </div>
      <div class="cta-actions" style="margin-top:24px">
        <a class="btn btn-primary" href="{{ home_url('/book/') }}?listing={{ $listing['id'] }}">Book a showing</a>
        <a class="btn btn-outline" href="{{ home_url('/listings') }}">All listings</a>
      </div>
    </div>
    @if ($agent)
      <aside class="listing-agent-card">
        <p class="eyebrow">Listing agent</p>
        <h2><a href="{{ $agent['permalink'] }}">{{ $agent['name'] }}</a></h2>
        <p class="agent-title">{{ $agent['job_title'] }}</p>
        <p>{{ $agent['bio'] }}</p>
        @if ($agent['phone'])
          <a class="agent-phone" href="{{ \App\Support\Catalog::telHref($agent['phone']) }}">{{ $agent['phone'] }}</a>
        @endif
      </aside>
    @endif
  </div>
</section>
@endif
@endsection
