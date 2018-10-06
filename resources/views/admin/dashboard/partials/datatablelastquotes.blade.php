<div class="col-md-6">
    <div class="box" style="min-height: 200px;max-height: 200px;overflow:hidden;">
        <div class="box-header with-border">
            <h3 class="box-title">Últimos pedidos lançados</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">#</th>
                                <th class="col-md-7 text-center">NOME DO CONTATO</th>
                                <th class="col-md-2 text-center">TELEFONE</th>
                                <th class="hidden-xs col-md-2 text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders->take(3) as $order)
                            <tr>
                                <td class="col-md-1 text-center">
                                    @if($order->status_id > statusOrder('proccess'))
                                        <a href="{{route('order-show', [base64_encode($order->id)])}}" class="btn btn-flat btn-xs bg-info"><i class="fa fa-search"></i></a>
                                    @else
                                        <a href="{{route('order-edit', [base64_encode($order->id)])}}" class="btn btn-flat btn-xs bg-aqua"><i class="fa fa-pencil"></i></a>
                                    @endif
                                </td>
                                <td class="col-md-7">{{$order->name}}</td>
                                <td class="col-md-2 text-center">{{$order->phone}}</td>
                                <td class="hidden-xs col-md-2 text-center">{{$order->status->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>