@if (! empty($faqs))
<section class="section {{ $faqSectionClass ?? 'section-alt' }}" aria-labelledby="{{ $faqHeadingId ?? 'faq-heading' }}">
  <div class="wrap">
    <header class="section-head {{ $faqHeadClass ?? '' }} reveal">
      <p class="eyebrow">{{ $faqEyebrow ?? 'FAQ' }}</p>
      <h2 id="{{ $faqHeadingId ?? 'faq-heading' }}">{!! $faqTitle ?? 'Questions buyers actually ask' !!}</h2>
      @if (! empty($faqText))
        <p>{!! $faqText !!}</p>
      @endif
    </header>
    <div class="faq-list reveal">
      @foreach ($faqs as $faq)
        <details class="faq-item">
          <summary>{{ $faq['q'] }}</summary>
          <p>{!! $faq['a'] !!}</p>
        </details>
      @endforeach
    </div>
  </div>
</section>
@endif
