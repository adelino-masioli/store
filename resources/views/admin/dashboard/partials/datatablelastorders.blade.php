<div class="col-md-4">
    <div class="box box-success box-dash" style="height: calc(100vh - 290px);overflow:hidden; margin-bottom: 0px;">
        <div class="box-header with-border">
            <h3 class="box-title">Pedidos <a href="#" class="pull-right text-success"><i class="fa fa-plus-circle text-success"></i> NOVO</a></h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">#</th>
                                <th class="col-md-9 text-center">NOME DO CLIENTE</th>
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
                                <td class="col-md-9">{{$order->name}}</td>
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