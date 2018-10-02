<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="Soluções no Tratamento de água abrandada, desmineralizada e Potável, há 16 anos oferecendo a água de qualidade que você precisa."/><meta name="description" content="">
    <meta name="author" content="Junior Ferreira - http://www.juniorferreira.com.br">
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="AcquaQuality -Tratamento de Água Abrandada, Desmineralizada e Potável"/>
    <meta property="og:description" content="Soluções no Tratamento de água abrandada, desmineralizada e Potável, há 16 anos oferecendo a água de qualidade que você precisa."/>
    <meta property="og:url" content="{{url('/')}}"/>
    <meta property="og:site_name" content="Acquaquality"/>

    <meta property="og:image" content="{{asset('templates/'.$config_site->theme)}}/assets/images/acquaquality.png"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="541"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="Soluções no Tratamento de água abrandada, desmineralizada e Potável, há 16 anos oferecendo a água de qualidade que você precisa."/>
    <meta name="twitter:title" content="AcquaQuality -Tratamento de Água Abrandada, Desmineralizada e Potável"/>
    <meta name="twitter:image" content="{{asset('templates/'.$config_site->theme)}}/assets/images/acquaquality.png"/>

    <link rel="icon" href="{{asset('templates/'.$config_site->theme)}}/assets/images/favicon.png" sizes="32x32"/>

    <!-- CSS -->
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/css/simple-line-icons.css" rel="stylesheet" media="screen">
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/css/animate.css" rel="stylesheet">

    <!-- Custom styles CSS -->
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/css/style.css" rel="stylesheet" media="screen">
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/css/responsive.css" rel="stylesheet" media="screen">

    <script src="{{asset('templates/'.$config_site->theme)}}/assets/js/modernizr.custom.js"></script>

    @stack('styles')

</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"></div>
</div>