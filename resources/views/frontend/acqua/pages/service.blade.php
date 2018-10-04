@extends('frontend.acqua.template.layout')

@section('title', $page->title.' | '.$config_site->name)

@section('content')
<!-- Section service -->
<section class="pfblock service-image-back" style="background-image: url('{{pathMidia('pages')}}/{{$page->banner}}');"></section>
<section class="pfblock page-service">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('frontend.acqua.components.breadcrump')
                    <li class="active">{{$page->title}}</li>
                @endcomponent
            </div>

            @if($page->summary)
            <div class="col-md-12 full-wxs">
                <div class="grid wow zoomIn" style="padding-bottom:20px;padding-top:0px;text-align: initial;">
                    <h1><strong>{{$page->summary}}</strong></h1>
                </div>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 full-wxs">
                <div class="grid wow zoomIn" style="padding-bottom:0px;text-align: initial;">
                    {!! $page->text !!}
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