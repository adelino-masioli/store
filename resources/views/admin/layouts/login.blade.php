<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name_admin', 'Administrador') }}</title>
    <link rel="icon" href="{{asset('images')}}/favicon.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('Backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('Backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('Backend/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('Backend/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('Backend/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{asset('Backend/plugins/iCheck/square/blue.css')}}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="{{asset('Backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    @stack('styles')
</head>
<body class="hold-transition login-page">
    {{-- preloader-wrapper --}}
    <div class="preloader-wrapper">
        <div class="preloader">
            <img src="{{asset('images/preload.gif')}}" alt="Preloader">
        </div>
    </div>

    <div class="wrapper">
        <div class="login-box">
            @yield('content')
        </div>
    </div>


    <!-- jQuery 3 -->
    <script src="{{asset('Backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('Backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- iCheck  -->
    <script src="{{asset('Backend/plugins/iCheck/icheck.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            $('.checkbox').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });

            var Body = $('body');
            Body.addClass('preloader-site');
        });

        $(window).on('load', function() {
            $('.preloader-wrapper').fadeOut();
            $('body').removeClass('preloader-site');
        });
    </script>

@stack('scripts')
</body>
</html>