{{--
  Template Name: Book a showing
--}}

@extends('layouts.app')

@section('content')
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Book a showing</span></li>
  </ol>
</nav>

<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">{!! $copy['hero_brand'] ?: 'Keystone Homes &amp; Land' !!}</p>
    <p class="hero-eyebrow">{{ $copy['hero_eyebrow'] ?: 'Appointments' }}</p>
    <h1>{!! $copy['hero_title'] ?: 'Book a house showing' !!}</h1>
    <p>{!! $copy['hero_text'] ?: 'Pick a listing, date and time. The request is saved as a Booking in Requested status — nothing is emailed.' !!}</p>
  </div>
</section>

<section class="section section-alt" id="book-showing" aria-labelledby="book-heading">
  <div class="wrap">
    <div class="booking-shell reveal">
      @include('partials.booking-form')
      <aside class="booking-summary" aria-label="What happens next">
        <strong>Saved as a Booking</strong>
        <p style="margin:0 0 12px">Each request creates a Bookings post in Requested status. Staff can advance it to Confirmed, then Completed.</p>
        <ul class="scan-card" style="box-shadow:none;border:0;padding:0;background:transparent">
          <li>Property comes from the Listings post type</li>
          <li>Date and time slot are required</li>
          <li>Assigned to the listing agent when set</li>
          <li>Advance status from WP Admin → Bookings</li>
        </ul>
      </aside>
    </div>
  </div>
</section>
@endsection
