@extends('admin.layouts.app')
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Pedido
        @endslot
        @slot('small')
            Fechamento do pedido: #{{$order->id}} | <strong>{{$order->name}}</strong>
        @endslot
        @slot('link')
            Fechamento do pedido
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.financial.partials.menu')
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
                                        <li role="presentation" class="active"><a href="#singletab" aria-controls="singletab" role="tab" data-toggle="tab">Pagamento</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletab">
                                            <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @include('admin.order.partials.formpayment')
                                                </div>
                                                <div class="col-md-3">
                                                    @include('admin.order.partials.payments')
                                                </div>
                                                <div class="col-md-3">
                                                    <table class="table table-responsive table-condensed table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td class="col-md-5 text-right">Total R$</td>
                                                                <td class="col-md-7 text-right"><span class="total-to-pay">{{money_br($order->total - $order->discount)}}</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-5 text-right">Pago R$</td>
                                                                <td class="col-md-7 text-right"><span class="total-pay">{{money_br($order_pay)}}</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-5 text-right">À Pagar R$</td>
                                                                <td class="col-md-7 text-right"><span class="total-pay-diff">{{money_br(($order->total - $order->discount) - $order_pay)}}</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <table class="table table-responsive table-condensed table-bordered table-striped">
                                                        @foreach($payments as $payments)
                                                            <tr>
                                                                <td class="col-md-5 text-right">{{$payments->payment}} R$</td>
                                                                <td class="col-md-7">

                                                                    @if(\App\Models\OrderPayment::getPaymentValue($order->id, $payments->id) != '0,00')
                                                                        <button onclick="destroyPayment('{{$payments->id}}');" type="button" class="btn btn-xs bg-red pull-right  btn-d_{{$payments->id}}" style="margin-left: 10px;"><i class="fa fa-trash"></i></button>
                                                                    @else
                                                                        <button type="button" class="btn btn-xs bg-gray pull-right btn-dd_{{$payments->id}} disabled" style="margin-left: 10px;"><i class="fa fa-trash"></i></button>
                                                                    @endif

                                                                        <button type="button" class="btn btn-xs bg-gray pull-right btn-destroy-disabled_{{$payments->id}} disabled" style="margin-left: 10px;display: none;"><i class="fa fa-trash"></i></button>
                                                                        <button onclick="destroyPayment('{{$payments->id}}');" type="button" class="btn btn-xs bg-red pull-right btn-destroy_{{$payments->id}}" style="margin-left: 10px; display: none;"><i class="fa fa-trash"></i></button>

                                                                    <span class="pull-right payres_{{$payments->id}}">
                                                                        {{\App\Models\OrderPayment::getPaymentValue($order->id, $payments->id)}}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
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
            </div>
        </div>
    </section>


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            //money
            masMoney();
        });

        function selectPayment(id) {
            if($('#payment_'+id).val().length > 0) {
                var vUrlpayment = '{{route('order-payment-store')}}';
                var vDatapayment = {
                    _token: $('input[name=_token]').val(),
                    payment_id: id,
                    order_id: $('#order_id').val(),
                    price: $('#payment_' + id).val(),
                };
                $.post(
                    vUrlpayment,
                    vDatapayment,
                    function (response) {
                        if (response.status === 1) {
                            toast('Importante', response.response, 'top-right', '#2dff2e')

                            $('.total-pay').html('');
                            $('.total-pay').html(response.order_pay);

                            $('.total-pay-diff').html('');
                            $('.total-pay-diff').html(response.order_pay_diff);

                            //
                            addPaymentVal(id, response.payment_val);

                            $('#payment_'+id).val('');
                        } else {
                            toast('Importante', response.response, 'top-right', '#ff0000')
                            $('#payment_'+id).val('');
                        }
                    }
                );
            }else{
                toast('Importante', 'Favor informar um valor válido.', 'top-right', '#ff0000')
                $('#payment_'+id).val('');
            }
        }

        function destroyPayment(id) {
            var vUrlpayment = '{{route('order-payment-destroy')}}';
            var vDatapayment = {
                _token: $('input[name=_token]').val(),
                payment_id: id,
                order_id: $('#order_id').val(),
            };
            $.post(
                vUrlpayment,
                vDatapayment,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante', response.response, 'top-right', '#2dff2e')

                        $('.total-pay').html('');
                        $('.total-pay').html(response.order_pay);

                        $('.total-pay-diff').html('');
                        $('.total-pay-diff').html(response.order_pay_diff);

                        //
                        addPaymentVal(id, response.payment_val);

                        $('#payment_'+id).val('');
                    } else {
                        toast('Importante', response.response, 'top-right', '#ff0000')
                    }
                }
            );
        }

        function addPaymentVal(id, val){
            $('.payres_'+id).html('');
            $('.payres_' + id).html(val);

            if(val != '0,00') {
                $('.btn-dd_'+id).css('display', 'none');
                $('.btn-destroy-disabled_'+id).css('display', 'none');
                $('.btn-destroy_'+id).css('display', 'block');
            }else{
                $('.btn-d_'+id).css('display', 'none');
                $('.btn-destroy_'+id).css('display', 'none');
                $('.btn-destroy-disabled_'+id).css('display', 'block');
            }
        }
    </script>
@endpush
