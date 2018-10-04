<a href="{{route('orders-financial')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat"><i class="fa fa-list"></i> Listagem de Pedidos</a>
<a href="{{route('order-next-payment-confirm', [base64_encode($order->id)])}}" class="btn btn-sm bg-green btn-flat">Confirmar pedido e finalizar <i class="fa fa-check-circle" aria-hidden="true"></i></a>
@if($order->status_id != statusOrder('canceled'))
    <a target="_blank" href="{{route('order-timeline-show', [base64_encode($order->id)])}}" class="btn btn-sm bg-green"><i class="fa fa-align-left"></i> Timeline do pedido</a>
@endif