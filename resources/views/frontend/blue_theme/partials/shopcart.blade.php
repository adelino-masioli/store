<div class="row shopcart">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped  table-hover table-sm">
                <thead>
                    <tr class="d-flex">
                        <th scope="col" class="text-center col-sm-5 col-md-5 col-lg-8 no-border-right text-truncate">NOME DO PRODUTO</th>
                        <th scope="col" class="text-center col-sm-2 col-md-2 col-lg-1 no-border-right text-truncate">QUANT.</th>
                        <th scope="col" class="text-center col-sm-2 col-md-2 col-lg-1 no-border-right text-truncate">VALOR</th>
                        <th scope="col" class="text-center col-sm-2 col-md-2 col-lg-1 no-border-right text-truncate">SUBTOTAL</th>
                        <th scope="col" class="text-center col-1 text-truncate">EXCLUIR</th>
                    </tr>
                </thead>

                <tbody>
                <?php $total = 0;?>
                @foreach(Cart::content() as $row)
                    <tr class="d-flex">
                        <td class="text-left col-sm-5 col-md-5 col-lg-8 no-border-right text-truncate">
                            <a href="#">
                            <div class="protuct-shopcart-photo">
                                @if($row->options->has('image') && $row->options->image)
                                    <img class="rounded-circle img-fluid" src="{{pathMidia('catalog')}}/thumb/{{$row->options->image}}" alt="{{$row->name}}" height="100" width="50">
                                @else
                                    <img class="rounded-circle img-fluid" src="{{asset('assets/images/no-photo_150x150.jpg')}}" alt="{{$row->name}}" height="100" width="50">
                                @endif
                            </div>
                                <span class="protuct-shopcart-title">{{$row->name}}</span>
                            </a>
                        </td>
                        <td class="text-center col-sm-2 col-md-2 col-lg-1 d-flex align-items-center justify-content-center no-border-right">
                            <form action="{{route('frontend-update-cart', [str_slug($row->name, '-')])}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="rowid" value="{{base64_encode($row->rowId)}}">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="qty" id="qty_{{$row->rowId}}" value="{{$row->qty}}" onKeyDown="onlyNumber('#qty_{{$row->rowId}}');">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="btnconsult"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="col-sm-2 col-md-2 col-lg-1 d-flex flex-row-reverse align-items-center no-border-right">{{money_br($row->price)}}</td>
                        <td class="col-sm-2 col-md-2 col-lg-1 d-flex flex-row-reverse align-items-center no-border-right">{{money_br($row->price * $row->qty)}}</td>
                        <td class="col-1 d-flex  align-items-center justify-content-center">
                            <a href="{{route('frontend-remove-cart', [str_slug($row->name, '-'), base64_encode($row->rowId)])}}" class="link-trash"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    <?php $total += $row->price * $row->qty;?>
                @endforeach
                </tbody>
            </table>

        </div>

        @if(Cart::count() == 0)
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-sm">
                <tbody>
                    <tr class="d-flex">
                        <td scope="col" class="text-center col col-12 no-border-right text-truncate">Nenhum produto foi adicionado ao carrinho. Clique <a href="{{route('frontend-products')}}">aqui</a> para comprar.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif

        @if(Cart::count() > 0)
        <div class="table-responsive">

        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-sm">
                <tfoot>
                    <tr class="d-flex">
                        <th scope="col" class="text-center col col-3 no-border-right text-truncate">CÁLCULO DE FRETE</th>
                        <th scope="col" class="text-center col col-3 no-border-right text-truncate">CUPOM DESCONTO</th>
                        <th scope="col" class="text-center col col-6 text-truncate">VALOR TOTAL DA COMPRA</th>
                    </tr>
                    <tr class="d-flex">
                        <th scope="col" class="text-center col col-3 no-border-right">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Insira seu CEP" name="zipcode" id="zipcode" aria-label="Insira seu CEP"  aria-describedby="btnconsult" maxlength="8">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="btnconsult"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="text-center col col-3 no-border-right">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Insira o código" name="discount_coupon" id="discount_coupon" aria-label="Insira o código"  aria-describedby="btnconsultcode">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="btnconsultcode">OK</button>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="text-center col col-6 d-flex flex-row-reverse align-items-center shopcart-total">
                            R$ {{money_br($total)}}
                        </th>
                    </tr>

                    <tr class="d-flex">
                        <th scope="col" class="text-left col col-3 no-border-right  result-address">
                            <p>Rua Araguari, Barro Preto, Belo Horizonte, MG
                                O valor do frete é: <span>R$ 25,21</span> e o prazo
                                de entrega é de até <span>6 dias úteis</span></p>
                        </th>
                        <th scope="col" class="text-center col col-3 d-flex align-items-center justify-content-center no-border-right">
                            <a href="{{route('frontend-products')}}" class="btn btn-outline-secondary btn-flat text-truncate"><i class="fa fa-angle-double-left" aria-hidden="true"></i> CONTINUAR COMPRANDO</a>
                        </th>
                        <th scope="col" class="text-center col col-6 d-flex flex-row-reverse align-items-center">
                            <a href="{{route('frontend-finish-cart', [md5(date('H:i:s'))])}}" class="btn btn-danger btn-flat text-truncate">CONCLUIR SUA COMPRA AGORA <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif

    </div>


</div><!-- /.row -->