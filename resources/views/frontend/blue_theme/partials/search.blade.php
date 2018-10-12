<section class="topsearch">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a class="navbar-brand animated fadeInUp hvr-buzz-out" href="{{route('frontend-home')}}"><img class="img-fluid" src="{{asset('templates/'.$config_site->theme)}}/assets/images/brand.png" alt=""></a>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                @include('frontend.blue_theme.partials.search_form')<!-- search form-->
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="topsupport">
                    <span class="animated fadeInUp">Contato pelo WhatsApp</span>
                    <a href="https://api.whatsapp.com/send?phone=55{{only_number($config_site->whatsapp)}}" target="_blank">
                        <h5 class="animated fadeInUp">{{$config_site->whatsapp}}</h5>
                        <i class="fa fa-whatsapp pull-right animated fadeInUp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>