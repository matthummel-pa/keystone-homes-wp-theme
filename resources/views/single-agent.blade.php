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

@include('partials.page-hero', [
  'heroBrand' => 'Keystone Real Estate',
  'heroEyebrow' => $agent['job_title'],
  'heroTitle' => $agent['name'],
  'heroText' => trim($agent['office'].($agent['years_experience'] ? ' · '.$agent['years_experience'].' years' : '')),
  'headingId' => 'agent-hero-heading',
  'heroActions' => [
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
    ['href' => home_url('/contact'), 'label' => 'Contact the office', 'class' => 'btn btn-outline light'],
  ],
])

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
      <a class="btn btn-outline" href="{{ home_url('/agents') }}" style="margin-top:10px">All agents</a>
    </aside>
  </div>
</section>

<section class="section section-alt" aria-labelledby="agent-help-heading">
  <div class="wrap">
    <header class="section-head left reveal">
      <p class="eyebrow">How this walk works</p>
      <h2 id="agent-help-heading">What {{ $agent['name'] }} is for</h2>
      <p>Rural Adams County showings are not a 20-minute condo tour. Scan this, then book a sample slot or call the concept line.</p>
    </header>
    <div class="scan-grid cols-3 reveal">
      <article class="scan-card">
        <span class="num">Specialty</span>
        <h3>{{ $agent['specialties'] ?: 'Farms, houses, and land' }}</h3>
        <ul>
          <li>{{ $agent['service_areas'] ?: 'Adams County townships and nearby boroughs' }}</li>
          <li>Boots, well questions, and a recorded lane</li>
          <li>Honest notes on wet corners and rollback risk</li>
        </ul>
      </article>
      <article class="scan-card">
        <span class="num">On the walk</span>
        <h3>What gets checked</h3>
        <ul>
          <li>Access, well, and septic feasibility</li>
          <li>Zoning and easements before an offer</li>
          <li>Barn, shop, or historic systems if they apply</li>
        </ul>
      </article>
      <article class="scan-card">
        <span class="num">Next</span>
        <h3>Stay moving</h3>
        <ul>
          <li><a href="{{ home_url('/book/') }}">Book a showing</a> with a sample address</li>
          <li>Read the <a href="{{ home_url('/guide') }}">buyer guide</a> for perc and Act 319</li>
          <li>Browse <a href="{{ home_url('/listings') }}">listings</a> assigned below</li>
        </ul>
      </article>
    </div>
  </div>
</section>

@include('partials.faq-list', [
  'faqTitle' => 'Agent questions',
  'faqText' => 'How to reach this sample profile — and what is fictional.',
  'faqHeadClass' => 'left',
  'faqSectionClass' => '',
])

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
