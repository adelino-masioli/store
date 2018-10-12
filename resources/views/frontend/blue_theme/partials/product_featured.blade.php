<div class="container product-list">

    <div class="row">
        <div class="col-md-12">
            <ul class="link-produt-list">
                <li data-aos="fade-left" data-aos-delay="50" data-aos-easing="ease-in-out" class="link-produt-list-destak">DESTAQUE</li>
                <li data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out"><a href="{{route('frontend-products')}}" title="Listar todos os produtos">TODOS</a></li>
            </ul>
        </div>
    </div>

    <div class="row">

        @foreach($products as $product)
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 product" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
            <div class="product-photo hvr-overline-from-center">
                @if(\App\Models\ProductImage::getCoverImage($product->id))
                    <img class="rounded-circle" src="{{pathMidia('catalog')}}/thumb/{{\App\Models\ProductImage::getCoverImage($product->id)}}" alt="{{$product->name}}">
                @else
                    <img class="rounded-circle" src="{{asset('assets/images/no-photo_150x150.jpg')}}" alt="{{$product->name}}">
                @endif
            </div>
            <h2 class="product-name">{{$product->name}}</h2>
            <span class="product-price">R$ {{$product->price ? money_br($product->price) : '0,00'}}</span>
            <p>
                <a title="Comprar {{$product->name}}"  href="{{route('frontend-product-detail', $product->slug)}}" class="hvr-icon-buzz-out"><i class="fa fa-shopping-cart hvr-icon"></i> COMPRAR</a>
                <a title="Adicionar {{$product->name}} à minha lista de desejos"  href="#" class="hvr-icon-buzz-out"><i class="fa fa-heart hvr-icon"></i></a>
                <a title="Compartilhar {{$product->name}}"  href="#" class="hvr-icon-buzz-out"><i class="fa fa-share hvr-icon"></i></a>
            </p>
        </div>
        @endforeach

    </div><!-- /.row -->


</div><!-- /.container -->