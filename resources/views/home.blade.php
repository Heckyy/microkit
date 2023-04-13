@include('templates.header')
<section id="hero-section">
    <div class="container d-lg-flex justify-content-center">
        <div class="row">
            <div class="col text-center">
                <div class="container-text">
                    <span class="hero-title">Launch Your
                        <br>Business Online Today
                        with Microkit's
                        <br>Easy Website Builder</span>
                </div>
                <div class="container-sub-text ">
                    <span class="sub-title-hero">Revolutionize Your Micro, Small, or Medium-Sized Business with
                        Microkit's
                        User-Friendly Website Builder - Effortlessly Create Your Online Presence Today!</span>
                </div>
                <div class="container-button-hero">
                    <button class="btn btn-primary button-hero">Start Building Your Site !</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Image Laptop Section --}}
<section class="img-section">
    <div class="container-fluid container-img-section">
        <div class="row">
            <div class="col">
                <img src="{{ asset('image/img-section.svg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</section>
{{-- End of Image Laptop Section --}}

{{-- MVP Section --}}
<section class="mvp-section">
    <div class="container">
        <div class="row title-section">
            <div class="col text-center">
                <span class="title-section">Why Microkit?</span>
            </div>
        </div>
        <div class="row subtitle-section">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col title-mvp">
                        Visionary entrepreneurs
                    </div>
                </div>
                <div class="row text-mvp">
                    <div class="col text-start">
                        perfect solution for entrepreneurs and small business owners who want to create a
                        professional-looking website without having to spend a lot of money on web design services.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="row">
                    <div class="col title-mvp">
                        Beginner-oriented
                    </div>
                </div>
                <div class="row text-mvp">
                    <div class="col text-start">
                        makes it easy for anyone to build and manage their website, even if they have no technical
                        background
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="row">
                    <div class="col title-mvp">
                        Non-technical
                    </div>
                </div>
                <div class="row text-mvp">
                    <div class="col text-start">
                        you don't need any coding or design experience to create a beautiful and functional website that
                        meets your needs
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="row">
                    <div class="col title-mvp">
                        Economical
                    </div>
                </div>
                <div class="row text-mvp">
                    <div class="col text-start">
                        cost-effective solution that allows you to create a professional-looking website in just
                        minutes, without having to pay for expensive web design services
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- End Of  MVP Section --}}
@include('templates.footer')
