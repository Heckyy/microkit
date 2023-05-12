@extends('templates.main')


@section('head-link')
    <link rel="stylesheet" href="{{ asset('css/profilesetting.css') }}">
@endsection


@section('header')
    @include('partials.navbar')


    @if (isset(auth()->user()->email))
        <section id="profileSetting">
            <div class="container">
                <div class="row d-flex flex-column align-items-center">
                    <div class="container-edit-profile col-sm-6 d-flex flex-column align-items-center">

                        <div class="col-sm-10 col-12 editProfile">
                            <div class="d-flex flex-column align-items-center">
                                <div class="greeting">Welcome,</div>
                                <img src="{{ auth()->user()->picture }}" alt="" srcset=""
                                    class="img-fluid rounded-circle img-profile-setting" width="100" height="100">
                                <div class="profile-setting-name">{{ auth()->user()->name }}</div>
                            </div>

                            <hr>

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form id="formEditProfileSetting" action="profile-setting/update" method="POST">

                                @csrf

                                <input type="hidden" name="registerType" class="form-control" autocomplete="on"
                                    value="{{ auth()->user()->register_type }}">

                                <input type="hidden" name="idUser" class="form-control" autocomplete="on"
                                    value="{{ auth()->user()->id }}">

                                @if (auth()->user()->register_type == 'register with google')
                                    <div class="input-email">
                                        <label for="inputEmail" class="col-form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail"
                                            placeholder="{{ auth()->user()->email }}" autocomplete="on" required disabled>
                                    </div>
                                @else
                                    <div class="input-email">
                                        <label for="inputEmail" class="col-form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail"
                                            placeholder="{{ auth()->user()->email }}" value="{{ auth()->user()->email }}"
                                            autocomplete="on">
                                    </div>
                                @endif


                                <div class="input-name">
                                    <label for="inputName" class="col-form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="inputName"
                                        placeholder="{{ auth()->user()->name }}" value="{{ auth()->user()->name }}">
                                </div>


                                @if (auth()->user()->register_type == 'register with google')
                                    <div class="input-new-password">
                                        <label for="inputNewPassword" class="col-form-label">New Password</label>
                                        <input type="password" name="newPassword" class="form-control" id="inputNewPassword"
                                            placeholder="Set a new password" required disabled>
                                    </div>
                                @else
                                    <div class="input-new-password">
                                        <label for="inputNewPassword" class="col-form-label">New Password</label>
                                        <input type="password" name="newPassword" class="form-control" id="inputNewPassword"
                                            placeholder="Set a new password">
                                    </div>
                                @endif

                                @if (auth()->user()->register_type == 'register with google')
                                    <div class="input-conf-password">
                                        <label for="inputConfPassword" class="col-form-label">Confirm Password</label>
                                        <input type="password" name="confPassword" class="form-control"
                                            id="inputConfPassword" placeholder="Verify your new password" required disabled>
                                    </div>
                                @else
                                    <div class="input-conf-password">
                                        <label for="inputConfPassword" class="col-form-label">Confirm Password</label>
                                        <input type="password" name="confPassword" class="form-control"
                                            id="inputConfPassword" placeholder="Verify your new password">
                                    </div>
                                @endif





                                <button id="btnUpdateProfileSetting" type="submit" class="btn container">Update</button>


                            </form>

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
