<div class="row">

    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        @component('frontend.blue_theme.components.product_carousel', ['product' => $product]) @endcomponent {{--component carousel--}}
    </div>


    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <div class="product-title">
            <h1>{{$product->name}}</h1>
            <small>código do produto: {{$product->sku}}</small>
        </div>

        <div class="rate">
            @component('frontend.blue_theme.components.rate', ['product' => $product, 'is_rate' => $is_rate, 'rate' => $rate]) @endcomponent {{--component rate--}}
        </div>


        <div class="product-price">
            <div class="promotional-price">de R$ 3.999,00 por</div>
            <div class="full-price">
                R$ {{money_br($product->price)}} <small>à vista</small>
                <span>(Desc. já calculado)</span>
            </div>
        </div>

        <div class="product-btn-buy">
            <a href="{{route('frontend-add-cart', [$product->slug, base64_encode($product->id)])}}" class="btn btn-success btn-flat btn-buy">COMPRAR</a>
            <a href="#go-quote-tab" class="btn btn-secondary btn-flat btn-buy">ORÇAMENTO</a>
            @if($config_site->whatsapp)
                <a href="https://api.whatsapp.com/send?phone=55{{only_number($config_site->whatsapp)}}" target="_blank" class="btn btn-outline-secondary btn-flat btn-buy"><i class="fa fa-whatsapp"></i> WHATSAPP</a>
            @endif
        </div>

        @component('frontend.blue_theme.components.transport', ['product' => $product]) @endcomponent {{--component transport--}}

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-description" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out" id="tabproduct">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Descrição</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="quote-tab" data-toggle="tab" href="#quote" role="tab" aria-controls="quote" aria-selected="true">Solicitar Orçamento</a>
            </li>
        </ul>
        <div class="tab-content" id="productTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                {!! $product->description !!}
            </div>

            <div class="tab-pane fade" id="quote" role="tabpanel" aria-labelledby="quote-tab">
                @include('frontend.blue_theme.partials.quote_form')<!-- quote-->
            </div>
        </div>
    </div>



</div><!-- /.row -->