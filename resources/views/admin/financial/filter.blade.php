@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Relatórios
        @endslot
        @slot('small')
            Filtro de Pedidos
        @endslot
        @slot('link')
            Relatório de pedidos
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{route('orders-financial-report')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat"><i class="fa fa-list"></i> Relatório de Pedidos</a>
                        <a target="_blank" href="{{route('orders-financial-report-print')}}" onclick="localStorage.clear();" class="btn btn-sm bg-gray margin-r-5 btn-flat"><i class="fa fa-print"></i> Imprimir</a>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.messages.messages_register')
                            </div>


                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tabs">
                                        <li role="presentation" class="active"><a href="#quote" aria-controls="quote" role="tab" data-toggle="tab">Resultado do filtro de relatório de Pedidos</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="quote">

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('scripts')
    <script>
    </script>
@endpush
