{{--
  Template Name: Agents
--}}

@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
@include('partials.breadcrumbs')

<!-- ============================= PAGE HERO ============================= -->
@include('partials.page-hero', [
  'heroBrand' => ($copy['hero_brand'] ?? '') !== '' ? $copy['hero_brand'] : ($identity['brand'] ?? 'Acreline'),
  'heroEyebrow' => $copy['hero_eyebrow'] ?: 'Sample team',
  'heroTitle' => $copy['hero_title'] ?: 'Agents who know the <em>demo ground</em>',
  'heroText' => $copy['hero_text'] ?: 'A small local team for farms, orchards, and century houses. Profiles are Agent posts. Phones are fictional 555 lines.',
  'heroActions' => [
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
    ['href' => home_url('/contact'), 'label' => 'Contact the office', 'class' => 'btn btn-outline light'],
  ],
])


  <!-- ============================= INTRO ============================= -->
  <section class="section">
    <div class="wrap mkt-lead reveal">
      <p class="eyebrow">The sample team</p>
      <div>
        <h2>{!! $copy['intro_title'] ?? 'A small, local team by design' !!}</h2>
        <p class="lede">{!! $copy['intro_text'] ?? 'Rural property deserves an agent who understands rural property — farms, orchards, raw land and century homesteads.' !!}</p>
      </div>
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
      <div class="mkt-lead reveal">
        <p class="eyebrow">{{ $copy['how_eyebrow'] ?? 'How We Work' }}</p>
        <div>
          <h2>{!! $copy['how_title'] ?? 'What working with this office looks like' !!}</h2>
          <p class="lede">{!! $copy['how_text'] ?? 'No pressure, no jargon, and a straight answer about the ground under your feet.' !!}</p>
        </div>
      </div>
      <div class="topic-grid">
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">01</p>
          <h3>We listen first</h3>
          <p>Acreage, a homestead, orchard ground, a mountain cabin, a place to retire — we start with what you actually want, then match it to the right ridge.</p>
        </article>
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">02</p>
          <h3>We walk the ground</h3>
          <p>Access, well and septic, zoning, and easements get checked before you write — not after an inspection surprises you.</p>
        </article>
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">03</p>
          <h3>We stay honest</h3>
          <p>A wet corner, a rollback risk, or a handshake lane gets said out loud. A good fit matters more than a fast close.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ============================= CTA BAND ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>{!! $copy['cta_title'] ?? 'Talk to a sample agent' !!}</h2>
        <p>{!! $copy['cta_text'] ?? 'Reach the office at (555) 010-0455, or book a no-pressure showing.' !!}</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] ?? 'Book a showing' }}</a>
          <a class="btn btn-outline light" href="{{ home_url('/contact') }}">Contact the Office</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
