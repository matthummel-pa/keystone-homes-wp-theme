@extends('layouts.app')

@section('content')
@php
  $listing = \App\Support\Catalog::listing((int) get_the_ID());
  $agent = $listing && $listing['listing_agent'] ? \App\Support\Catalog::agent((int) $listing['listing_agent']) : null;
@endphp
@if ($listing)
  @php
    $listingSchema = [
      '@context' => 'https://schema.org',
      '@type' => $listing['type'] === 'land' ? 'Place' : 'SingleFamilyResidence',
      'name' => html_entity_decode($listing['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
      'description' => html_entity_decode($listing['desc'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
      'url' => $listing['permalink'],
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $listing['address'],
        'addressLocality' => $listing['city'],
        'addressRegion' => $listing['state'] ?: 'PA',
        'postalCode' => $listing['zip'],
        'addressCountry' => 'US',
      ],
      'offers' => [
        '@type' => 'Offer',
        'price' => (int) $listing['price'],
        'priceCurrency' => 'USD',
        'availability' => $listing['status'] === 'sold'
          ? 'https://schema.org/SoldOut'
          : 'https://schema.org/InStock',
      ],
    ];
    if ($listing['image']) {
      $listingSchema['image'] = $listing['image'];
    }
    if ($listing['type'] !== 'land' && $listing['beds']) {
      $listingSchema['numberOfRooms'] = (float) $listing['beds'];
    }
  @endphp
  <script type="application/ld+json">
    {!! json_encode($listingSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><a href="{{ home_url('/listings') }}">Listings</a></li>
    <li><span aria-current="page">{{ $listing['title'] }}</span></li>
  </ol>
</nav>

@include('partials.page-hero', [
  'heroBrand' => $listing['typeLabel'].' · '.$listing['township'].' Township',
  'heroEyebrow' => strtoupper($listing['status']).($listing['mls_number'] ? ' · MLS '.$listing['mls_number'] : ''),
  'heroTitle' => $listing['title'],
  'heroText' => $listing['address'] ?: $listing['desc'],
  'headingId' => 'listing-hero-heading',
  'heroActions' => [
    ['href' => home_url('/book/').'?listing_id='.$listing['id'], 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
    ['href' => home_url('/listings'), 'label' => 'All listings', 'class' => 'btn btn-outline light'],
  ],
])

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
      @if ($listing['property_tax'] || $listing['hoa'] || $listing['virtual_tour'])
        <dl class="agent-facts">
          @if ($listing['property_tax'])
            <div><dt>Property tax</dt><dd>{{ $listing['property_tax'] }}</dd></div>
          @endif
          @if ($listing['hoa'])
            <div><dt>HOA</dt><dd>{{ $listing['hoa'] }}</dd></div>
          @endif
          @if ($listing['virtual_tour'])
            <div><dt>Virtual tour</dt><dd><a href="{{ $listing['virtual_tour'] }}">Open tour</a></dd></div>
          @endif
        </dl>
      @endif
      <div class="cta-actions" style="margin-top:24px">
        <a class="btn btn-primary" href="{{ home_url('/book/') }}?listing_id={{ $listing['id'] }}">Book a showing</a>
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

@php
  $kind = $listing['type'];
@endphp
<section class="section section-alt" aria-labelledby="listing-walk-heading">
  <div class="wrap">
    <header class="section-head left reveal">
      <p class="eyebrow">Before you book</p>
      <h2 id="listing-walk-heading">What to check on this walk</h2>
      <p>
        @if ($kind === 'land')
          Acreage is the product. Water, perc, and a recorded lane matter more than a pretty drone still.
        @elseif ($kind === 'farm')
          Walk the working pieces — barn, tillable split, and who uses the lane — not just the farmhouse kitchen.
        @else
          Lead with rooms and systems, then well-or-public-water and how you reach the lane in January.
        @endif
      </p>
    </header>
    <div class="scan-grid cols-3 reveal">
      <article class="scan-card">
        <span class="num">{{ $listing['typeLabel'] }}</span>
        <h3>
          @if ($kind === 'land')
            Scan the ground
          @elseif ($kind === 'farm')
            Walk the working pieces
          @else
            Scan the house
          @endif
        </h3>
        <ul>
          @if ($kind === 'land')
            <li>Usable acres, not just deed acres</li>
            <li>Perc / septic status or a contingency</li>
            <li>Road frontage and a recorded driveway</li>
          @elseif ($kind === 'farm')
            <li>Barn, shop, and outbuilding use</li>
            <li>Tillable vs wooded split</li>
            <li>Well, septic, and who holds the lane</li>
          @else
            <li>Beds, baths, and how you live weeknights</li>
            <li>Well vs public water</li>
            <li>Township commute and winter access</li>
          @endif
        </ul>
      </article>
      <article class="scan-card">
        <span class="num">Township</span>
        <h3>{{ $listing['township'] ? $listing['township'].' Township' : 'Adams County' }}</h3>
        <ul>
          <li>Zoning and lot-size rules sit here</li>
          <li>Clean and Green can change the tax bill</li>
          <li>Read the <a href="{{ home_url('/areas') }}">area pages</a> before you fall for the photo</li>
        </ul>
      </article>
      <article class="scan-card">
        <span class="num">Next</span>
        <h3>Stay moving</h3>
        <ul>
          <li><a href="{{ home_url('/book/') }}?listing_id={{ $listing['id'] }}">Book a showing</a> with this address selected</li>
          <li>New to wells or perc? Open the <a href="{{ home_url('/guide') }}">buyer guide</a></li>
          <li>Sample inventory — not a live MLS card</li>
        </ul>
      </article>
    </div>
  </div>
</section>

@include('partials.faq-list', [
  'faqTitle' => 'Listing questions',
  'faqText' => 'How to walk this sample card — then book a fictional showing.',
  'faqHeadClass' => 'left',
  'faqSectionClass' => '',
])
@endif
@endsection
