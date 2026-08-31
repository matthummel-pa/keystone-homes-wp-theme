{{--
  Template Name: Simple page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.breadcrumbs')
    @include('partials.page-hero', [
      'heroBrand' => ($copy['hero_brand'] ?? '') !== '' ? $copy['hero_brand'] : ($identity['brand'] ?? 'Acreline'),
      'heroEyebrow' => $copy['hero_eyebrow'] ?? '',
      'heroTitle' => $copy['hero_title'] ?: get_the_title(),
      'heroText' => $copy['hero_text'] ?? '',
    ])
    @if (! empty($copy['body']))
    <section class="section">
      <div class="wrap prose">
        {!! wpautop($copy['body']) !!}
      </div>
    </section>
    @endif
    <section class="section section-alt">
      <div class="wrap">
        <div class="cta-band reveal">
          <h2>Ready to walk a sample home?</h2>
          <p>Browse fictional inventory or book a showing — the same flow buyers expect on a modern realtor site.</p>
          <div class="cta-actions">
            <a class="btn btn-primary" href="{{ home_url('/book/') }}">Book a showing</a>
            <a class="btn btn-outline light" href="{{ home_url('/listings') }}">Browse listings</a>
          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection
