<!-- Scroll to top -->
<div class="scroll-up">
    <a href="javascript:void(0);" onclick="goTo('#preloader');"><i class="fa fa-angle-up"></i></a>
</div>
<!-- Scroll to top end-->

<!-- Javascript files -->
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/jquery-1.11.1.min.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/jquery.parallax-1.1.3.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/imagesloaded.pkgd.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/jquery.sticky.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/smoothscroll.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/wow.min.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/jquery.easypiechart.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/waypoints.min.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/jquery.cbpQTRotator.js"></script>
<script src="{{asset('templates/'.$config_site->theme)}}/assets/js/custom.js"></script>
@stack('scripts')
</body>
</html>