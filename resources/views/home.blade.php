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

<section class="img-section">
    <div class="container-fluid container-img-section">
        <div class="row">
            <div class="col">
                <img src="{{ asset('image/img-section.svg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</section>
@include('templates.footer')
