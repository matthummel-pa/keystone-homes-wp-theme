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
        <h1>{!! get_the_title() !!}</h1>
      </div>
    </section>
    <section class="section">
      <div class="wrap prose">
        @php(the_content())
      </div>
    </section>
  @endwhile
@endsection
