@extends('frontend.acqua.template.layout')

@section('title', 'Produtos | '.$config_site->name)

@section('content')

<!-- Section one -->
<section class="pfblock product-image-back text-center" style="background-image: url('{{pathMidia('pages')}}/{{$page->banner}}');">
    <h1 class="text-uppercase">{{$page->title}}</h1>
</section>
<section class="pfblock" style="background: #f1f1f1;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('frontend.acqua.components.breadcrumb')
                    <li class="active">{{$page->title}}</li>
                @endcomponent
            </div>

           @foreach($products as $product)
            <div class="col-xs-4 col-sm-4 col-md-4 full-wxs">
                <div class="grid wow zoomIn" style="padding-top:0px;">
                    <figure class="effect-bubba"
                            @if(\App\Models\ProductImage::getCoverImage($product->id))
                            style="background-image: url('{{pathMidia('catalog')}}/{{\App\Models\ProductImage::getCoverImage($product->id)}}');"
                            @endif
                    >
                        <figcaption>
                            <div class="figcaption-content product-name-list">
                                <p class="wow fadeInUp">{{$product->name}}</p>
                                <a href="{{route('frontend-product-detail', [$product->slug])}}" class="btn btn-blue btn-box wow fadeInUp"><i class="fa fa-search"></i> SAIBA MAIS</a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
            @endforeach

        </div>
    </div><!-- .contaier -->
</section>
<!-- Section one end -->



<section class="pfblock" style="background: #f1f1f1;">
    @include('frontend.acqua.partials.partial-form-newsletter')
</section>

@endsection