{{--
  Template Name: Agents
--}}

@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Our Agents</span></li>
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


  <!-- ============================= INTRO ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>{!! $copy['intro_title'] !!}</h2>
      <p>{!! $copy['intro_text'] !!}</p>
    </div>

    <div class="wrap">
      <div class="agent-grid">
        @forelse ($catalogAgents as $agent)
          <article class="agent-card reveal">
            @if ($agent['photo'])
              <img class="agent-avatar" src="{{ $agent['photo'] }}" alt="{{ $agent['name'] }}" width="76" height="76">
            @else
              <div class="agent-avatar" style="background:{{ $agent['avatar_color'] }};">{{ $agent['initials'] }}</div>
            @endif
            <h4><a href="{{ $agent['permalink'] }}">{{ $agent['name'] }}</a></h4>
            <p class="agent-title">{{ $agent['job_title'] }}</p>
            <p>{{ $agent['bio'] }}</p>
            @if ($agent['specialties'])
              <p class="agent-specs">{{ $agent['specialties'] }}</p>
            @endif
            @if ($agent['phone'])
              <a class="agent-phone" href="{{ \App\Support\Catalog::telHref($agent['phone']) }}">{{ $agent['phone'] }}</a>
            @endif
            @if ($agent['email'])
              <a class="agent-phone" href="mailto:{{ $agent['email'] }}">{{ $agent['email'] }}</a>
            @endif
            @if ($agent['license_number'])
              <p class="agent-license">License {{ $agent['license_state'] }} {{ $agent['license_number'] }}</p>
            @endif
          </article>
        @empty
          <p class="empty-state">Add agents in WP Admin → Agents.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ============================= HOW WE WORK ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">{{ $copy['how_eyebrow'] }}</p>
        <h2>{!! $copy['how_title'] !!}</h2>
        <p>{!! $copy['how_text'] !!}</p>
      </div>
      <div class="why-list reveal" style="max-width:820px;">
        <div class="why-item">
          <span class="icn"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
          <div><h4>We listen first</h4><p>Acreage, a homestead, orchard ground, a mountain cabin, a place to retire — we start by understanding what you actually want, then match it to the right township.</p></div>
        </div>
        <div class="why-item">
          <span class="icn"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4l7 7M4 4h5M4 4v5"/><path d="M20 20l-7-7M20 20h-5M20 20v-5"/></svg></span>
          <div><h4>We walk the ground</h4><p>We check access, well and septic feasibility, zoning and easements before you write an offer — not after inspection surprises you.</p></div>
        </div>
        <div class="why-item">
          <span class="icn"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg></span>
          <div><h4>We stay honest</h4><p>If a parcel has a wet corner, a rollback risk or a shaky right-of-way, we'll tell you. A good fit matters more to us than a fast close.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= CTA BAND ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>{!! $copy['cta_title'] !!}</h2>
        <p>{!! $copy['cta_text'] !!}</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] }}</a>
          <a class="btn btn-outline light" href="{{ home_url('/contact') }}">Contact the Office</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
