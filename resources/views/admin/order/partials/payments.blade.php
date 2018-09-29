<div class="row">

    @foreach($payments as $payments)
        <div class="col-md-2 col-sm-4 col-xs-12 payment-box">
            <input type="text" class="form-control money txt_payment_" name="payment" id="payment_{{$payments->id}}" placeholder="0,00" value="{{\App\Models\OrderPayment::getPaymentValue($order->id, $payments->id)}}">
            <div class="payment-box-content {{bgColor($payments->id)}} payment_" id="paymentinput_{{$payments->id}}" onclick="selectPayment('{{$payments->id}}');">
                <p>{{$payments->payment}}</p>
                <i class="fa fa-check-circle"></i></a>
            </div>
        </div>
    @endforeach

</div>