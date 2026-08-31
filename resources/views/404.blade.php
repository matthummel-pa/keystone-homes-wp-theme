@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')

  @include('partials.page-hero', [
    'heroBrand' => 'Keystone Real Estate',
    'heroEyebrow' => '404',
    'heroTitle' => 'That page isn’t here.',
    'heroText' => 'The link may be old, or this demo page hasn’t been created yet. Use the paths below — they match the concept site.',
    'headingId' => 'error-hero-heading',
    'heroActions' => [
      ['href' => home_url('/'), 'label' => 'Back home', 'class' => 'btn btn-primary'],
      ['href' => home_url('/listings'), 'label' => 'Browse listings', 'class' => 'btn btn-outline light'],
    ],
  ])

  <section class="section">
    <div class="wrap">
      <div class="intent-grid">
        <a class="intent-card" href="{{ home_url('/') }}">
          <strong>Home</strong>
          <span>Search samples, price a demo home, or book a showing.</span>
          <em>Go to homepage →</em>
        </a>
        <a class="intent-card" href="{{ home_url('/listings') }}">
          <strong>Listings</strong>
          <span>Eight fictional homes, farms, and land parcels.</span>
          <em>Browse inventory →</em>
        </a>
        <a class="intent-card" href="{{ home_url('/book/') }}">
          <strong>Book</strong>
          <span>Pick a sample address, date, and time slot.</span>
          <em>Request a showing →</em>
        </a>
      </div>
    </div>
  </section>
@endsection
