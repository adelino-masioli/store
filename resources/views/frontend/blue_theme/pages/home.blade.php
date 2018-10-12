@extends('frontend.blue_theme.template.layout')

@section('title', $config_site->name)

@section('content')
    <main role="main">
        @include('frontend.blue_theme.partials.banner')<!-- banner-->

        @include('frontend.blue_theme.partials.minibanner')<!-- minibanner-->


        @include('frontend.blue_theme.partials.product_featured')<!-- product featured-->


        @include('frontend.blue_theme.partials.newsletter')<!-- newsletter-->


        @include('frontend.blue_theme.partials.maps')<!-- maps-->


        <section class="contactfooter">
            @include('frontend.blue_theme.partials.contact_box')<!-- contact box-->
            @include('frontend.blue_theme.partials.contact_form')<!-- contact form-->
        </section>


        @include('frontend.blue_theme.partials.footer')<!-- partial footer-->
    </main>
@endsection