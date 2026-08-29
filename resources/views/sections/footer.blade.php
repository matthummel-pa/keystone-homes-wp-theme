<footer class="site-footer">
  <div class="wrap">
    <div class="footer-cta">
      <div>
        <p class="eyebrow">Next step</p>
        <h2>Tour a sample home</h2>
        <p>Pick a listing, choose a slot, and see how a modern realtor booking flow feels.</p>
      </div>
      <div class="footer-cta-actions">
        <a class="btn btn-primary" href="{{ home_url('/book/') }}">Book a showing</a>
        <a class="btn btn-outline light" href="tel:+15550100455">Call the office</a>
      </div>
    </div>

    <div class="footer-grid">
      <div class="footer-intro">
        <div class="footer-brand">
          <svg width="34" height="34" viewBox="0 0 48 48" fill="none" aria-hidden="true">
            <rect width="48" height="48" rx="12" fill="#1f6b4a"/>
            <path d="M24 10 L40 22 V38 H8 V22 Z" fill="#141210"/>
            <rect x="20" y="26" width="8" height="12" fill="#fffcf7"/>
          </svg>
          <strong>Keystone Homes &amp; Land</strong>
        </div>
        <p>Concept realtor site by Ridges &amp; Valleys Studio. Fiction only — not a licensed brokerage or live MLS feed.</p>
      </div>
      <div>
        <h2 class="footer-heading">Demo office</h2>
        <address>
          100 Concept Way<br>
          Sample Borough, PA 00000<br>
          <a href="tel:+15550100455">(555) 010-0455</a><br>
          <a href="mailto:hello@keystone-concept.test">hello@keystone-concept.test</a>
        </address>
      </div>
      <div>
        <h2 class="footer-heading">Hours</h2>
        <p>Mon–Fri 9:00–5:00<br>Sat by appointment<br>Sun closed (demo)</p>
      </div>
      <nav aria-labelledby="footer-links-heading">
        <h2 class="footer-heading" id="footer-links-heading">Explore</h2>
        <ul class="footer-links">
          <li><a href="{{ home_url('/listings') }}">Listings</a></li>
          <li><a href="{{ home_url('/areas') }}">Areas</a></li>
          <li><a href="{{ home_url('/book/') }}">Book a showing</a></li>
          <li><a href="{{ home_url('/guide') }}">Buyer guide</a></li>
          <li><a href="{{ home_url('/agents') }}">Agents</a></li>
          <li><a href="{{ home_url('/contact') }}">Contact</a></li>
        </ul>
      </nav>
    </div>
    <p class="footer-service-area">Serving a fictional Sample County market for design demonstration purposes.</p>
    <div class="footer-bottom">
      <div class="equal-housing">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 21v-6h6v6"/></svg>
        <span>Equal Housing Opportunity (concept)</span>
      </div>
      <p>&copy; <span data-year>{{ date('Y') }}</span> Concept by Ridges &amp; Valleys Studio · Illustrative data only.</p>
    </div>
  </div>
</footer>
