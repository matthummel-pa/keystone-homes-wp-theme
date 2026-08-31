{{--
  Template Name: Book a showing
--}}

@extends('layouts.app')

@section('content')
@include('partials.breadcrumbs')

@include('partials.page-hero', [
  'heroBrand' => ($copy['hero_brand'] ?? '') !== '' ? $copy['hero_brand'] : ($identity['brand'] ?? 'Acreline'),
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
    <header class="section-head left reveal">
      <p class="eyebrow">{{ $copy['book_eyebrow'] ?? 'Appointments' }}</p>
      <h2 id="book-heading">{!! $copy['book_title'] ?? 'Pick a listing and a time' !!}</h2>
      <p>{!! $copy['book_text'] ?? 'Choose a sample address, a date, and a slot. The request is saved for the listing agent — this demo does not send email.' !!}</p>
    </header>
    <div class="booking-shell reveal">
      @include('partials.booking-form')
      @include('partials.booking-photo')
    </div>
  </div>
</section>

<section class="section" aria-labelledby="showing-help-heading">
  <div class="wrap">
    <header class="section-head left reveal">
      <p class="eyebrow">Before you go</p>
      <h2 id="showing-help-heading">What a rural showing is actually for</h2>
      <p>The photo sells the house. The walk answers water, access, and whether the barn still works. Scan this, then send the request.</p>
    </header>
    <div class="scan-grid cols-3 reveal">
      <article class="scan-card">
        <span class="num">Bring</span>
        <h3>Boots and three questions</h3>
        <ul>
          <li>Where does the well sit, and has it been flow-tested?</li>
          <li>Is there a current perc or a public-sewer hookup?</li>
          <li>Is the driveway recorded, or a handshake lane?</li>
        </ul>
      </article>
      <article class="scan-card">
        <span class="num">House vs land</span>
        <h3>Different walks</h3>
        <ul>
          <li>Houses: rooms, systems, and how you live there weekday nights</li>
          <li>Land: where a house could sit, wet corners, road frontage</li>
          <li>Farms: barn use, tillable split, and who uses the lane</li>
        </ul>
      </article>
      <article class="scan-card">
        <span class="num">After</span>
        <h3>What happens next</h3>
        <ul>
          <li>This demo stores a Booking as Requested</li>
          <li>A live office would confirm the slot</li>
          <li>Read the <a href="{{ home_url('/guide') }}">buyer guide</a> if the parcel has no house</li>
        </ul>
      </article>
    </div>
  </div>
</section>

@include('partials.faq-list', [
  'faqTitle' => 'Showing questions',
  'faqText' => 'What to expect on a farm or acreage walk — plus how this demo form behaves.',
  'faqHeadClass' => 'left',
])
@endsection
