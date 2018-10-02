<!-- Navigation start -->
<header class="header">
    <nav class="navbar navbar-custom" role="navigation">

        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand wow fadeInUp" href="{{route('frontend-home')}}" title="{{$config_site->name}}"><img class="img-responsive" src="{{pathMidia('brands')}}/thumb/{{$config_site->brand}}" alt="{{$config_site->name}}"></a>
            </div>

            <div class="collapse navbar-collapse" id="custom-collapse">
                <div class="bar-top pull-right hidden-xs">
                    <div class="bar-top-item wow fadeInUp"><img src="{{asset('templates/'.$config_site->theme)}}/assets/images/phone.png" alt="{{$config_site->name}}"> <span class="hidden-xs">{{$config_site->phone}}</span></div>
                    <div class="bar-top-item border-margin-padding wow fadeInUp"><a href="mailto://{{$config_site->email}}"><img src="{{asset('templates/'.$config_site->theme)}}/assets/images/envelope.png" alt="{{$config_site->name}}"> <span class="hidden-xs hidden-sm">{{$config_site->email}}</span></a></div>
                    <div class="bar-top-item wow fadeInUp">
                        <form action="{{route('frontend-product-result')}}" method="post" class="formsearch">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="search" placeholder="Informe sua buscar" required>
                            <button class="search-submit"></button>
                        </form>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="wow fadeInUp"><a href="{{route('frontend-home')}}">Home</a></li>
                    <li class="wow fadeInUp"><a href="{{route('frontend-about')}}">SOBRE</a></li>
                    <li class="wow fadeInUp"><a href="{{route('frontend-products')}}">NOSSOS PRODUTOS</a></li>
                    <li class="wow fadeInUp"><a href="{{route('frontend-service')}}">ASSISTÊNCIA TÉCNICA</a></li>
                    <li class="wow fadeInUp"><a href="{{route('login')}}">ÁREA DO CLIENTE</a></li>
                    <li class="wow fadeInUp"><a href="{{route('frontend-contact')}}">CONTATO</a></li>
                </ul>
            </div>

        </div><!-- .container -->

    </nav>
</header>
<!-- Navigation end -->