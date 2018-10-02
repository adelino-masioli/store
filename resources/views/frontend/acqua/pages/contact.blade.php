@extends('frontend.acqua.template.layout')

@section('title', 'Contato | '.$config_site->name)

@section('content')

    <section class="pfblock">
        @include('frontend.acqua.partials.partial-form-contact')
    </section>

    <section class="pfblock" style="background: #f1f1f1;padding-top:22px;">
        @include('frontend.acqua.partials.partial-form-newsletter')
    </section>

@endsection