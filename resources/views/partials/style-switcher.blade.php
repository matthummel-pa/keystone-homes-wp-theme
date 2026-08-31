@php
  $schemes = \App\Support\ColorSchemes::all();
  $current = $identity['colorScheme'] ?? \App\Support\ColorSchemes::currentKey();
@endphp
<aside class="style-switcher" id="styleSwitcher">
  <button type="button" class="style-switcher-toggle" aria-expanded="false" aria-controls="styleSwitcherPanel">
    {{ __('Colors', 'keystone-homes') }}
  </button>
  <div class="style-switcher-panel" id="styleSwitcherPanel" hidden>
    <p class="style-switcher-label" id="styleSwitcherLabel">{{ __('Try a color style', 'keystone-homes') }}</p>
    <div class="style-switcher-swatches" role="group" aria-labelledby="styleSwitcherLabel">
      @foreach ($schemes as $key => $scheme)
        <button
          type="button"
          class="style-switcher-swatch"
          data-scheme="{{ $key }}"
          aria-pressed="{{ $key === $current ? 'true' : 'false' }}"
          title="{{ $scheme['label'] }}"
        >
          <span class="style-switcher-chip" style="background:{{ $scheme['accent'] }}" aria-hidden="true"></span>
          <span>{{ $scheme['label'] }}</span>
        </button>
      @endforeach
    </div>
    <p class="style-switcher-hint">{{ __('Buyers set a style under Customize → Colors.', 'keystone-homes') }}</p>
  </div>
</aside>
