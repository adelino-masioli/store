{{ csrf_field() }}
<div class="row">
    <div class="box box-info">
        <div class="box-header"><legend>Dados do cliente</legend></div>
        <table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th class="col-md-1 text-center">CÓDIGO</th>
                <th class="col-md-6 text-center">NOME DO CLIENTE</th>
                <th class="col-md-5 text-center">E-MAIL DO CLIENTE</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-1 text-center">@if(isset($order))#COD{{$order->id}}@endif</td>
                <td class="col-md-6 text-left">@if(isset($order)){!!$order->name ? $order->name : '<p class="text-center no-margin">--</p>'!!}@endif</td>
                <td class="col-md-5 text-left">@if(isset($order)){!!$order->email ? $order->email : '<p class="text-center no-margin">--</p>'!!}@endif</td>
            </tr>
            </tbody>
        </table>

        <table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th class="col-md-2 text-center">TELEFONE</th>
                <th class="col-md-6 text-center">DETALHES</th>
                <th class="col-md-2 text-center">DATA</th>
                <th class="col-md-2 text-center">STATUS</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-2 text-center">@if(isset($order)){!!$order->phone ? $order->phone : '<p class="text-center no-margin">--</p>'!!} @endif</td>
                <td class="col-md-6 text-left">@if(isset($order)){!!$order->about ? $order->about : '<p class="text-center no-margin">--</p>'!!}@endif</td>
                <td class="col-md-2 text-left">@if(isset($order)){{format_date($order->created_at)}}@endif</td>
                <td class="col-md-2 text-left {{bgColor($order->status_id)}}">{{$order->status->status}}</td>
            </tr>
            </tbody>
        </table>

        <table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th class="col-md-12 text-center">OBESERVAÇÕES DO PEDIDO</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-12 text-left">@if(isset($order)){!! $order->description ? $order->description : '<p class="text-center no-margin">--</p>' !!} @endif</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row text-center" style="position: relative;">
    <div class="box">
        <div class="box-header"><legend class="text-left">Itens do pedido</legend></div>
        <table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th class="col-md-1 text-center">ID</th>
                <th class="col-md-8 text-center">NOME DO PRODUTO</th>
                <th class="col-md-1 text-center">PREÇO</th>
                <th class="col-md-1 text-center">QTDE</th>
                <th class="col-md-1 text-center">SUBTOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td class="col-md-1 text-center">{{$item->id}}</td>
                    <td class="col-md-8 text-left">{{$item->product_name}}</td>
                    <td class="col-md-1 text-right">{{money_br($item->price)}}</td>
                    <td class="col-md-1 text-center">{{$item->qty}}</td>
                    <td class="col-md-1 text-right">{{money_br($item->subtotal)}}</td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-8 text-right">DESCONTO</th>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-1 text-right">{{money_br($order->discount)}}</th>
            </tr>
            <tr>
                <th class="col-md-1 text-right"></th>
                <th class="col-md-8 text-center"></th>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-1 text-center">TOTAL R$:</th>
                <th class="col-md-1 text-right">{{money_br($order->total - $order->discount)}}</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>