<div class="container product-list">

    <div class="row">

        <div class="col-lg-3 sidebar">
            <div class="title-sidebar"><i class="fa fa-list"></i> DEPARTAMENTOS</div>
            <ul class="sidebar-list">
                @foreach($categories as $category)
                    @if(\App\Models\SubCategory::subcategory($category->id)->count() > 0)
                        <li class="category">
                            <a href="{{route('frontend-product-categories', [$category->slug])}}"><i class="fa fa-angle-right" aria-hidden="true"></i> {{$category->name}}</a>
                            <ul class="sidebar-list-subcategory">
                               @foreach(\App\Models\SubCategory::subcategory($category->id) as $subcategory)
                                    <li><a href="{{route('frontend-product-categories', [$subcategory->slug])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> {{$subcategory->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li><a href="{{route('frontend-product-categories', [$category->slug])}}"><i class="fa fa-angle-right" aria-hidden="true"></i> {{$category->name}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 products-list">
            @if($products->total() == 0)
                <h1 class="text-center">Nenhum produto cadastrado nesta categoria.</h1>
                <h6 class="text-center">Favor selecionar outro departamento no menu ao lado.</h6>
                <p class="text-center">Ou clique <a href="{{route('frontend-home')}}">aqui</a> para voltar à página principal.</p>
            @else
                <div class="row">
                    <div class="nav-product-list nav-product-list-top col-md-12">
                        @component('frontend.blue_theme.components.pagination', ['products' => $products]) @endcomponent {{--component pagination--}}
                        @component('frontend.blue_theme.components.filter', ['url'=>'frontend-products']) @endcomponent {{--component filter--}}
                    </div>
                </div>

                <div class="row">
                    @foreach($products as $product)
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 product" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
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
                </div>


                <div class="row">
                    <div class="nav-product-list col-md-12">
                            @component('frontend.blue_theme.components.pagination', ['products' => $products]) @endcomponent {{--component pagination--}}
                            @component('frontend.blue_theme.components.filter', ['url'=>'frontend-products']) @endcomponent {{--component filter--}}
                    </div>
                </div>
            @endif

        </div>

    </div><!-- /.row -->


</div><!-- /.container -->