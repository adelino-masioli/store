<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="d-none d-md-block col-md-3  col-lg-2">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">CATEGORIAS</div>
                        <ul class="sidebar_categories">
                            @foreach($categories as $categorie)
                                <li><a href="{{url('produtos')}}/{{$categorie->slug}}" title="{{$categorie->name}}"><img  src="{{asset('templates/sprintem')}}/images/arraw_right_gray_menu.png" alt="{{$categorie->name}}"> {{$categorie->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">

                <!-- Products -->
                <div class="arrivals_list">

                    <div class="container">
                        <div class="row">
                            <!-- Slider Item -->
                            @foreach($products as $product)
                            <div class="arrivals_slider_item col col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img width="120" src="{{asset('catalog/sprintem')}}/{{\App\Models\ProductImage::getCoverImage($product->id)}}" alt="{{$product->name}}"></div>
                                    <div class="product_content">
                                        <div class="product_price d-none">R$</div>
                                        <div class="product_name"><div>{{str_limit($product->name, 50)}}</div></div>
                                        <div class="product_extrass">
                                            <a href="{{url('produto')}}/{{$product->slug}}" class="product_cart_button">Veja Mais</a>
                                        </div>
                                    </div>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>