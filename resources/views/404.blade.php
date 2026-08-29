@extends('layouts.app')

@section('content')
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <ol>
      <li><a href="{{ home_url('/') }}">Home</a></li>
      <li><span aria-current="page">Page not found</span></li>
    </ol>
  </nav>

  <section class="page-hero">
    <div class="page-hero-inner">
      <p class="hero-brand">Keystone Homes &amp; Land</p>
      <p class="hero-eyebrow">404</p>
      <h1>That page isn’t here.</h1>
      <p>The link may be old, or this demo page hasn’t been created yet. Use the paths below — they match the concept site.</p>
    </div>
  </section>

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
