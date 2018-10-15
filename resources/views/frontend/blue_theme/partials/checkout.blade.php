<div class="row shopcart">
    <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <div class="row">
            <div class="container content-checkout">
                <div class="header-checkout">
                    <div class="row">
                        <div class="col col-md-1 col-lg-1">
                            <span class="header-checkout-number">1</span>
                        </div>
                        <div class="col col-md-11 col-lg-11">
                            <h1>Informações Pessoais</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 checkout-form">
                    @include('frontend.blue_theme.partials.checkout_form')
                </div>
            </div>
        </div>
    </div>


    <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <div class="row">
            <div class="container content-checkout">
                <div class="header-checkout">
                    <div class="row">
                        <div class="col col-md-1 col-lg-1">
                            <span class="header-checkout-number">2</span>
                        </div>
                        <div class="col col-md-11 col-lg-11">
                            <h1>Entrega e Pagamento</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 checkout-form">
                    @include('frontend.blue_theme.partials.checkout_transport')
                    @include('frontend.blue_theme.partials.checkout_payment')
                </div>
            </div>
        </div>
    </div>


    <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
            <div class="row">
                <div class="container content-checkout">
                    <div class="header-checkout">
                        <div class="row">
                            <div class="col col-md-1 col-lg-1">
                                <span class="header-checkout-number">3</span>
                            </div>
                            <div class="col col-md-11 col-lg-11">
                                <h1>Revisão do Pedido</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-condensed table-sm table-no-border">
                <tbody>
                <?php $total = 0;?>
                <?php $total_transport = 0;?>
                @foreach(Cart::content() as $row)
                    <tr class="d-flex">
                        <td class="d-none col-md-2 col-lg-2 d-md-flex align-items-center justify-content-center">
                            @if($row->options->has('image') && $row->options->image)
                                <img class="rounded-circle img-fluid img-thumbnail" src="{{pathMidia('catalog')}}/thumb/{{$row->options->image}}" alt="{{$row->name}}" height="100" width="50">
                            @else
                                <img class="rounded-circle img-fluid img-thumbnail" src="{{asset('assets/images/no-photo_150x150.jpg')}}" alt="{{$row->name}}" height="100" width="50">
                            @endif
                        </td>
                        <td class="text-left col-xs-12 col-sm-12 col-md-6 col-lg-7 d-md-flex align-items-center justify-content-start">
                            <a href="{{route('frontend-product-detail', [str_slug($row->name)])}}">
                                <span class="protuct-shopcart-title">{{$row->name}}
                                    @if($row->options->transp_price != null)
                                        <small class="d-none d-md-inline-block text-gray"> (Valor do envio: R$ {{moneyReverse($row->options->transp_price) * $row->qty}})</small>
                                    @endif
                                    <small class="text-gray">Qtd: {{$row->qty}}</small>
                                </span>
                            </a>
                        </td>
                        <td class="d-none col-md-4 col-lg-3 d-md-flex flex-row-reverse align-items-center">
                            <strong>R$ {{money_br($row->price)}}</strong>
                        </td>
                    </tr>
                            @if($row->options->transp_price != null)
                                <?php $total_transport +=  moneyReverse($row->options->transp_price) * $row->qty;?>
                                <?php $total += ($row->price * $row->qty) + $total_transport;?>
                            @else
                                <?php $total += $row->price * $row->qty;?>
                            @endif
                @endforeach
                </tbody>
            </table>


            @if(Cart::count() > 0)
                <table class="table table-condensed table-sm table-no-border bg-table-gray">
                    <tfoot>
                    <tr class="d-flex">
                        <td scope="col" class="text-right col-12 no-border-right text-truncate">
                            Envio: <strong>R$ {{money_br($total_transport)}}</strong>
                            <div class="border-decorate-table-bottom"></div>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td scope="col" class="text-right col-12 no-border-right text-truncate">Cupom: <strong>R$ 0,00</strong>
                            <div class="border-decorate-table-bottom"></div>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td scope="col" class="text-right col-12 text-truncate">Valor total:  <strong>R$ {{money_br($total)}}</strong></td>
                    </tr>
                    </tfoot>
                </table>
            @endif


             <div class="row">
                 <div class="col-md-12" style="margin-top: 30px;">
                     <a href="#" class="btn btn-success btn-flat text-truncate btn-block hvr-buzz-out">FINALIZAR PEDIDO <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                 </div>
             </div>
    </div>
</div><!-- /.row -->