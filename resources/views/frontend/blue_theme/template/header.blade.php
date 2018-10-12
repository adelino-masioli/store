<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')"/><meta name="description" content="">
    <meta name="author" content="Junior Ferreira - http://www.juniorferreira.com.br">
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:url" content="{{url('/')}}"/>
    <meta property="og:site_name" content="Acquaquality"/>

    <meta property="og:image" content="{{asset('templates/'.$config_site->theme)}}/assets/images/share.png"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="541"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="@yield('description')"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:image" content="{{asset('templates/'.$config_site->theme)}}/assets/images/share.png"/>

    <link rel="icon" href="{{asset('templates/'.$config_site->theme)}}/assets/images/favicon.png" sizes="32x32"/>

    <!-- CSS -->
    <link href="{{asset('templates/'.$config_site->theme)}}/assets/css/styles.min.css" rel="stylesheet" media="screen">

    @stack('styles')

</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"></div>
</div>