@extends('frontend.acqua.template.layout')

@section('title', 'Produtos | '. $search .' | '.$config_site->name)

@section('content')

<!-- Section one -->
<section class="pfblock" style="background: #f1f1f1;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('frontend.acqua.components.breadcrumb')
                    <li class="active">{{$page->title}}</li>
                @endcomponent
            </div>

            <h1 class="text-center title-page-result">{{$products->count()}} @if($products->count() > 1) resultados encontrados @else resultado encontrado @endif para: <strong>{{$search}}</strong></h1>

           @if($products->count() > 0)
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
            @else
                <div class="col-xs-12 col-sm-12 col-md-12 full-wxs page-not-found">
                    <h1 class="text-center title-page-result">Nenhum resultado encontrado para: <strong>{{$search}}</strong></h1>

                    <div class="form-search-page-not-found">
                        <form  action="{{route('frontend-product-result')}}" method="post">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Informe sua buscar" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-blue" type="submit"><i class="fa fa-search"></i> Buscar</button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>

                    <p class="text-center">
                        <small>Informe acima sua nova busca, ou clique <a href="{{route('frontend-home')}}" class="text-info"><strong>AQUI</strong></a> para voltar para a página principal.</small>
                    </p>
                </div>
            @endif

        </div>
    </div><!-- .contaier -->
</section>
<!-- Section one end -->



<section class="pfblock" style="background: #f1f1f1;">
    @include('frontend.acqua.partials.partial-form-newsletter')
</section>

@endsection