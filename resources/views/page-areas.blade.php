@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Areas We Serve</span></li>
  </ol>
</nav>

<!-- ============================= PAGE HERO ============================= -->
<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">Keystone Homes &amp; Land</p>
    <p class="hero-eyebrow">Sample markets</p>
    <h1>Areas we <em>demo</em></h1>
    <p>Fictional North Ridge, Mill Creek and Oak Hollow profiles — written for scannable area-page SEO patterns.</p>
  </div>
</section>


  <!-- ============================= INTRO PROSE ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>Land, farms &amp; homesteads across Adams County</h2>
      <p>Our office sits at 100 Concept Way on the north edge of Gettysburg, a few minutes from Lincoln Square and the Gettysburg National Military Park. From that spot you can be standing on tillable ground in almost any direction within twenty minutes — US-15 runs north toward the orchards, US-30 (the Lincoln Highway) runs west toward the mountains and east toward New Oxford, and PA-116 carries you down to Fairfield and the Maryland line. Most of the property we sell isn't in town at all; it's the acreage, farms and country homesteads that ring Gettysburg on those roads.</p>
      <p>Rural Adams County is fruit-belt country. The ridges north and west of town hold some of the most productive apple and peach orchards in the eastern United States, and the valley floors are strong Class II and III farmland. That agricultural character shapes everything a land buyer cares about: which parcels are enrolled in clean-and-green (Act 319) tax deferment, where agricultural-security areas limit nuisance complaints, how easements and rights-of-way run, and whether a lot will perc for a conventional septic system. We serve the whole county, but the six townships below are where we spend most of our boot leather.</p>
    </div>
  </section>

  <!-- ============================= TOWNSHIP CARDS ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">Township by Township</p>
        <h2>Where we work</h2>
        <p>A quick, honest read on six rural Adams County townships — what the ground is like, what tends to come up for sale, and what a buyer should watch for.</p>
      </div>

      <div class="area-grid">
        <div class="area-card reveal">
          <p class="area-meta">Northwest of Gettysburg · off US-30 &amp; Herr's Ridge Rd</p>
          <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>Franklin Township</h3>
          <p>Franklin Township runs from Herr's Ridge out toward Cashtown and the base of South Mountain, and it's some of our favorite ground to sell. You'll find century stone homesteads, working orchards along the York Road corridor, and wooded building lots with long views toward the mountain. It's about 10 minutes northwest of downtown Gettysburg on US-30.</p>
          <p>Watch for: steep, wooded parcels that need careful perc siting, and orchard land that may be enrolled in Act 319 clean-and-green — a wonderful tax break, but one with rollback consequences if you change the use.</p>
        </div>

        <div class="area-card reveal">
          <p class="area-meta">North of Gettysburg · Biglerville &amp; the fruit belt · US-15 / PA-34</p>
          <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>Menallen Township</h3>
          <p>Menallen wraps around Biglerville and is the heart of Adams County's apple country — home to packing houses, the fruit research station, and mile after mile of orchard. Land here trades on tree health, irrigation and frost drainage as much as acreage. It's a 15-minute drive north of Gettysburg up US-15 or PA-34.</p>
          <p>Watch for: existing orchard leases and spray-easement histories, plus older farmsteads where the house and the productive ground may be worth splitting or preserving separately.</p>
        </div>

        <div class="area-card reveal">
          <p class="area-meta">Northeast · around Biglerville &amp; Table Rock · PA-34</p>
          <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>Butler Township</h3>
          <p>Butler Township, north and east toward Table Rock and Bendersville, mixes orchard ground with open rolling farmland and quiet residential lots. It tends to offer a little more value per acre than the townships hugging the battlefield, which makes it popular with buyers who want a homestead or a few acres of pasture without a Gettysburg-address premium.</p>
          <p>Watch for: shared farm lanes and undefined rights-of-way on older parcels — we always confirm legal access in writing before closing.</p>
        </div>

        <div class="area-card reveal">
          <p class="area-meta">North-central · Idaville &amp; Bendersville · PA-234</p>
          <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>Tyrone Township</h3>
          <p>Tyrone Township, up around Idaville and Bendersville on PA-234, is working-farm country: larger tracts of tillable and orchard ground, grain operations, and the occasional dairy. Buyers here are usually after real acreage — 20, 40, 60 acres — rather than a single homesite, and financing often runs through a farm-credit lender rather than a conventional mortgage.</p>
          <p>Watch for: soil-class and drainage differences across a single tract, and whether tillable ground carries an existing crop lease you'll inherit at closing.</p>
        </div>

        <div class="area-card reveal">
          <p class="area-meta">West · South Mountain, Fairfield &amp; Cashtown · PA-116</p>
          <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>Hamiltonban Township</h3>
          <p>Hamiltonban is the county's mountain township — Fairfield, Carroll Valley and the wooded slopes of South Mountain toward the Michaux State Forest and the Appalachian Trail. It's the place for cabins, wooded acreage, hunting ground and recreational parcels, about 20 minutes southwest of Gettysburg on PA-116. The scenery is the draw and the terrain is the challenge.</p>
          <p>Watch for: slope and access on mountain lots, well-yield questions in rocky ground, and seasonal roads — all things we check before you commit.</p>
        </div>

        <div class="area-card reveal">
          <p class="area-meta">Southwest · Fairfield &amp; the Maryland line · PA-116 / Bullfrog Rd</p>
          <h3><span class="pin"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>Liberty Township</h3>
          <p>Liberty Township sits in the county's southwest corner, running down to the Mason-Dixon line below Fairfield. It's a rural mix of small farms, pasture and wooded homesteads, popular with buyers who want land within an easy commute of both Gettysburg and Frederick, Maryland. Sachs Covered Bridge and the quiet back roads along Marsh Creek are just up the way.</p>
          <p>Watch for: floodplain along the creeks and cross-border considerations for buyers relocating from Maryland — we'll walk you through both.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= NEARBY MARKETS ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="section-head left reveal">
        <p class="eyebrow">Nearby Land Markets</p>
        <h2>Towns &amp; markets just beyond the townships</h2>
        <p>We also list and sell property in the boroughs and market towns that ring rural Adams County — each an easy drive from our Gettysburg office.</p>
      </div>
      <div class="nearby-grid reveal">
        <div class="nearby-card">
          <h4>Biglerville</h4>
          <p>The capital of the fruit belt, 9 miles north on US-15/PA-34. Orchard farms, packing houses and in-town homes near the National Apple Museum.</p>
        </div>
        <div class="nearby-card">
          <h4>Cashtown</h4>
          <p>Historic crossroads west on US-30 at the foot of the mountain. Country homes, small acreage and the landmark Cashtown Inn nearby.</p>
        </div>
        <div class="nearby-card">
          <h4>Fairfield</h4>
          <p>A walkable mountain borough 8 miles southwest on PA-116. Gateway to Carroll Valley, ski country and wooded recreational land.</p>
        </div>
        <div class="nearby-card">
          <h4>New Oxford</h4>
          <p>Antiques town 8 miles east on US-30. Farmland and family homes with quick access toward Hanover and York.</p>
        </div>
        <div class="nearby-card">
          <h4>Littlestown</h4>
          <p>Southeast on PA-97 toward the Maryland line. Open farm ground, newer subdivisions and value per acre for commuting buyers.</p>
        </div>
        <div class="nearby-card">
          <h4>McSherrystown &amp; Hanover</h4>
          <p>The county's busier eastern edge. Denser boroughs with nearby farmland — handy for buyers who want acreage close to services and employers.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= GETTYSBURG ANCHOR ============================= -->
  <section class="section section-alt">
    <div class="wrap prose reveal">
      <h2>Getting here &amp; getting around</h2>
      <p>Gettysburg is the hub of it all. Our office at 100 Concept Way is about a mile north of Lincoln Square — from US-15, take the Gettysburg exits and head toward town; from US-30, you're minutes away whether you're coming from Chambersburg to the west or York to the east. Downtown parking is easiest in the lots off Race Horse Alley and along Stratton Street, and most of the historic district around Steinwehr Avenue, Baltimore Street and the David Wills House is walkable once you're in.</p>
      <p>Even buyers hunting pure farmland like to know what's close, so here's the short list: the Gettysburg National Military Park and its landmarks — Seminary Ridge, Little Round Top, the Eternal Light Peace Memorial — sit right at the edge of town; Sachs Covered Bridge spans Marsh Creek down toward Liberty Township; and the orchards, wineries and farm stands of the fruit belt spread north toward Biglerville. When we show you a parcel, we'll tell you honestly how far it really is from a grocery store, a school and a hospital — not just how pretty the view is.</p>
      <p>Ready to narrow it down? Browse our <a href="{{ home_url('/listings') }}">current listings</a>, read the <a href="{{ home_url('/guide') }}">Land Buyer's Guide</a>, or <a href="{{ home_url('/contact') }}">reach out to the office</a> and we'll point you toward the townships that fit what you're after.</p>
    </div>
  </section>

  <!-- ============================= CTA BAND ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>Not sure which township fits you?</h2>
        <p>Tell a Keystone agent what you're after — acreage, a homestead, orchard ground, a mountain cabin — and we'll steer you to the right corner of Adams County.</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/#book-showing') }}">Book a showing</a>
          <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse Listings</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
