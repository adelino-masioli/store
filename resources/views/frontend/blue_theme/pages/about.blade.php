@extends('frontend.blue_theme.template.layout')

@section('title', $config_site->name .' - Sobre' )

@section('content')
    <main role="main">

        <section class="product-banner" style="background-image: url('{{pathMidia('pages')}}/{{$page_display->banner}}');" alt="Sobre">
            <h1 class="product-banner-title">SOBRE</h1>
        </section>

        <div class="container internal-pages">
            @component('frontend.blue_theme.components.breadcrumb')
                <li class="breadcrumb-item active" aria-current="page">Sobre</li>
            @endcomponent {{--component breadcrumb--}}

            <h1 class="title-internal-page">{{$page_display->summary}}</h1>
            {!! $page_display->text !!}
        </div>


    @include('frontend.blue_theme.partials.newsletter')<!-- newsletter-->


    @include('frontend.blue_theme.partials.maps')<!-- maps-->


    @include('frontend.blue_theme.partials.footer')<!-- partial footer-->
    </main>
@endsection