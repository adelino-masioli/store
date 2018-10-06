<div class="row">

    @foreach($payments as $payments)
        <div class="col-md-6 payment-box">
            <div class="input-group">
                <input type="text" class="form-control money txt_payment_" name="payment" id="payment_{{$payments->id}}"  placeholder="{{$payments->payment}}"
                       data-value="{{\App\Models\OrderPayment::getPaymentValue($order->id, $payments->id)}}"
                >
                <span class="input-group-btn">
                    <button type="button" class="btn  btn-flat {{bgColor($payments->id)}} payment_" id="paymentinput_{{$payments->id}}" onclick="selectPayment('{{$payments->id}}');"><i class="fa fa-plus-circle"></i></button>
                </span>
            </div>
        </div>
    @endforeach

</div>