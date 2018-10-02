@extends('frontend.acqua.template.layout')

@section('title', $config_site->name)

@section('content')
@include('frontend.acqua.partials.partial-banner')


<!-- Section one -->
<section class="pfblock" style="background: #f1f1f1;">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 full-wxs">
                <div class="grid wow zoomIn">
                    <figure class="effect-bubba" style="background-image:url('{{asset('templates/'.$config_site->theme)}}/assets/images/box_1.jpg');">
                        <figcaption>
                            <div class="figcaption-content">
                                <h2 class="wow fadeInUp">Conheça sobre nós</h2>
                                <p class="wow fadeInUp">Há 17 anos a Acquaquality Sistemas de Tratamento de Água Ltda., tem como atividade principal...</p>
                                <a href="{{route('frontend-about')}}" class="btn btn-blue btn-box wow fadeInUp">SAIBA MAIS</a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 full-wxs">
                <div class="grid wow zoomIn">
                    <figure class="effect-bubba" style="background-image:url('{{asset('templates/'.$config_site->theme)}}/assets/images/box_2.jpg');">
                        <figcaption>
                            <div class="figcaption-content">
                                <h2 class="wow fadeInUp">Produtos</h2>
                                <p class="wow fadeInUp">Acesse nossos produtos e solicite um orçamento</p>
                                <a href="{{route('frontend-products')}}" class="btn btn-blue btn-box wow fadeInUp">SAIBA MAIS</a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 full-wxs">
                <div class="grid wow zoomIn">
                    <figure class="effect-bubba" style="background-image:url('{{asset('templates/'.$config_site->theme)}}/assets/images/box_3.jpg');">
                        <figcaption style="padding-top: 15px;">
                            <img style="margin: auto;" width="80" src="{{asset('templates/'.$config_site->theme)}}/assets/images/services.jpg" alt="Assistência Técnica"/>
                            <div class="figcaption-content">
                                <h2 class="wow fadeInUp">Assistência Técnica</h2>
                                <p class="wow fadeInUp">A AcquaQuality realiza assistência técnica com manutenção corretiva e preventiva em...</p>
                                <a href="{{route('frontend-service')}}" class="btn btn-blue btn-box wow fadeInUp">ACESSAR</a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div><!-- .contaier -->
</section>
<!-- Section one end -->



<section class="pfblock" style="background: #f1f1f1;">
    @include('frontend.acqua.partials.partial-form-newsletter')
</section>

@include('frontend.acqua.partials.partial-area')

<section  class="pfblock contactblock">
    @include('frontend.acqua.partials.partial-form-contact')
</section>
@endsection