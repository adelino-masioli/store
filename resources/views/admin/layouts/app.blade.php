<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name_admin', 'Administrador') }}</title>
    <link rel="icon" href="{{asset('assets/images')}}/favicon.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/iCheck/all.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="{{asset('assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/toast/jquery.toast.min.css')}}">

    <link href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/confirm/jquery-confirm.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini skin-black sidebar-collapse">
    {{-- preloader-wrapper --}}
    <div class="preloader-wrapper">
        <div class="preloader">
            <img src="{{asset('assets/images/preload.gif')}}" alt="Preloader">
        </div>
    </div>

    <div class="wrapper">
        @include('admin.layouts.nav')
        @include('admin.layouts.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('admin.layouts.footer')
    </div>


    <!-- jQuery 3 -->
    <script src="{{asset('assets/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('assets/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('assets/admin/bower_components/chart.js/Chart.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>

    <script src="{{asset('assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/plugins/toast/jquery.toast.min.js')}}"></script>

    <script src="{{asset('assets/admin/plugins/iCheck/icheck.min.js')}}"></script>

    <script src="{{asset('assets/admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap-filestyle-2.1.0/bootstrap-filestyle.min.js')}}"></script>

    <script src="{{ asset('assets/plugins/mask/jquery.mask.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/dist/lang/summernote-pt-BR.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/form/jquery.form.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/confirm/jquery-confirm.min.js') }}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>

@stack('scripts')
</body>
</html>