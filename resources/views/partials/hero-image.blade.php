{{-- Hero Image Standard --}}
<img
  src="{{ $hero_image_url }}"
  srcset="{{ $hero_image_srcset }}"
  sizes="100vw"
  width="1600"
  height="900"
  alt="{{ $hero_image_alt ?? 'Keystone Homes Featured Property' }}"
  fetchpriority="high"
  loading="eager"
  decoding="async"
  class="w-full object-cover"
/>
