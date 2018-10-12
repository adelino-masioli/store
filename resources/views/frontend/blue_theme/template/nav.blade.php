@include('frontend.blue_theme.partials.topbar')<!-- header-->
@include('frontend.blue_theme.partials.search')<!-- search-->

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item  {{{ (Request::is('/') ? 'active' : '') }}}">
                        <a class="nav-link" href="{{route('frontend-home')}}">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('sobre') ? 'active' : '') }}}" href="{{route('frontend-about')}}">SOBRE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('produtos') ? 'active' : '') }}}" href="{{route('frontend-products')}}">PRODUTOS</a>
                    </li>
                   @foreach($menu as $menu)
                        <li class="nav-item text-center">
                            <a class="nav-link text-uppercase {{{ (Request::segment(2) == $menu->slug ? 'active' : '') }}}" href="{{route('frontend-product-categories', [$menu->slug])}}">{{$menu->name}}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('contato') ? 'active' : '') }}}" href="{{route('frontend-contact')}}">CONTATO</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>