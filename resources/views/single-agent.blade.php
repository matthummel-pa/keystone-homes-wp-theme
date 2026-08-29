@extends('layouts.app')

@section('content')
@php
  $agent = \App\Support\Catalog::agent((int) get_the_ID());
  $listings = $agent ? \App\Support\Catalog::listingsForAgent($agent['id']) : [];
@endphp
@if ($agent)
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><a href="{{ home_url('/agents') }}">Agents</a></li>
    <li><span aria-current="page">{{ $agent['name'] }}</span></li>
  </ol>
</nav>

<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">Keystone Homes &amp; Land</p>
    <p class="hero-eyebrow">{{ $agent['job_title'] }}</p>
    <h1>{{ $agent['name'] }}</h1>
    <p>{{ $agent['office'] }}@if ($agent['years_experience']) · {{ $agent['years_experience'] }} years@endif</p>
  </div>
</section>

<section class="section">
  <div class="wrap listing-single">
    <div class="listing-single-main prose">
      <p>{{ $agent['bio'] }}</p>
      <dl class="agent-facts">
        @if ($agent['license_number'])
          <div><dt>License</dt><dd>{{ $agent['license_state'] }} {{ $agent['license_number'] }}</dd></div>
        @endif
        @if ($agent['mls_id'])
          <div><dt>MLS ID</dt><dd>{{ $agent['mls_id'] }}</dd></div>
        @endif
        @if ($agent['nrds_id'])
          <div><dt>NRDS</dt><dd>{{ $agent['nrds_id'] }}</dd></div>
        @endif
        @if ($agent['specialties'])
          <div><dt>Specialties</dt><dd>{{ $agent['specialties'] }}</dd></div>
        @endif
        @if ($agent['service_areas'])
          <div><dt>Service areas</dt><dd>{{ $agent['service_areas'] }}</dd></div>
        @endif
        @if ($agent['languages'])
          <div><dt>Languages</dt><dd>{{ $agent['languages'] }}</dd></div>
        @endif
        @if ($agent['designations'])
          <div><dt>Designations</dt><dd>{{ $agent['designations'] }}</dd></div>
        @endif
      </dl>
    </div>
    <aside class="listing-agent-card">
      <p class="eyebrow">Contact</p>
      @if ($agent['phone'])
        <a class="agent-phone" href="{{ \App\Support\Catalog::telHref($agent['phone']) }}">{{ $agent['phone'] }}</a>
      @endif
      @if ($agent['email'])
        <a class="agent-phone" href="mailto:{{ $agent['email'] }}">{{ $agent['email'] }}</a>
      @endif
      <a class="btn btn-primary" href="{{ home_url('/book/') }}" style="margin-top:16px">Book a showing</a>
    </aside>
  </div>
</section>

@if ($listings)
<section class="section section-alt">
  <div class="wrap">
    <h2>Listings with {{ $agent['name'] }}</h2>
    <div class="listing-mini-grid reveal" style="margin-top:24px">
      @foreach ($listings as $listing)
        <a class="listing-mini" href="{{ $listing['permalink'] }}">
          @if ($listing['image'])
            <img src="{{ $listing['image'] }}" width="800" height="500" alt="" loading="lazy">
          @else
            <div class="listing-mini-photo" style="background:{{ $listing['grad'] }};height:150px"></div>
          @endif
          <div>
            <strong>{{ \App\Support\Catalog::formatMoney((int) $listing['price']) }}</strong>
            <span>{{ $listing['title'] }}</span>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endif
@endsection
