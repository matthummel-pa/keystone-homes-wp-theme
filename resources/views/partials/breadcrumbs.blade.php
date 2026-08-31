@if (! is_front_page() && ! empty($breadcrumbs) && count($breadcrumbs) > 1)
  <nav class="breadcrumb" aria-label="{{ esc_attr__('Breadcrumb', 'keystone-homes') }}">
    <ol>
      @foreach ($breadcrumbs as $crumb)
        <li>
          @if ($crumb['url'] !== '')
            <a href="{{ esc_url($crumb['url']) }}">{{ $crumb['label'] }}</a>
          @else
            <span aria-current="page">{{ $crumb['label'] }}</span>
          @endif
        </li>
      @endforeach
    </ol>
  </nav>
@endif
