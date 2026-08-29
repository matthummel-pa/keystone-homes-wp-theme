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
    <p class="hero-brand">Keystone Homes &amp; Land</p>
    <p class="hero-eyebrow">Sample team</p>
    <h1>Agents who know the <em>demo ground</em></h1>
    <p>Placeholder profiles for layout. Contact numbers are fictional 555 lines.</p>
  </div>
</section>


  <!-- ============================= INTRO ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>A small, local team by design</h2>
      <p>Keystone Homes &amp; Land was founded in Sample Borough in 2009 around a simple idea: rural property deserves an agent who understands rural property. Farms, orchards, raw land and century homesteads all come with questions a typical residential agent rarely faces — perc tests, well yields, ag easements, clean-and-green rollback, floodplain, mineral rights. Our team lives with those questions every day, across Franklin, Menallen, Butler, Tyrone, Hamiltonban and Liberty Townships and the boroughs around them.</p>
    </div>

    <div class="wrap">
      <div class="agent-grid">
        <div class="agent-card reveal">
          <div class="agent-avatar" style="background:var(--accent);">DK</div>
          <h4>Dale Kuhn</h4>
          <p class="agent-title">Broker / Farm &amp; Land Specialist</p>
          <p>28 years walking Sample County fence lines. If it has acreage, Dale has probably sold a piece of it — from Tyrone Township grain farms to Menallen orchards. He handles perc, easements and clean-and-green day in, day out.</p>
          <a class="agent-phone" href="tel:+15550100461">(555) 010-0461</a>
        </div>
        <div class="agent-card reveal">
          <div class="agent-avatar" style="background:var(--ink);">RM</div>
          <h4>Renee Musselman</h4>
          <p class="agent-title">Historic &amp; Residential Agent</p>
          <p>Specializes in century farmhouses and in-town historic homes near the battlefield district. Renee knows stone foundations, log cores and the honest cost of restoring a Franklin Township homestead.</p>
          <a class="agent-phone" href="tel:+15550100468">(555) 010-0468</a>
        </div>
        <div class="agent-card reveal">
          <div class="agent-avatar" style="background:var(--success);">TB</div>
          <h4>Trey Bushey</h4>
          <p class="agent-title">Land &amp; New-Buyer Agent</p>
          <p>Grew up on a Straban Township dairy farm — now helps first-time land buyers ask the right questions about wells, septic and access before they fall in love with a view.</p>
          <a class="agent-phone" href="tel:+15550100473">(555) 010-0473</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= HOW WE WORK ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">How We Work</p>
        <h2>What working with Keystone looks like</h2>
        <p>No pressure, no jargon, and a straight answer about the ground under your feet.</p>
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
        <h2>Talk to a Keystone agent</h2>
        <p>Reach the office at (555) 010-0455, or book a no-pressure call and we'll match you with the agent who knows your corner of Sample County best.</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/#book-showing') }}">Book a showing</a>
          <a class="btn btn-outline light" href="{{ home_url('/contact') }}">Contact the Office</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
