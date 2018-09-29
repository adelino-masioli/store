@if(isset($payment))
    <a href="javascript:void(0)" class="btn btn-sm bg-gray btn-flat" disabled><i class="fa fa-check-circle"></i> Salvar Pedido</a>
    <a href="{{route('order-edit', [base64_encode($order->id)])}}" class="btn btn-sm bg-yellow btn-flat"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
@else
    <a href="javascript:void(0)" class="btn btn-sm bg-green btn-flat" onclick="formSubmit('#formsubmit');"><i class="fa fa-check-circle"></i> Salvar Pedido</a>

    @if(isset($items) && $items->count() > 0)
        <a href="{{route('order-next-confirm', [base64_encode($order->id)])}}" class="btn btn-sm bg-yellow btn-flat">Avançar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    @else
        <a href="javascript:void(0)" class="btn btn-sm bg-gray btn-flat" disabled>Avançar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    @endif
@endif



@if(isset($payment))
    <a href="{{route('order-next-finish', [base64_encode($order->id)])}}" class="btn btn-sm bg-green btn-flat">Confirmar pedito e finalizar <i class="fa fa-check-circle" aria-hidden="true"></i></a>
@else
    <a href="javascript:void(0)" class="btn btn-sm bg-gray btn-flat" disabled>Confirmar pedito <i class="fa fa-dollar" aria-hidden="true"></i></a>
@endif