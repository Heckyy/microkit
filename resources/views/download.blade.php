@extends('templates.main')


@section('head-link')
    <link rel="stylesheet" href="{{ asset('css/download.css') }}">
@endsection


@section('header')
    @include('partials.navbar')


    @if (isset(auth()->user()->email))
        <section id="download">

            <div class="container">
                <div class="row d-flex flex-column align-items-center">
                    <div class="col-sm-4">
                        <img src="{{ asset('image/no-download.png') }}" alt="" srcset="" class="img-fluid">

                        <div>
                            <h4 class="text-oops">Oops!</h4>
                            <p class="text-oops-detail">You haven't built or downloaded your website yet.
                                But don't worry, let's make it happen and create
                                your very own website!</p>
                        </div>

                        <div class="container-button-hero text-center">
                            <button class="btn button-hero">Start Building Your Site !</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @else
        <div class="alert alert-danger" role="alert">
            Please Sign In
        </div>
    @endif
@endsection


@section('footer')
    @include('partials.footer')
@endsection


@section('footer-script')
    <script src="{{ asset('js/popper.js') }}"></script>
@endsection
