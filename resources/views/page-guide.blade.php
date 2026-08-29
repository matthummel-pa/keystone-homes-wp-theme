{{--
  Template Name: Guide
--}}

@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <li><a href="{{ home_url('/') }}">Home</a></li>
    <li><span aria-current="page">Land Buyer's Guide</span></li>
  </ol>
</nav>

<!-- ============================= PAGE HERO ============================= -->
<section class="page-hero">
  <div class="page-hero-inner">
    <p class="hero-brand">{!! $copy['hero_brand'] ?: 'Keystone Homes &amp; Land' !!}</p>
    <p class="hero-eyebrow">{{ $copy['hero_eyebrow'] ?: 'Buyer tools' }}</p>
    <h1>{!! $copy['hero_title'] ?: 'A clearer path to <em>buying land or a home</em>' !!}</h1>
    <p>{!! $copy['hero_text'] ?: 'Short guides and demo calculators. Use with the showing scheduler for a full agent workflow.' !!}</p>
  </div>
</section>


  <!-- ============================= GUIDE PROSE ============================= -->
  <section class="section">
    <div class="wrap prose reveal">
      <h2>{!! $copy['intro_title'] ?? 'What\'s different about buying land' !!}</h2>
      <p>{!! $copy['intro_text'] ?? 'When you buy an existing home, utilities are usually sorted. Out in the townships you often have to prove water, septic and access yourself.' !!}</p>

      <h3>Water: wells &amp; yield</h3>
      <p>Most rural Adams County property is served by a private well rather than public water. Two things matter: whether a well already exists and produces enough water, and — if the lot is raw — whether a new well is likely to hit a good yield. In the rockier ground toward South Mountain (Hamiltonban) yields can vary well to well. For an existing well we recommend a flow test and a potability test; for raw land we look at neighboring wells as a guide.</p>

      <h3>Waste: septic &amp; the perc test</h3>
      <p>No public sewer usually means an on-lot septic system, and that means a percolation ("perc") test through the township and the Pennsylvania DEP / SEO process. A perc test tells you whether — and where — the soil will absorb effluent, which in turn dictates where a house can sit. A parcel advertised as "perc-approved" with a valid soils report is worth more and closes faster than one where the test is still an unknown. We help you read an existing perc report or schedule a new one as an inspection contingency.</p>

      <h3>Access &amp; easements</h3>
      <p>Every buildable parcel needs legal, recorded access to a public road — a surprising number of back-lot tracts rely on a handshake lane across a neighbor's field. We confirm access in writing and flag utility easements, agricultural-security areas, right-of-way and any deed restrictions before you're committed.</p>

      <h3>Taxes: clean &amp; green (Act 319)</h3>
      <p>A lot of farm and orchard ground in the county is enrolled in Act 319 "clean and green," which taxes it at use value instead of market value — a real annual savings. But changing the use or subdividing can trigger a rollback tax of up to seven years. If a parcel is enrolled, we make sure you understand what you're inheriting.</p>

      <h3>Financing: land loans</h3>
      <p>Raw land and working farms often don't fit a standard 30-year mortgage. Local banks and farm-credit lenders offer land loans, construction-to-permanent loans and ag loans, typically with a larger down payment and a slightly higher rate than a home mortgage. The estimator below gives you a friendly ballpark; a lender will give you the real terms.</p>
    </div>
  </section>

  <!-- ============================= TOOLS ============================= -->
  <section class="section section-alt" id="tools">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="eyebrow">Run Your Numbers</p>
        <h2>Land-loan &amp; pre-qualification tools</h2>
        <p>Friendly estimates to help you plan — not loan offers. A licensed lender will verify everything with full documentation.</p>
      </div>

      <div class="support-grid">
        <!-- LAND LOAN ESTIMATE -->
        <div class="tool-card reveal" id="land-loan">
          <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg> Land-Loan Estimate</h3>
          <p style="color:var(--ink-soft);font-size:.92rem;margin-top:6px;">Estimate a monthly principal &amp; interest payment on a land or farm purchase.</p>
          <form id="landLoanForm">
            <div class="form-grid two">
              <div class="field">
                <label for="llPrice">Purchase price ($)</label>
                <input type="number" id="llPrice" min="0" step="1000" value="215000">
              </div>
              <div class="field">
                <label for="llDown">Down payment (%)</label>
                <input type="number" id="llDown" min="0" max="100" value="25">
              </div>
              <div class="field">
                <label for="llRate">Rate (%)</label>
                <input type="number" id="llRate" min="0" step="0.05" value="7.25">
              </div>
              <div class="field">
                <label for="llTerm">Term (years)</label>
                <select id="llTerm">
                  <option value="15">15</option>
                  <option value="20" selected>20</option>
                  <option value="30">30</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-gold" style="margin-top:16px;">Update Estimate</button>
          </form>
          <div class="calc-result" style="margin-top:16px;">
            <div>
              <span>Estimated monthly payment (P&amp;I)</span><br>
              <strong id="llMonthly">$0</strong>
            </div>
            <span>Loan amount: <strong id="llLoanAmt" style="color:var(--wheat-light);font-size:1rem;">$0</strong><br>Excludes taxes, insurance &amp; fees</span>
          </div>
          <p class="form-note">Land loans often carry a higher rate and larger down payment than a home mortgage — this is a planning estimate only.</p>
        </div>

        <!-- PRE-QUALIFICATION -->
        <div class="tool-card reveal" id="prequal">
          <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg> Financing Pre-Qualification</h3>
          <p style="color:var(--ink-soft);font-size:.92rem;margin-top:6px;">See a friendly estimate of what you may pre-qualify for. Not a loan offer — just a starting point.</p>
          <form id="preQualForm">
            <div class="form-grid two">
              <div class="field">
                <label for="pqIncome">Annual household income ($)</label>
                <input type="number" id="pqIncome" min="0" step="1000" required placeholder="95000">
              </div>
              <div class="field">
                <label for="pqDebts">Monthly debt payments ($)</label>
                <input type="number" id="pqDebts" min="0" step="50" required placeholder="450">
              </div>
              <div class="field">
                <label for="pqDown">Available down payment ($)</label>
                <input type="number" id="pqDown" min="0" step="1000" required placeholder="40000">
              </div>
              <div class="field">
                <label for="pqRate">Estimated rate (%)</label>
                <input type="number" id="pqRate" min="0" step="0.05" value="6.75" required>
              </div>
            </div>
            <button type="submit" class="btn btn-gold" style="margin-top:16px;">See My Estimate</button>
          </form>
          <div class="calc-result" id="pqResult" style="display:none;margin-top:16px;">
            <div>
              <span>You may pre-qualify up to</span>
              <strong id="pqAmount">$0</strong>
            </div>
            <span style="max-width:160px;text-align:right;">Estimate only — a lender will verify with full documentation.</span>
          </div>
          <p class="form-note">Uses a simple 36% debt-to-income guideline over a 30-year term. Your lender's numbers will differ.</p>
        </div>
      </div>

      <!-- SCHEDULER -->
      <div class="support-grid" style="margin-top:28px;">
        <div class="tool-card reveal" id="schedule">
          <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Request Info / Book a showing</h3>
          <p style="color:var(--ink-soft);font-size:.92rem;margin-top:6px;">Tell us a bit about what you're after and we'll call you back — usually same business day.</p>
          <form id="scheduleForm">
            <div class="form-grid two">
              <div class="field">
                <label for="schName">Full name</label>
                <input type="text" id="schName" required placeholder="Jordan Weikert">
              </div>
              <div class="field">
                <label for="schPhone">Phone</label>
                <input type="tel" id="schPhone" required placeholder="(717) 555-0142">
              </div>
              <div class="field">
                <label for="schDate">Preferred date</label>
                <input type="date" id="schDate" required>
              </div>
              <div class="field">
                <label for="schTime">Preferred time</label>
                <select id="schTime" required>
                  <option value="">Select a time</option>
                  <option>9:00 AM</option>
                  <option>11:00 AM</option>
                  <option>1:00 PM</option>
                  <option>3:00 PM</option>
                  <option>5:00 PM</option>
                </select>
              </div>
            </div>
            <div class="field" style="margin-top:14px;">
              <label for="schNote">What are you looking for? (optional)</label>
              <input type="text" id="schNote" placeholder="e.g. 10+ acres near Franklin Township">
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top:16px;">Request a Call Back</button>
          </form>
          <div class="confirm-msg" id="scheduleConfirm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
            <span>Thanks! This is a concept demo — on your live site, a Keystone agent would be notified instantly and confirm by text.</span>
          </div>
        </div>

        <div class="tool-card reveal">
          <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg> A quick land-buying checklist</h3>
          <p style="color:var(--ink-soft);font-size:.92rem;margin-top:6px;">Before you write an offer on a parcel in Adams County, confirm:</p>
          <ul class="bullets" style="margin-top:14px;display:grid;gap:10px;list-style:none;padding:0;">
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Legal, recorded road access (not just a neighbor's lane)</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>A valid perc test / soils report, or a perc contingency</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Well status &amp; likely yield, or public water at the road</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Township zoning &amp; minimum lot size for your plans</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Act 319 clean-and-green enrollment &amp; rollback risk</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Floodplain, easements &amp; any deed restrictions</li>
          </ul>
          <p style="margin-top:18px;"><a class="btn btn-outline" href="{{ home_url('/listings') }}">Browse land listings</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= FAQ ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="eyebrow">Common Questions</p>
        <h2>Land-buying FAQs</h2>
      </div>
      <div class="faq-list reveal">
        <details class="faq-item">
          <summary>How much land do I need for a house and a well and septic?</summary>
          <p>It depends on the township's minimum lot size and the results of the perc test, but for a conventional on-lot septic system in rural Adams County, buyers commonly look at one to two acres or more. Our agents can tell you what a specific township requires.</p>
        </details>
        <details class="faq-item">
          <summary>What's a perc test and who pays for it?</summary>
          <p>A percolation test checks whether the soil will absorb septic effluent and where a system can go. On raw land it's usually done as a buyer contingency, and the buyer typically pays — though on some listings the seller has already had it done. Either way, don't skip it.</p>
        </details>
        <details class="faq-item">
          <summary>Can I get a normal mortgage on raw land?</summary>
          <p>Often not a standard 30-year mortgage. Land and farm purchases usually run through a land loan, construction loan or farm-credit lender, with a larger down payment. We'll connect you with local lenders who do this every day.</p>
        </details>
        <details class="faq-item">
          <summary>What is Act 319 clean and green?</summary>
          <p>It's a Pennsylvania program that taxes qualifying farm and forest land at its use value instead of market value. It saves money annually, but subdividing or changing the use can trigger a rollback tax. We flag it on any enrolled parcel.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- ============================= CTA BAND ============================= -->
  <section class="section section-alt">
    <div class="wrap">
      <div class="cta-band reveal">
        <h2>{!! $copy['cta_title'] ?? 'Ready to walk a sample parcel?' !!}</h2>
        <p>{!! $copy['cta_text'] ?? 'Book a demo showing or browse the sample inventory.' !!}</p>
        <div class="cta-actions">
          <a class="btn btn-gold" href="{{ home_url('/book/') }}">{{ $copy['cta_primary'] ?? 'Book a showing' }}</a>
          <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse Listings</a>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
