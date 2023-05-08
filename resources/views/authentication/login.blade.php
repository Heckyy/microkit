@extends('templates.main')


@section('head-link')
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">


    <script src="https://apis.google.com/js/platform.js" async defer></script>
@endsection


@section('body')
    <div class="container vh-100">

        <div class="auth-wrapper">
            <div class="row g-0 d-sm-flex align-items-center">
                <div class="col-sm-6">
                    <div class="img-login"></div>
                </div>

                <div class="col-sm-4 offset-sm-1">
                    <h2 class="title-login">Ready to Create?</h2>
                    <p class="subtitle-login">Sign in to Begin Crafting Your Website</p>

                    <form id="loginForm" action="">

                        <div class="input-email">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="jamescook@gmail.com">
                        </div>

                        <div class="input-password">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Enter password">
                        </div>
                    </form>



                    <button id="btnSignIn" type="button" class="btn btn-primary container">Sign In</button>

                    <hr>

                    <button id="googleLogin" class="container" onclick="onCustomSignIn()">
                        <i class="google-icon"></i>
                        Log in via Google
                    </button>

                    <p class="dont-have-account text-center">Do you not have an account yet?
                        <span class="sign-up">
                            <a href="http://">Sign up</a>
                        </span>
                    </p>
                </div>

            </div>
        </div>
    </div>


    <script>
        function onSignIn(googleUser) {
            // Get the user's ID token and send it to your server for verification
            var id_token = googleUser.getAuthResponse().id_token;
            console.log('ID token:', id_token);
        }

        gapi.load('auth2', function() {
            gapi.auth2.init({
                client_id: 'YOUR_CLIENT_ID'
            });
        });

        function onCustomSignIn() {
            gapi.auth2.getAuthInstance().signIn().then(onSignIn);
        }
    </script>
@endsection
