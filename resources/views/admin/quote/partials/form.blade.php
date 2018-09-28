    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Nome do cliente<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do cliente" value="@if(isset($quote)){{$quote->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail do cliente</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do cliente" value="@if(isset($quote)){{$quote->email}}@else{{old('email')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="zipcode">CEP</label>
                <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($quote)){{$quote->zipcode}}@else{{old('zipcode')}}@endif">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($quote)){{$quote->address}}@else{{old('address')}}@endif">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="district">Bairro</label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($quote)){{$quote->district}}@else{{old('district')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="number">Número</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($quote)){{$quote->number}}@else{{old('number')}}@endif">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="state">Estado</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($quote)){{$quote->state}}@else{{old('state')}}@endif">
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="city">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($quote)){{$quote->city}}@else{{old('city')}}@endif">
            </div>
        </div>
    </div>



    @if(isset($quote))
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control editor" id="description" name="description" placeholder="Descrição">@if(isset($quote)){{$quote->description}}@else{{old('description')}}@endif</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            @if(isset($status))
                <div class="col-md-4">
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


            @if(isset($configurations) && $configurations != '')
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="configuration_id">Empresa</label>
                        <select class="form-control select2" id="configuration_id" name="configuration_id">
                            @foreach($configurations as $quote)
                                <option @if(isset($quote)) @if($quote->configuration_id == $quote->id) selected @endif @endif value="{{$quote->id}}">{{$quote->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
@endif