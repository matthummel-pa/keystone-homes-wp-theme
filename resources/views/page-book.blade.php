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

@include('partials.page-hero', [
  'heroBrand' => $copy['hero_brand'] ?: 'Keystone Homes &amp; Land',
  'heroEyebrow' => $copy['hero_eyebrow'] ?: 'Appointments',
  'heroTitle' => $copy['hero_title'] ?: 'Book a house showing',
  'heroText' => $copy['hero_text'] ?: 'Pick a sample listing, a date, and a time. We save the request for the listing agent — this demo does not send email.',
  'heroActions' => [
    ['href' => '#book-showing', 'label' => 'Choose a time', 'class' => 'btn btn-primary'],
    ['href' => home_url('/listings'), 'label' => 'Browse listings', 'class' => 'btn btn-outline light'],
  ],
])

<section class="section section-alt" id="book-showing" aria-labelledby="book-heading">
  <div class="wrap">
    <div class="booking-shell reveal">
      @include('partials.booking-form')
      @include('partials.booking-photo')
    </div>
  </div>
</section>
@endsection
