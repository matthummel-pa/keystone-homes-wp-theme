{{--
  Template Name: Simple page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol>
        <li><a href="{{ home_url('/') }}">Home</a></li>
        <li><span aria-current="page">{!! get_the_title() !!}</span></li>
      </ol>
    </nav>
    <section class="page-hero">
      <div class="page-hero-inner">
        <p class="hero-brand">Keystone Homes &amp; Land</p>
        <p class="hero-brand">{!! $copy['hero_brand'] ?? 'Keystone Homes &amp; Land' !!}</p>
        <h1>{!! $copy['hero_title'] ?: get_the_title() !!}</h1>
        @if (! empty($copy['hero_text']))
          <p>{!! $copy['hero_text'] !!}</p>
        @endif
      </div>
    </section>
    @if (! empty($copy['body']))
    <section class="section">
      <div class="wrap prose">
        {!! wpautop($copy['body']) !!}
      </div>
    </section>
    @endif
  @endwhile
@endsection
