@php
  $social = $identity['social'] ?? [];
  $icons = [
    'facebook' => 'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z',
    'instagram' => 'M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4zm12 4h.01M12 8a4 4 0 100 8 4 4 0 000-8z',
    'youtube' => 'M22.5 6.2a3 3 0 00-2.1-2.1C18.6 3.6 12 3.6 12 3.6s-6.6 0-8.4.5A3 3 0 001.5 6.2 31 31 0 001 12a31 31 0 00.5 5.8 3 3 0 002.1 2.1c1.8.5 8.4.5 8.4.5s6.6 0 8.4-.5a3 3 0 002.1-2.1A31 31 0 0023 12a31 31 0 00-.5-5.8zM10 15.5v-7l6 3.5-6 3.5z',
    'linkedin' => 'M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-4 0v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 2a2 2 0 110 4 2 2 0 010-4z',
    'x' => 'M4 4l16 16M20 4L4 20',
  ];
@endphp
@if ($social !== [])
  <nav class="social-row" aria-label="{{ esc_attr__('Social', 'acreline') }}">
    @foreach ($social as $network => $url)
      <a href="{{ esc_url($url) }}" rel="noopener noreferrer" target="_blank">
        <span class="visually-hidden">{{ ucfirst($network) }}</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path d="{{ $icons[$network] ?? 'M12 5v14M5 12h14' }}"/>
        </svg>
      </a>
    @endforeach
  </nav>
@endif
