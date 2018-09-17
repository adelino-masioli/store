<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{asset('templates/'.config('app.template').'/images')}}/favicon.png">
<link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/bootstrap4/bootstrap.min.css">
<link href="{{asset('templates/'.config('app.template'))}}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/plugins/slick-1.8.0/slick.css">
@stack('styles')

</head>
<body>
{{-- preloader-wrapper --}}
<div class="preloader-wrapper">
    <div class="preloader">
        <img src="{{asset('templates/'.config('app.template').'/images/preload.gif')}}" alt="{{$configuration['name']}}}">
    </div>
</div>