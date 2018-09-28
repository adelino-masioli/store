<table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
    <thead>
    <tr>
        <th class="col-md-1 text-center">ID</th>
        <th class="col-md-1 text-center">AÇÃO</th>
        <th class="col-md-7 text-center">NOME DO PRODUTO</th>
        <th class="col-md-1 text-center">PREÇO</th>
        <th class="col-md-1 text-center">QTDE</th>
        <th class="col-md-1 text-center">SUBTOTAL</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quteitens as $quteiten)
        <tr>
            <td class="col-md-1 text-center">{{$quteiten->id}}</td>
            <td class="col-md-1 text-center"><button class="btn btn-xs bg-red" onclick="destroyItem('{{$quteiten->id}}');"><i class="fa fa-trash"></i></button></td>
            <td class="col-md-7 text-left">{{$quteiten->product_name}}</td>
            <td class="col-md-1 text-right">{{money_br($quteiten->price)}}</td>
            <td class="col-md-1 text-center">{{$quteiten->qty}}</td>
            <td class="col-md-1 text-right">{{money_br($quteiten->subtotal)}}</td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th class="col-md-1 text-center"></th>
            <th class="col-md-1 text-right"></th>
            <th class="col-md-7 text-right">DESCONTO</th>
            <th class="col-md-1 text-center"><input type="text" class="form-control money textdiscount" name="discount" id="discount" placeholder="Desconto" onkeyup="enableBtn('.btn-add-discount', '.textdiscount');" onclick="masMoney();"></th>
            <th class="col-md-1 text-center"><button type="button" class="btn bg-yellow btn-block btn-add-discount" onclick="addDiscount();" disabled><i class="fa fa-plus-circle"></i></button></th>
            <th class="col-md-1 text-right">{{money_br($quote->discount)}}</th>
        </tr>
        <tr>
            <th class="col-md-1 text-center"></th>
            <th class="col-md-1 text-right"></th>
            <th class="col-md-7 text-center"></th>
            <th class="col-md-1 text-center"></th>
            <th class="col-md-1 text-center">TOTAL</th>
            <th class="col-md-1 text-right">{{money_br($quote->total - $quote->discount)}}</th>
        </tr>
    </tfoot>
</table>