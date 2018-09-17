<!-- Header Main -->
<div class="header_main">
        <div class="container">
            <div class="row">

                <!-- Logo -->
                <div class="col-lg-3 col-sm-3 col-3 order-1">
                    <div class="logo_container">
                        <div class="logo"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('templates/'.config('app.template'))}}/images/brand_sprintem.png" alt="{{$configuration['name']}}"></a></div>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-lg-9 col-12 order-lg-2 order-3 text-lg-left text-right">
                    <div class="header_search">
                        <div class="header_search_content">
                            <div class="header_search_form_container">
                                <form action="{{url('busca')}}" method="post" class="header_search_form clearfix">
                                    {{ csrf_field() }}
                                    <input type="search" required="required" class="header_search_input" name="search" placeholder="Informe sua busca...">
                                    <div class="custom_dropdown d-none">
                                        <div class="custom_dropdown_list">
                                            <span class="custom_dropdown_placeholder clc">All Categories</span>
                                            <i class="fas fa-chevron-down"></i>
                                            <ul class="custom_list clc">
                                                <li><a class="clc" href="#">All Categories</a></li>
                                                <li><a class="clc" href="#">Computers</a></li>
                                                <li><a class="clc" href="#">Laptops</a></li>
                                                <li><a class="clc" href="#">Cameras</a></li>
                                                <li><a class="clc" href="#">Hardware</a></li>
                                                <li><a class="clc" href="#">Smartphones</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('templates/'.config('app.template'))}}/images/search.png" alt=""></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wishlist -->
                <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right d-none">
                    <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                        <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist_icon"><img src="{{asset('templates/'.config('app.template'))}}/images/heart.png" alt=""></div>
                            <div class="wishlist_content">
                                <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                <div class="wishlist_count">115</div>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="cart">
                            <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                <div class="cart_icon">
                                    <img src="{{asset('templates/'.config('app.template'))}}/images/cart.png" alt="">
                                    <div class="cart_count"><span>10</span></div>
                                </div>
                                <div class="cart_content">
                                    <div class="cart_text"><a href="#">Cart</a></div>
                                    <div class="cart_price">$85</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>