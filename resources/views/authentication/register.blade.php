@extends('templates.main')


@section('head-link')
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">
    <script src="https://apis.google.com/js/api.js"></script>

    <script src="https://accounts.google.com/gsi/client" onload="initClient()" async defer></script>
@endsection


@section('body')
    <div class="container vh-100">

        <div class="auth-wrapper">
            <div class="row g-0 d-sm-flex align-items-center">
                <div class="col-sm-6 order-sm-0 order-1">
                    <div class="img-login "></div>
                </div>

                <div
                    class="col-sm-4 offset-sm-1 order-0 order-sm-1 d-flex flex-column justify-content-around wrapper-auth-form">

                    <div>
                        <img src="{{ asset('image/MicroKit.svg') }}" alt="" width="125" height="auto"
                            class="d-inline-block align-text-top microkit">
                    </div>

                    <div>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <h2 class="title-login">Sign Up for Free</h2>
                        <p class="subtitle-login">Create an Account and Start Building Your Website</p>

                        <form id="loginForm" action="sign-up/do-register" method="POST">

                            @csrf

                            <div class="input-name">
                                <label for="inputName" class="col-form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="inputName"
                                    placeholder="Please enter your full name" required>
                            </div>

                            <div class="input-email">
                                <label for="inputEmail" class="col-form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="inputEmail"
                                    placeholder="jamescook@gmail.com" autocomplete="on" required>
                            </div>

                            <div class="input-password">
                                <label for="inputPassword" class="col-form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword"
                                    placeholder="Enter password" required>
                            </div>




                            <button id="btnSignIn" type="submit" class="btn container">Create a new account</button>

                            <hr>

                        </form>

                        <button type="button" id="googleLogin" class="btn container" onclick="getToken()">
                            <i class="google-icon"></i>
                            Create a new account via Google
                        </button>

                        <p class="dont-have-account text-center">Have you already created an account before?
                            <span class="sign-up">
                                <a href="{{ url('/sign-in') }}">Sign in</a>
                            </span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    <script src="{{ asset('js/auth/register-google-oauth.js') }}"></script>
@endsection
