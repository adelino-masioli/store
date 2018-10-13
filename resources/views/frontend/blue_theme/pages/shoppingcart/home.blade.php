@extends('frontend.blue_theme.template.layout')

@section('title', $config_site->name .' - Carrinho')

@section('content')
<main role="main">


    <div class="container internal-pages">
        @component('frontend.blue_theme.components.breadcrumb')
            <li class="breadcrumb-item"><a href="{{route('frontend-products')}}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
         @endcomponent {{--component breadcrumb--}}

        <div class="show-alert">
            @if (Session::has('success_message') || Session::has('error_message'))
                @include('frontend.blue_theme.messages.messages')
            @endif
        </div>

        @include('frontend.blue_theme.partials.shopcart')<!-- product detail-->
    </div>


    @include('frontend.blue_theme.partials.newsletter')<!-- newsletter-->


    @include('frontend.blue_theme.partials.maps')<!-- maps-->


    <section class="contactfooter">
    @include('frontend.blue_theme.partials.contact_box')<!-- contact box-->
    @include('frontend.blue_theme.partials.contact_form')<!-- contact form-->
    </section>


@include('frontend.blue_theme.partials.footer')<!-- partial footer-->
</main>
@endsection