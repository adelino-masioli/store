@extends('admin.layouts.print')

@section('content')
    <div class="wrapper">
        <section class="invoice">
            <!-- info row -->
            <div class="row invoice-info" style="padding-top: 10px;">
                @if($config_site->brand)
                    <div class="col-xs-2">
                        <h2 style="margin-top: -10px;">
                                <img width="120" src="{{url('/').defineUploadPath('brands', null).'/thumb/'.$config_site->brand}}" alt="{{$config_site->name}}">
                        </h2>
                    </div>
                @endif
                <div class="col-sm-10">
                    Empresa
                    <address style="font-size: 11px;">
                        <strong>{{$config_site->name}}</strong><br>
                        @if($config_site->address){{$config_site->address}},@endif
                        @if($config_site->number){{$config_site->number}} - @endif
                        @if($config_site->district){{$config_site->district}} | @endif
                        @if($config_site->city){{$config_site->city}} - @endif
                        @if($config_site->state){{$config_site->state}} - @endif
                        @if($config_site->zipcode){{$config_site->zipcode}} | @endif
                        @if($config_site->phone){{$config_site->phone}} | @endif
                        @if($config_site->email){{$config_site->email}}@endif
                    </address>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center col-md-1">ID</th>
                            <th class="text-center col-md-3">NOME DO CLIENTE</th>
                            <th class="text-center col-md-3">NOME DO ATENDENTE</th>
                            <th class="text-center col-md-1">ORIGEM</th>
                            <th class="text-center col-md-1">STATUS</th>
                            <th class="text-center col-md-1">VALOR</th>
                            <th class="text-center col-md-1">DESCONTO</th>
                            <th class="text-center col-md-1">SUBTOTAL</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $total = 0; ?>
                        <?php $discount = 0; ?>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center col-md-1">{{$order->id}}</td>
                                <td class="text-left col-md-3">{{$order->name}}</td>
                                <td class="text-left col-md-3">{{$order->user->name}}</td>
                                <td class="text-center col-md-1">{{$order->origin}}</td>
                                <td class="text-center col-md-1">{{$order->status->status}}</td>
                                <td class="text-right col-md-1">{{money_br($order->total)}}</td>
                                <td class="text-right col-md-1">{{money_br($order->discount)}}</td>
                                <td class="text-right col-md-1">{{money_br($order->total - $order->discount)}}</td>
                            </tr>
                            <?php $discount += $order->discount; ?>
                            <?php $total += $order->total; ?>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th class="text-center col-md-1"></th>
                            <th class="text-center col-md-3"></th>
                            <th class="text-center col-md-3"></th>
                            <th class="text-center col-md-1"></th>
                            <th class="text-center col-md-1"></th>
                            <th class="text-center col-md-1"></th>
                            <th class="text-center col-md-1">TOTAL</th>
                            <th class="text-center col-md-1">{{money_br($total - $discount)}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
