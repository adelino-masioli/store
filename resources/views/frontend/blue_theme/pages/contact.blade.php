@extends('frontend.blue_theme.template.layout')

@section('title', $config_site->name .' - Fale conosco' )

@section('content')
    <main role="main">

        <section class="product-banner" style="background-image: url('{{pathMidia('pages')}}/{{$page->banner}}');" alt="Contato">
            <h1 class="product-banner-title">CONTATO</h1>
        </section>

        <div class="container internal-pages">
            @component('frontend.blue_theme.components.breadcrumb')
                <li class="breadcrumb-item active" aria-current="page">Contato</li>
        @endcomponent {{--component breadcrumb--}}

        @include('frontend.blue_theme.partials.contact_box')<!-- contact box-->

        @include('frontend.blue_theme.partials.contact_form')<!-- contact form-->
        </div>


    @include('frontend.blue_theme.partials.newsletter')<!-- newsletter-->


    @include('frontend.blue_theme.partials.maps')<!-- maps-->


    @include('frontend.blue_theme.partials.footer')<!-- partial footer-->
    </main>
@endsection