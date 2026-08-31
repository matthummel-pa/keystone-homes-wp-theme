{{--
  Template Name: Contact
--}}

@extends('layouts.app')

@section('content')
@include('partials.breadcrumbs')

@include('partials.page-hero', [
  'heroBrand' => $copy['hero_brand'] ?: 'Keystone Real Estate',
  'heroEyebrow' => $copy['hero_eyebrow'] ?: 'Concept office',
  'heroTitle' => $copy['hero_title'] ?: 'Get in touch <em>(demo only)</em>',
  'heroText' => $copy['hero_text'] ?: '100 Concept Way, Sample Borough. Call (555) 010-0455 or send a message. Prefer the full appointment flow? Book a sample showing.',
  'heroActions' => [
    ['href' => home_url('/book/'), 'label' => 'Book a showing', 'class' => 'btn btn-primary'],
    ['href' => 'tel:+15550100455', 'label' => 'Call the office', 'class' => 'btn btn-outline light'],
  ],
])


  <!-- ============================= CONTACT INFO + FORM ============================= -->
  <section class="section">
    <div class="wrap">
      <div class="contact-grid">
        <div class="contact-info reveal">
          <p class="eyebrow">Our Office</p>
          <h2>{!! $copy['office_title'] ?? 'Keystone Real Estate' !!}</h2>
          <dl>
            <div>
              <dt>Address</dt>
              <dd>{!! nl2br(e($copy['office_address'] ?? "100 Concept Way\nSample Borough, PA 00000")) !!}</dd>
            </div>
            <div>
              <dt>Phone</dt>
              <dd><a href="{{ \App\Support\Catalog::telHref($copy['office_phone'] ?? '(555) 010-0455') }}">{{ $copy['office_phone'] ?? '(555) 010-0455' }}</a></dd>
            </div>
            <div>
              <dt>Email</dt>
              <dd><a href="mailto:{{ $copy['office_email'] ?? 'hello@keystone-concept.test' }}">{{ $copy['office_email'] ?? 'hello@keystone-concept.test' }}</a></dd>
            </div>
            <div>
              <dt>Hours</dt>
              <dd>{!! nl2br(e($copy['office_hours'] ?? "Mon–Fri: 8:30am – 5:30pm\nSaturday: 9:00am – 1:00pm\nSunday: By appointment")) !!}</dd>
            </div>
            <div>
              <dt>Directions</dt>
              <dd>About a mile north of the square. From the highway, take the town exits toward the courthouse; visitor parking on site. Replace these directions in the page fields.</dd>
            </div>
          </dl>

          <div class="map-embed" role="img" aria-label="Illustrative map showing the Keystone Real Estate office north of a sample county seat">
            <div class="map-roads"></div>
            <div class="map-road-3"></div>
            <span class="pin-static">
              <svg viewBox="0 0 24 24"><path fill="#1f6b4a" stroke="#fffcf7" stroke-width="1.5" d="M12 2C7.6 2 4 5.6 4 10c0 6 8 12 8 12s8-6 8-12c0-4.4-3.6-8-8-8z"/><circle cx="12" cy="10" r="3" fill="#fffcf7"/></svg>
            </span>
            <div class="map-legend"><span>100 Concept Way · Concept demo</span></div>
          </div>
        </div>

        <div class="reveal">
          <div class="tool-card">
            <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16v12H5.17L4 17.17z"/></svg> {{ $copy['form_title'] ?? 'Send us a message' }}</h3>
            <p class="form-lede">{!! $copy['form_text'] ?? 'Tell us what you\'re looking for — or what you\'re thinking of selling — and we\'ll be in touch.' !!}</p>
            <form id="contactForm">
              <div class="form-grid two">
                <div class="field">
                  <label for="cName">Full name</label>
                  <input type="text" id="cName" required placeholder="Jordan Weikert">
                </div>
                <div class="field">
                  <label for="cPhone">Phone</label>
                  <input type="tel" id="cPhone" required placeholder="(555) 010-0142">
                </div>
                <div class="field">
                  <label for="cEmail">Email</label>
                  <input type="email" id="cEmail" required placeholder="{{ 'you@keystone-concept.test' }}">
                </div>
                <div class="field">
                  <label for="cTopic">I'm interested in</label>
                  <select id="cTopic">
                    <option>Buying land or a farm</option>
                    <option>Buying a home</option>
                    <option>Selling my property</option>
                    <option>A free valuation</option>
                    <option>Something else</option>
                  </select>
                </div>
                <div class="field field-span">
                  <label for="cMessage">Message</label>
                  <textarea id="cMessage" rows="4" placeholder="e.g. Looking for 10+ acres near Oak Hollow with a well already in."></textarea>
                </div>
                <div class="field field-span">
                  <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </div>
              </div>
            </form>
            <div class="confirm-msg" id="contactConfirm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
              <span>Thanks! This is a concept demo — on your live site, this message would be emailed straight to the Keystone team.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= FREE VALUATION (SELL) ============================= -->
  <section class="section section-alt" id="valuation">
    <div class="wrap">
      <div class="sell-section reveal">
        <div class="sell-copy">
          <p class="eyebrow">Thinking Of Selling</p>
          <h2>What's your farm or land worth right now?</h2>
          <p>Ground values in this sample market have moved in the last two years. Get a free, no-obligation estimate before you list — we'll factor in acreage, tillable ground, outbuildings and recent area sales.</p>
          <ul>
            <li><svg viewBox="0 0 24 24" stroke-width="2" fill="none"><path d="M20 6L9 17l-5-5"/></svg>Local comps from recent sample-market closings</li>
            <li><svg viewBox="0 0 24 24" stroke-width="2" fill="none"><path d="M20 6L9 17l-5-5"/></svg>Guidance on ag preservation &amp; easements</li>
            <li><svg viewBox="0 0 24 24" stroke-width="2" fill="none"><path d="M20 6L9 17l-5-5"/></svg>No pressure — just numbers you can trust</li>
          </ul>
        </div>
        <div class="val-card">
          <h3>Free Land &amp; Farm Valuation</h3>
          <p class="form-lede">Demo estimate — a Keystone agent will follow up with an accurate market analysis.</p>
          <form id="valForm">
            <div class="val-grid">
              <div class="field">
                <label for="valType">Property type</label>
                <select id="valType">
                  <option value="home">Home</option>
                  <option value="farm">Farm</option>
                  <option value="land">Land / Acreage</option>
                  <option value="historic">Historic Home</option>
                </select>
              </div>
              <div class="field">
                <label for="valAcres">Total acreage</label>
                <input type="number" id="valAcres" min="0" step="0.1" placeholder="e.g. 14.5" required>
              </div>
              <div class="field">
                <label for="valSqft">House sq ft (0 if land)</label>
                <input type="number" id="valSqft" min="0" step="10" placeholder="e.g. 2200">
              </div>
              <div class="field">
                <label for="valTownship">Township</label>
                <select id="valTownship">
                  <option value="Cumberland">North Ridge</option>
                  <option value="Straban">Mill Creek</option>
                  <option value="Franklin">Oak Hollow</option>
                </select>
              </div>
              <div class="field field-span">
                <button type="submit" class="btn btn-gold btn-block">Estimate My Value</button>
              </div>
            </div>
          </form>
          <div class="val-result" id="valResult">
            <span style="font-size:.78rem;color:var(--ink-soft);">Estimated market range</span>
            <strong id="valResultAmount">$0 – $0</strong>
            <p style="margin:8px 0 0;font-size:.82rem;color:var(--ink-soft);">Based on recent township comps. A licensed Keystone agent will refine this with a full walkthrough.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


<!-- ============================= FOOTER (SHARED) ============================= -->
@endsection
