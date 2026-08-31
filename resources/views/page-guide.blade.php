{{--
  Template Name: Guide
--}}

@extends('layouts.app')

@section('content')
<!-- ============================= BREADCRUMB ============================= -->
@include('partials.breadcrumbs')

@include('partials.page-hero', [
  'heroBrand' => ($copy['hero_brand'] ?? '') !== '' ? $copy['hero_brand'] : ($identity['brand'] ?? 'Acreline'),
  'heroEyebrow' => $copy['hero_eyebrow'] ?: 'Buyer tools',
  'heroTitle' => $copy['hero_title'] ?: 'A clearer path to <em>buying land or a home</em>',
  'heroText' => $copy['hero_text'] ?: 'Wells, septic, and access change what acreage is worth. Short guides and demo calculators — then book a showing if you want to walk a sample parcel.',
  'heroActions' => [
    ['href' => home_url('/listings'), 'label' => 'Browse listings', 'class' => 'btn btn-primary'],
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-outline light'],
  ],
])


  <section class="section">
    <div class="wrap mkt-lead reveal">
      <p class="eyebrow">Buying land</p>
      <div>
        <h2>{!! $copy['intro_title'] ?? 'What\'s different about buying land' !!}</h2>
        <p class="lede">{!! $copy['intro_text'] ?? 'When you buy an existing home, utilities are usually sorted. Out in the townships you often have to prove water, septic and access yourself — and those answers change the value of the ground.' !!}</p>
      </div>
    </div>
    <div class="wrap">
      <div class="topic-grid">
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">01</p>
          <h3>Water: wells and yield</h3>
          <p>Most rural parcels run on a private well. Ask whether one exists, what it yields, and whether a new hole is likely to hit water. Flow-test and potability-test an existing well; read neighboring wells on raw land.</p>
        </article>
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">02</p>
          <h3>Waste: septic and perc</h3>
          <p>No public sewer means an on-lot system and a perc test. The soils report decides where a house can sit. A valid perc is worth more — and closes faster — than a “we’ll figure it out later.”</p>
        </article>
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">03</p>
          <h3>Access and easements</h3>
          <p>Every buildable parcel needs recorded access to a public road. Handshake lanes across a neighbor’s field fail at closing. Flag utility easements, ag-security areas, and deed restrictions before you write.</p>
        </article>
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">04</p>
          <h3>Farmland tax programs</h3>
          <p>Use-value or “clean and green” enrollment lowers the annual bill. Subdivide or change use and you can trigger a rollback. Rename this card for the program your state actually uses.</p>
        </article>
        <article class="topic-card reveal">
          <p class="topic-num" aria-hidden="true">05</p>
          <h3>Land loans</h3>
          <p>Raw land and working farms rarely fit a standard 30-year mortgage. Expect a larger down payment. The estimators below are planning math — a lender writes the real terms.</p>
        </article>
      </div>
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
            <div class="form-block">
              <button type="submit" class="btn btn-gold btn-block">Update Estimate</button>
            </div>
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
            <div class="form-block">
              <button type="submit" class="btn btn-gold btn-block">See My Estimate</button>
            </div>
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
                <input type="tel" id="schPhone" required placeholder="(555) 010-0142">
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
              <div class="field field-span">
                <label for="schNote">What are you looking for? (optional)</label>
                <input type="text" id="schNote" placeholder="e.g. 10+ acres near Oak Hollow">
              </div>
              <div class="field field-span">
                <button type="submit" class="btn btn-primary btn-block">Request a Call Back</button>
              </div>
            </div>
          </form>
          <div class="confirm-msg" id="scheduleConfirm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
            <span>Thanks! This is a concept demo — on your live site, an agent would be notified instantly and confirm by text.</span>
          </div>
        </div>

        <div class="tool-card reveal">
          <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg> A quick land-buying checklist</h3>
          <p style="color:var(--ink-soft);font-size:.92rem;margin-top:6px;">Before you write an offer on a rural parcel, confirm:</p>
          <ul class="bullets" style="margin-top:14px;display:grid;gap:10px;list-style:none;padding:0;">
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Legal, recorded road access (not just a neighbor's lane)</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>A valid perc test / soils report, or a perc contingency</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Well status &amp; likely yield, or public water at the road</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Township zoning &amp; minimum lot size for your plans</li>
            <li style="display:flex;gap:10px;"><span style="flex:none;width:8px;height:8px;margin-top:8px;border-radius:2px;background:var(--wheat);"></span>Preferential farmland-tax enrollment &amp; rollback risk</li>
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
        <article class="faq-item">
          <h3>How much land do I need for a house, well, and septic?</h3>
          <p>Township minimum lot size and the perc result decide this more than a round acre count. For a conventional on-lot system in rural country, buyers commonly start at one to two acres. Check the township first, then the soil — not the listing photo.</p>
        </article>
        <article class="faq-item">
          <h3>What is a perc test, and who pays for it?</h3>
          <p>A percolation test shows whether the soil can take septic effluent and where a system can sit. On raw land it is usually a buyer contingency, and the buyer typically pays. Some sellers already have a report. Do not skip it either way.</p>
        </article>
        <article class="faq-item">
          <h3>Can I get a normal mortgage on raw land?</h3>
          <p>Often not a standard 30-year mortgage. Land and farm purchases usually run through a land loan, construction loan, or farm-credit lender, with a larger down payment. Use the calculators on this page as planning math, not a loan offer.</p>
        </article>
        <article class="faq-item">
          <h3>What is a use-value or "clean and green" tax program?</h3>
          <p>Many states tax qualifying farm and forest land at agricultural use value instead of market value. It lowers the annual bill, but subdividing or changing use can trigger a rollback tax. Flag enrollment before you write an offer, and swap in the program name your buyers actually use.</p>
        </article>
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
