<!-- FOOTER -->
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3 footer-search-form">
            @include('frontend.blue_theme.partials.search_form')<!-- search form-->
            </div>
        </div>

        <div class="row menu-footer">
            <div class="col col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <h3>
                    INFORMAÇÕES
                    <span class="border-bottom"></span>
                </h3>
                <ul>
                    <li><a href="{{route('frontend-about')}}">&middot; Sobre</a></li>
                    <li><a href="{{route('frontend-privacy')}}">&middot; Privacidade</a></li>
                    <li><a href="{{route('frontend-terms')}}">&middot; Termos</a></li>
                    <li><a href="{{route('frontend-contact')}}">&middot; Contato</a></li>
                </ul>
            </div>
            <div class="col  col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <h3>
                    MINHA CONTA
                    <span class="border-bottom"></span>
                </h3>
                <ul>
                    <li><a href="{{route('frontend-register')}}">&middot; Cadastre-se</a></li>
                    <li><a href="{{route('frontend-my-account')}}">&middot; Minha conta</a></li>
                    <li><a href="{{route('frontend-shoppingcart-home')}}">&middot; Carrinho</a></li>
                    <li><a href="{{route('frontend-login')}}">&middot; Login</a></li>
                </ul>
            </div>
            <div class="col  col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <h3>
                    CATEGORIAS
                    <span class="border-bottom"></span>
                </h3>
                <ul>
                    @foreach($menu as $menu)
                        <li><a href="{{route('frontend-product-categories', [$menu->slug])}}">&middot; {{$menu->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col  col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <h3>
                    REDES SOCIAIS
                    <span class="border-bottom"></span>
                </h3>
                <ul>
                    <li><a target="_blank" href="https://facebook.com">&middot; <i class="fa fa-facebook"></i> Faceboot</a></li>
                    <li><a target="_blank" href="https://twitter.com">&middot; <i class="fa fa-twitter"></i> Twitter</a></li>
                    <li><a target="_blank" href="https://www.instagram.com">&middot; <i class="fa fa-instagram"></i> Instagram</a></li>
                    <li><a target="_blank" href="https://youtube.com">&middot; <i class="fa fa-youtube"></i> YoutTube</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <a href="#top" class="float-right" id="go-to-top"><i class="fa fa-arrow-up"></i></a>
        <p>&copy; <?php echo date('Y'); ?> {{$config_site->name}}</p>
    </div>
</footer>