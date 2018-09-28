<input type="hidden" name="quote_id" id="quote_id" value="{{$quote->id}}">

@include('admin.quote.partials.payments')



<div class="row text-center" style="position: relative;">
    <div class="col-md-12">
        <table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th class="col-md-1 text-center">ID</th>
                <th class="col-md-8 text-center">NOME DO PRODUTO</th>
                <th class="col-md-1 text-center">PREÇO</th>
                <th class="col-md-1 text-center">QTDE</th>
                <th class="col-md-1 text-center">SUBTOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quteitens as $quteiten)
                <tr>
                    <td class="col-md-1 text-center">{{$quteiten->id}}</td>
                    <td class="col-md-8 text-left">{{$quteiten->product_name}}</td>
                    <td class="col-md-1 text-right">{{money_br($quteiten->price)}}</td>
                    <td class="col-md-1 text-center">{{$quteiten->qty}}</td>
                    <td class="col-md-1 text-right">{{money_br($quteiten->subtotal)}}</td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-8 text-right">DESCONTO</th>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-1 text-right">{{money_br($quote->discount)}}</th>
            </tr>
            <tr>
                <th class="col-md-1 text-right"></th>
                <th class="col-md-8 text-center"></th>
                <th class="col-md-1 text-center"></th>
                <th class="col-md-1 text-center">TOTAL R$:</th>
                <th class="col-md-1 text-right">{{money_br($quote->total - $quote->discount)}}</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>