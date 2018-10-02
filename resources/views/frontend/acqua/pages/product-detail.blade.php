@extends('frontend.acqua.template.layout')

@section('title', 'Produtos | '.$config_site->name)

@section('content')

<!-- Section one -->
<section class="pfblock product-detail" style="background: #f1f1f1;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @component('frontend.acqua.components.breadcrump')
                    <li><a href="{{route('frontend-products')}}">{{$page->title}}</a></li>
                    <li class="active">{{$product->name}}</li>
                @endcomponent
            </div>


            @if(\App\Models\ProductImage::getCoverImage($product->id))
            <div class="col-xs-6 col-sm-6 col-md-6 full-wxs">
                <div class="grid wow zoomIn">
                    <img src="{{pathMidia('catalog')}}/{{\App\Models\ProductImage::getCoverImage($product->id)}}" alt="{{$product->name}}">
                    <p><small>{{$product->name}}</small></p>
                </div>
            </div>
            @endif
            <div class="col-xs-6 col-sm-6 col-md-6 full-wxs">
                <div class="grid wow zoomIn">
                    <h1>{{$product->name}}</h1>

                    <form action="{{route('post-quote')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden"  name="product_id" value="{{base64_encode($product->id)}}">
                        <input type="hidden"  name="product_name" value="{{$product->name}}">
                        <div class="form-group">
                            <label for="txtname">Nome *</label>
                            <input type="text" class="form-control input-lg" id="txtname" name="name" placeholder="Informe seu nome" required>
                        </div>
                        <div class="form-group">
                            <label for="txtemail">E-mail *</label>
                            <input type="email" class="form-control input-lg" id="txtemail" name="email" placeholder="Informe seu e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="txtphone">Telefone *</label>
                            <input type="text" class="form-control input-lg" id="txtphone" name="phone" placeholder="Informe seu telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="txtabout">Assunto *</label>
                            <input type="text" class="form-control input-lg" id="txtabout" name="about" placeholder="Informe o assunto" required>
                        </div>
                        <div class="form-group">
                            <label for="txtmessage">Mensagem *</label>
                            <textarea class="form-control input-lg" id="txtmessage" name="description" placeholder="Informe a mensagem" required></textarea>
                        </div>


                        <button type="submit" class="btn btn-lg btn-block btn-blue">Enviar</button>
                        <p><small>(*) Informações obrigatórias</small></p>

                        <div class="row">
                            <div class="col-md-12">
                                @include('frontend.acqua.messages.messages_quote')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <legend>Detalhes do produto</legend>
                {!! $product->description !!}
            </div>
        </div>


    </div><!-- .contaier -->
</section>
<!-- Section one end -->



<section class="pfblock" style="background: #f1f1f1;">
    @include('frontend.acqua.partials.partial-form-newsletter')
</section>

@endsection