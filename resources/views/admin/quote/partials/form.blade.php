{{ csrf_field() }}
<div class="row">
    <div class="mailbox-read-info">
        <div class="row">
            <div class="col-md-9">
                <h3><strong>Assunto:</strong> @if(isset($quote)){{$quote->about}}@endif</h3>
                <h5><strong>Enviado por:</strong> @if(isset($quote)){{$quote->name}}@endif</h5>
                <h5><strong>E-mail de contato:</strong> @if(isset($quote)){{$quote->email}}@endif</h5>
                <h5><strong>Telefone:</strong> @if(isset($quote)){{$quote->phone}}@endif</h5>
                <h5><strong>Nome do produto:</strong> @if(isset($quote)){{$quote->product_name}}@endif</h5>
                <h5>@if(isset($quote)){{format_date($quote->created_at)}}@endif</h5>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="qty">Status</label>
                    <select name="status" class="form-control select2" id="status" name="status">
                        <option @if(isset($quote)) @if($quote->status == 1) selected @endif @endif value="1">Aberto</option>
                        <option @if(isset($quote)) @if($quote->status == 2) selected @endif @endif value="2">Concluído</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="mailbox-read-message">
        @if(isset($quote)){!! $quote->message !!}@endif
    </div>
</div>