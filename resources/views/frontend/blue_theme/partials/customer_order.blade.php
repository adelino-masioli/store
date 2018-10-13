<div class="row shopcart">

    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">

        <h1 class="customer-title">Meus pedidos</h1>
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped  table-hover table-sm">
                <thead>
                <tr class="d-flex">
                    <th scope="col" class="text-center col no-border-right text-truncate">DATA</th>
                    <th scope="col" class="text-center col no-border-right text-truncate">STATUS</th>
                    <th scope="col" class="text-center col no-border-right text-truncate">TOTAL</th>
                    <th scope="col" class="text-center col text-truncate">AÇÃO</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="d-flex">
                        <td class="text-left col no-border-right text-truncate d-flex align-items-center justify-content-center">{{date_br($order->created_at)}}</td>
                        <td class="col d-flex align-items-center justify-content-center no-border-right">{{$order->status->status}}</td>
                        <td class="col d-flex flex-row-reverse align-items-center no-border-right">{{money_br($order->total)}}</td>
                        <td class="col d-flex  align-items-center justify-content-center">
                            <a href="{{route('frontend-my-account-order-detail', [base64_encode($order->id)])}}"><i class="fa fa-search text-info"></i> Visualizar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div><!-- /.row -->