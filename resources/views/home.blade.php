@extends('templates.main')

@section('header')
    @include('partials.navbar')
    @include('partials.hero')
@endsection


@section('hero-image')
    @include('partials.hero-image')
@endsection

@section('body')
    {{-- mvp --}}
    @include('partials.mvp')

    {{-- Features That Will 
    Elevate Your Business --}}
    @include('partials.features-bussiness')

    {{-- section Revamp Your Website Design 
    with Our Template Library --}}
    @include('partials.revamp')
@endsection

@section('footer-cta')
    @include('partials.footer-cta')
@endsection


@section('footer')
    @include('partials.footer')
@endsection
