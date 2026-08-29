<button type="button" class="chat-fab" id="chatFab" aria-label="Open chat assistant" aria-expanded="false" aria-controls="chatWidget">
  <svg viewBox="0 0 24 24" stroke-width="2" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
</button>
<div class="chat-widget" id="chatWidget" role="dialog" aria-modal="true" aria-labelledby="chatTitle" aria-hidden="true" hidden>
  <div class="chat-head">
    <div><strong id="chatTitle">Concept Assistant</strong><br><span>Demo replies only</span></div>
    <button type="button" class="chat-close" id="chatCloseBtn" aria-label="Close chat">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <div class="chat-body" id="chatBody" aria-live="polite" aria-relevant="additions">
    <div class="chat-msg bot">Hi — this is a concept assistant. Ask about sample listings, financing tools, or booking a demo showing.</div>
  </div>
  <div class="chat-quick" id="chatQuick">
    <button type="button" data-q="land">Land prices?</button>
    <button type="button" data-q="tour">Book a tour</button>
    <button type="button" data-q="financing">Financing?</button>
    <button type="button" data-q="historic">Historic homes?</button>
  </div>
</div>
