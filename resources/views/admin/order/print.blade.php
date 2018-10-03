@extends('admin.layouts.print')

@section('content')
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        @if($config_site->brand)
                            <img width="100" src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" alt="">
                        @else
                            {{$config_site->name}}
                        @endif
                        <small class="pull-right">Date: {{date('d/m/Y')}}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Cliente
                    <address>
                        <strong>{{$order->name}}</strong><br>
                        {{$order->address}}, {{$order->number}} - {{$order->district}}<br>
                        {{$order->city}} - {{$order->state}} - {{$order->zipcode}}<br>
                        Telefone: {{$order->phone}}<br>
                        Email: {{$order->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Empresa
                    <address>
                        <strong>{{$config_site->name}}</strong><br>
                        @if($config_site->address){{$config_site->address}},@endif
                        @if($config_site->number){{$config_site->number}} - @endif
                        @if($config_site->district){{$config_site->district}}<br>@endif
                        @if($config_site->city){{$config_site->city}} - @endif
                        @if($config_site->state){{$config_site->state}} - @endif
                        @if($config_site->zipcode){{$config_site->zipcode}}<br>@endif
                        Telefone: {{$config_site->phone}}<br>
                        Email: {{$config_site->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Pedido #COD{{$order->id}}</b><br>
                    <br>
                    <b>Pedido ID:</b> {{$order->id}}<br>
                    <b>Realizado em:</b> {{date_only_br($order->created_at)}}<br>
                    <b>Atendido por:</b> {{$order->user->name}}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME DO PRODUTO</th>
                            <th>PREÇO</th>
                            <th>QTDE</th>
                            <th>SUBTOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $subtotal = 0; ?>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->product_name}}</td>
                                <td>{{money_br($item->price)}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{money_br($item->subtotal)}}</td>
                            </tr>
                            <?php $subtotal += $item->subtotal; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{money_br($subtotal)}}</td>
                            </tr>
                            <tr>
                                <th>Desconto</th>
                                <td>{{money_br($order->discount)}}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{{money_br($order->total - $order->discount)}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
@endsection
