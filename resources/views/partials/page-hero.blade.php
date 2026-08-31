@php
  $heroBrand = $heroBrand ?? (($copy['hero_brand'] ?? '') !== '' ? $copy['hero_brand'] : ($identity['brand'] ?? 'Keystone Real Estate'));
  $heroEyebrow = $heroEyebrow ?? ($copy['hero_eyebrow'] ?? '');
  $heroTitle = $heroTitle ?? ($copy['hero_title'] ?? '');
  $heroText = $heroText ?? ($copy['hero_text'] ?? '');
  $heroActions = $heroActions ?? [];
  $headingId = $headingId ?? 'page-hero-heading';
  $heroClass = $heroClass ?? '';
@endphp
<section class="page-hero page-hero--photo{{ $heroClass ? ' '.$heroClass : '' }}" aria-labelledby="{{ $headingId }}">
  <figure class="page-hero-media">
    @include('partials.hero-image')
  </figure>
  <div class="page-hero-veil" aria-hidden="true"></div>
  <div class="page-hero-inner">
    @if ($heroBrand)
      <p class="hero-brand">{!! $heroBrand !!}</p>
    @endif
    @if ($heroEyebrow)
      <p class="hero-eyebrow">{{ $heroEyebrow }}</p>
    @endif
    <h1 id="{{ $headingId }}">{!! $heroTitle !!}</h1>
    @if ($heroText)
      <p>{!! $heroText !!}</p>
    @endif
    @if ($heroActions)
      <div class="page-hero-cta">
        @foreach ($heroActions as $action)
          <a class="{{ $action['class'] ?? 'btn btn-primary' }}" href="{{ $action['href'] }}">{{ $action['label'] }}</a>
        @endforeach
      </div>
    @endif
  </div>
</section>
