@extends('frontend.acqua.template.layout')

@section('title', 'Sobre | '.$page->title)

@section('content')
<!-- Section service -->
<section class="pfblock page-service">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('frontend.acqua.components.breadcrumb')
                    <li class="active">{!! $page->title !!}</li>
                @endcomponent
            </div>

            <div class="col-md-12 full-wxs">
                <div class="grid wow zoomIn" style="padding-bottom:20px;padding-top:15px;">
                    <h1 ><strong>{!! $page->summary !!}</strong></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 full-wxs">
                <div class="grid wow zoomIn" style="padding-bottom:0px;">
                    {!! $page->text!!}
                </div>
            </div>
        </div>
    </div><!-- .contaier -->
</section>
<!-- Section service end -->


<section class="pfblock" style="background: #f1f1f1;padding-top:22px;">
    @include('frontend.acqua.partials.partial-form-newsletter')
</section>

@endsection