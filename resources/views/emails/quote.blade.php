@extends('admin.layouts.pdf')
@section('content')
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <div class="invoice-header">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header" style="margin-top: 0px;">
                               <span>
                                    @if($config_site->brand)
                                       {{--<img width="100" src="{{public_path().defineUploadPath('brands', null).'thumb/'.$config_site->brand}}" alt="{{$config_site->name}}">--}}
                                       <img  src="{{url('').defineUploadPath('brands', null).'thumb/'.$config_site->brand}}" alt="{{$config_site->name}}">
                                   @else
                                       {{$config_site->name}}
                                   @endif
                               </span>
                            <div class="text-header">
                                @if($data->status_id == statusOrder('new'))
                                    ORÇAMENTO
                                @else
                                    PEDIDO
                                @endif
                            </div>

                            <small class="pull-right">Data: {{date_br($data->created_at)}}</small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Cliente
                        <address>
                            <strong>{{$data->name}}</strong><br>
                            @if($data->address){{$data->address}},@endif @if($data->number){{$data->number}} -@endif {{$data->district}}<br>
                            @if($data->city){{$data->city}} - @endif @if($data->state){{$data->state}} - @endif {{$data->zipcode}}<br>
                            {{$data->phone}}<br>
                            {{$data->email}}
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
                            @if($config_site->phone){{$config_site->phone}}<br>@endif
                            @if($config_site->email){{$config_site->email}}@endif
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col no-border-right">
                        <strong>
                            @if($data->status_id == statusOrder('new'))
                                Orçamento:
                            @else
                                Pedido:
                            @endif
                            #COD{{$data->id}}</strong><br>
                        <br>
                        <strong>CÓDIGO: </strong> #COD{{$data->id}}<br>
                        <strong>Realizado em:</strong> {{date_only_br($data->created_at)}}<br>
                        <strong>Atendido por:</strong> {{$data->user->name}}<br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th colspan="1" class="text-center border-top bg-gray">CÓDIGO</th>
                            <th colspan="2" class="text-center border-top bg-gray">DESCRIÇÃO DO PRODUTO</th>
                            <th colspan="1" class="text-center border-top bg-gray">PREÇO</th>
                            <th colspan="1" class="text-center border-top bg-gray">QTDE</th>
                            <th colspan="1" class="text-center border-top bg-gray border-right">SUBTOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $subtotal = 0; ?>
                        @foreach($items as $item)
                            <tr>
                                <td colspan="1" class="text-center">{{$item->id}}</td>
                                <td colspan="2">{{$item->product_name}}</td>
                                <td colspan="1" class="text-right">{{money_br($item->price)}}</td>
                                <td colspan="1" class="text-center">{{$item->qty}}</td>
                                <td colspan="1" class="text-right border-right">{{money_br($item->subtotal)}}</td>
                            </tr>
                            <?php $subtotal += $item->subtotal; ?>
                        @endforeach
                        </tbody>

                        <?php $discount = $data->discount != null ? $data->discount : 0.00; ?>

                        <tfoot>
                        <tr class="text-right">
                            <th colspan="1" class="text-right"></th>
                            <th colspan="2" class="text-right"></th>
                            <th colspan="1" class="text-right"></th>
                            <th colspan="1" class="text-right border">Subtotal:</th>
                            <td colspan="1" class="border border-right">{{money_br($subtotal)}}</td>
                        </tr>
                        <tr class="text-right">
                            <th colspan="1" class="text-right"></th>
                            <th colspan="2" class="text-right"></th>
                            <th colspan="1" class="text-right"></th>
                            <th colspan="1" class="text-right border">Desconto</th>
                            <td colspan="1" class="border border-right">{{money_br($discount)}}</td>
                        </tr>
                        <tr class="text-right">
                            <th colspan="1" class="text-right"></th>
                            <th colspan="2" class="text-right"></th>
                            <th colspan="1" class="text-right"></th>
                            <th colspan="1" class="text-right border">Total:</th>
                            <td colspan="1" class="border border-right">{{money_br(moneyReverse($data->total) - $discount)}}</td>
                        </tr>
                        </tfoot>
                    </table>

                    <table class="table" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th colspan="6" class="text-center border-top bg-gray">
                                OBSERVAÇÕES DO
                                @if($data->status_id == statusOrder('new'))
                                    ORÇAMENTO
                                @else
                                    PEDIDO
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="6" class="text-left">@if($data->description) {{$data->description}} @else NDA @endif</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
@endsection