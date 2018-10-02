@extends('admin.layouts.app')
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Pedido
        @endslot
        @slot('small')
            Editando o pedido: #{{$order->id}}
        @endslot
        @slot('link')
            Editando do pedido
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
                                        <li role="presentation" class="pull-right"><a href="javascript:void(0);" class="disabled total-to-pay">R$ {{money_br($order->total - $order->discount)}}</a></li>
                                        <li role="presentation" class="pull-right"><a href="javascript:void(0);" class="disabled total-pay-diff">R$ {{money_br(($order->total - $order->discount) - $order_pay)}}</a></li>
                                        <li role="presentation" class="pull-right"><a href="javascript:void(0);" class="disabled total-pay">R$ {{money_br($order_pay)}}</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletab">
                                            @include('admin.order.partials.formpayment')
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
                        } else {
                            toast('Importante', response.response, 'top-right', '#ff0000')
                        }
                    }
                );
            }
        }
    </script>
@endpush
