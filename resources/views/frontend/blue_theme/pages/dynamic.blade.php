@extends('frontend.blue_theme.template.layout')

@section('title', $config_site->name .' - '.$page_display->title )

@section('content')
    <main role="main">

        @if($page_display->banner)
            <section class="product-banner" style="background-image: url('{{pathMidia('pages')}}/{{$page_display->banner}}');" alt="{{$page_display->title}}">
                <h1 class="product-banner-title text-uppercase">{{$page_display->title}}</h1>
            </section>
        @else
            <section class="product-banner" style="background: #f1f1f1;" alt="{{$page_display->title}}">
                <h1 class="product-banner-title_ text-uppercase">{{$page_display->title}}</h1>
            </section>
        @endif

        <div class="container internal-pages">
            @component('frontend.blue_theme.components.breadcrumb')
                <li class="breadcrumb-item active" aria-current="page">{{$page_display->title}}</li>
            @endcomponent {{--component breadcrumb--}}

            <h1 class="title-internal-page">{{$page_display->summary}}</h1>
            {!! $page_display->text !!}
        </div>


    @include('frontend.blue_theme.partials.newsletter')<!-- newsletter-->


    @include('frontend.blue_theme.partials.maps')<!-- maps-->


    @include('frontend.blue_theme.partials.footer')<!-- partial footer-->
    </main>
@endsection