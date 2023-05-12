@extends('templates.main')

@section('head-link')
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">
@endsection

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


@section('footer-script')
    <script src="{{ asset('js/popper.js') }}"></script>
@endsection
