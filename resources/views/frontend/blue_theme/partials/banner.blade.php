<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <picture>
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner.jpg" media="(min-width: 1400px)">
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_1400.jpg" media="(min-width: 768px)">
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_800.jpg" media="(min-width: 576px)">
                <img srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_600.jpg" alt="responsive image" class="d-block img-fluid">
            </picture>


            <div class="container">
                <div class="carousel-caption">
                    <h1 class="text-caption" data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out">Example headline.</h1>
                    <p class="text-caption" data-aos="fade-down"  data-aos-delay="50" data-aos-easing="ease-in-out">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out"><a class="btn btn-lg btn-primary btn-flat shadow-none" href="#" role="button">Ver mais</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <picture>
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_2.jpg" media="(min-width: 1400px)">
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_1400_2.jpg" media="(min-width: 768px)">
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_800_2.jpg" media="(min-width: 576px)">
                <img srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_600_2.jpg" alt="responsive image" class="d-block img-fluid">
            </picture>
            <div class="container">
                <div class="carousel-caption">
                    <h1 class="text-caption" data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out">Another example headline.</h1>
                    <p class="text-caption" data-aos="fade-down"  data-aos-delay="50" data-aos-easing="ease-in-out">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out"><a class="btn btn-lg btn-primary btn-flat shadow-none" href="#" role="button">Ver mais</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <picture>
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_3.jpg" media="(min-width: 1400px)">
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_1400_3.jpg" media="(min-width: 768px)">
                <source srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_800_3.jpg" media="(min-width: 576px)">
                <img srcset="{{asset('templates/'.$config_site->theme)}}/assets/images/banner_600_3.jpg" alt="responsive image" class="d-block img-fluid">
            </picture>
            <div class="container">
                <div class="carousel-caption">
                    <h1 class="text-caption" data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out">One more for good measure.</h1>
                    <p class="text-caption" data-aos="fade-down"  data-aos-delay="50" data-aos-easing="ease-in-out">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out"><a class="btn btn-lg btn-primary btn-flat shadow-none" href="#" role="button">Ver mais</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>