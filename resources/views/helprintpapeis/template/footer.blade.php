<script src="{{asset('templates/'.config('app.template'))}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/styles/bootstrap4/popper.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/plugins/easing/easing.js"></script>
<script src="{{asset('templates/'.config('app.template'))}}/js/custom.js"></script>

<script>
    $(document).ready(function($) {
        var Body = $('body');
        Body.addClass('preloader-site');
    });

    $(window).on('load', function() {
        $('.preloader-wrapper').fadeOut();
        $('body').removeClass('preloader-site');
    });
</script>
</body>

</html>