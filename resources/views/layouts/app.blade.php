<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1f6b4a">
    <meta name="author" content="Ridges & Valleys Studio — concept demo">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
      window.KEYSTONE = @json($keystone);
    </script>
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <p class="demo-banner"><strong>Concept demo</strong> · Fiction only · Not a live MLS, brokerage or booking system</p>

    @include('sections.header')

    <main id="main" class="main">
      @yield('content')
    </main>

    @hasSection('sidebar')
      <aside class="sidebar">
        @yield('sidebar')
      </aside>
    @endif

    @include('sections.footer')
    @include('partials.chat')

    <a href="https://ridgesandvalleys.com" class="concept-badge" rel="noopener">Concept · Ridges &amp; Valleys Studio</a>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
