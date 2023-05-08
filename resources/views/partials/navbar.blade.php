{{-- Navbar --}}
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('image/MicroKit.svg') }}" alt="" width="125" height="auto"
                class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        {{-- login user login --}}
        
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <button class="btn btn-primary me-lg-3 button-secondary">Sign In</button>
                <button class="btn btn-primary button-primary">Sign Up</button>
            </div>
        </div>
    </div>
</nav>
{{-- End Of Navbar --}}
