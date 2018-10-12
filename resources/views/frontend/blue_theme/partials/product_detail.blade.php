<div class="row">

    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <div id="productcarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#productcarousel" data-slide-to="0" class="active"></li>
                <li data-target="#productcarousel" data-slide-to="1"></li>
                <li data-target="#productcarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <?php $i = 0; ?>
                @if(\App\Models\ProductImage::getImages($product->id)->count() > 0)
                    @foreach(\App\Models\ProductImage::getImages($product->id) as $image)
                        <div class="carousel-item @if($i==0) active @endif">
                            @if($image->image))
                                <img class="first-slide img-fluid" src="{{pathMidia('catalog')}}/{{$image->image}}" alt="{{$image->name}}">
                            @else
                                <img class="first-slide img-fluid" src="{{asset('assets/images/no-photo_500x500.jpg')}}" alt="{{$image->name}}">
                            @endif
                        </div>
                        <?php $i++; ?>
                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img class="first-slide img-fluid" src="{{asset('assets/images/no-photo_500x500.jpg')}}" alt="{{$product->name}}">
                    </div>
                @endif
            </div>
            <a class="carousel-control-prev" href="#productcarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#productcarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <div class="product-title">
            <h1>{{$product->name}}</h1>
            <small>código do produto: {{$product->sku}}</small>
        </div>
        <div class="rate">
            <ul>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
            </ul>
            <span>(0 Avaliações)</span>
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


        <div class="consult-transport d-none">
            <label for="consult">Consulte o frete</label>
            <div class="row">
                <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <input type="text" class="form-control" placeholder="30140" name="zipcode" id="zipcode" aria-label="30140" onKeyDown="onlyNumber('#zipcode');" maxlength="5" autofocus >
                </div>
                <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="060" name="zipcode2" id="zipcode2" aria-label="060" onKeyDown="onlyNumber('#zipcode');" aria-describedby="btnconsult" maxlength="3">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btnconsult"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="result-consult-transport">
                <p class="d-none">Para saber o prazo de entrega/postagem e o valor do frete, digite o seu CEP nos campos acima. O prazo pode variar dependendo da sua forma de entrega/postagem.</p>
                <p class="d-none">Disponibilidade: <span>Até 6 dias úteis</span> para Belo Horizonte, MG</p>
                <p class="d-none">O valor do frete deste produto é: <span>R$ 25,21</span></p>

                <p class="alert alert-danger">
                    O CEP selecionado não é atendido pelos Correios para entrega no domicilio.
                    Será necessário retirar a entrega na agência dos Correios. Caso queira trocar o CEP, validamos novamente.
                </p>
            </div>
        </div>

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