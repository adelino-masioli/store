    {{ csrf_field() }}
    <div class="row">
        <div class="mailbox-read-info">
            <div class="row">
                <div class="col-md-9">
                    <h3><strong>Assunto:</strong> @if(isset($contact)){{$contact->about}}@endif</h3>
                    <h5><strong>Enviado por:</strong> @if(isset($contact)){{$contact->name}}@endif</h5>
                    <h5><strong>E-mail de contato:</strong> @if(isset($contact)){{$contact->email}}@endif</h5>
                    <h5><strong>Telefone:</strong> @if(isset($contact)){{$contact->phone}}@endif</h5>
                    <h5>@if(isset($contact)){{format_date($contact->created_at)}}@endif</h5>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="qty">Status</label>
                        <select name="status" class="form-control select2" id="status" name="status">
                            <option @if(isset($contact)) @if($contact->status == 1) selected @endif @endif value="1">Aberto</option>
                            <option @if(isset($contact)) @if($contact->status == 2) selected @endif @endif value="2">Concluído</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="mailbox-read-message">
            @if(isset($contact)){!! $contact->message !!}@endif
        </div>
    </div>