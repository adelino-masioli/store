<div class="row shopcart">

    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <h1 class="customer-title">Detalhes do pedido #CODE1234 <small class="pull-right order-date"><i class="fa fa-clock-o"></i> 26/08/2018 às 13:10:05</small></h1>

        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped  table-hover table-sm">
                <thead>
                    <tr class="d-flex">
                        <th scope="col" class="text-center col-6 no-border-right text-truncate">NOME DO PRODUTO</th>
                        <th scope="col" class="text-center col-2 no-border-right text-truncate">QUANT.</th>
                        <th scope="col" class="text-center col-2 no-border-right text-truncate">VALOR</th>
                        <th scope="col" class="text-center col-2  text-truncate">SUBTOTAL</th>
                    </tr>
                </thead>

                <tbody>
                <?php $total = 0;?>
                @foreach($order_itens as $row)
                    <tr class="d-flex">
                        <td class="text-left col-6 no-border-right text-truncate">
                            <a href="{{route('frontend-product-detail', [str_slug($row->product_name, '-')])}}">
                            <div class="protuct-shopcart-photo">
                                @if(\App\Models\ProductImage::getCoverImage($row->id))
                                    <img class="rounded-circle img-fluid" src="{{pathMidia('catalog')}}/thumb/{{\App\Models\ProductImage::getCoverImage($row->id)}}" alt="{{$row->product_name}}"  height="100" width="50">
                                @else
                                    <img class="rounded-circle img-fluid" src="{{asset('assets/images/no-photo_150x150.jpg')}}" alt="{{$row->product_name}}" height="100" width="50">
                                @endif
                            </div>
                                <span class="protuct-shopcart-title">{{$row->product_name}}</span>
                            </a>
                        </td>
                        <td class="text-center col-2 d-flex align-items-center justify-content-center no-border-right">{{$row->qty}}</td>
                        <td class="col-2 d-flex flex-row-reverse align-items-center no-border-right">{{money_br($row->price)}}</td>
                        <td class="col-2 d-flex flex-row-reverse align-items-center ">{{money_br($row->price * $row->qty)}}</td>
                    </tr>
                <?php $total += $row->price * $row->qty;?>
                @endforeach

                </tbody>
            </table>

        </div>
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-sm">
                <tfoot>
                    <tr class="d-flex">
                        <th scope="col" class="text-center col col-6 no-border-right text-truncate">DETALHES DO FRETE</th>
                        <th scope="col" class="text-center col col-6 text-truncate">VALOR TOTAL DA COMPRA</th>
                    </tr>
                    <tr class="d-flex">
                        <th scope="col" class="text-center col col-6 no-border-right result-address">
                            <p class="d-none">Rua Araguari, Barro Preto, Belo Horizonte, MG
                                O valor do frete é: <span>R$ 25,21</span> e o prazo
                                de entrega é de até <span>6 dias úteis</span></p>
                        </th>
                        <th scope="col" class="text-center col col-6 d-flex flex-row-reverse align-items-center shopcart-total">
                            R$ {{money_br($total)}}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>


</div><!-- /.row -->