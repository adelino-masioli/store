{{ csrf_field() }}
<div class="row">
    <div class="mailbox-read-info">
        <div class="row">
            <div class="col-md-9">
                <h3><strong>Detalhes:</strong> @if(isset($quote)){{$quote->about}}@endif</h3>
                <h5><strong>Nome do cliente:</strong> @if(isset($quote)){{$quote->name}}@endif</h5>
                <h5><strong>E-mail de contato:</strong> @if(isset($quote)){{$quote->email}}@endif</h5>
                <h5><strong>Telefone:</strong> @if(isset($quote)){{$quote->phone}}@endif</h5>
                <h5>@if(isset($quote)){{format_date($quote->created_at)}}@endif</h5>
            </div>

            @if(isset($status))
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        <select class="form-control select2" id="status_id" name="status_id">
                            @foreach($status as $status)
                                <option @if(isset($quote)) @if($quote->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="mailbox-read-message">
        @if(isset($quote)){!! $quote->description !!}@endif
    </div>
</div>

<div class="row text-center" style="position: relative;">
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