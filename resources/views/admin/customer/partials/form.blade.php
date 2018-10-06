    {{ csrf_field() }}
    <input type="hidden" name="type_id" value="{{userTupe('customer')}}">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nome do cliente<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do cliente" value="@if(isset($customer)){{$customer->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="@if(isset($customer)){{$customer->email}}@else{{old('email')}}@endif" required>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="password">Senha<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha"  required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="password_confirmation">Confirmar senha<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha" required>
            </div>
        </div>
    </div>
    <div class="row">
        @if(isset($status))
        <div class="col-md-4">
            <div class="form-group">
                <label for="status_id">Status</label>
                <select class="form-control select2" id="status_id" name="status_id" style="width: 100%;">
                    @foreach($status as $status)
                        <option @if(isset($customer)) @if($customer->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif

    </div>


    @if(isset($customer)) {{--complements--}}
    <div class="box">
        <div class="box-header with-border">
            <strong>Complementos do cliente</strong>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="company">Nome da empresa</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Nome da empresa" value="@if(isset($user_complemento)){{$user_complemento->company}}@else{{old('company')}}@endif">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="zipcode">CEP</label>
                        <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($user_complemento)){{$user_complemento->zipcode}}@else{{old('zipcode')}}@endif">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($user_complemento)){{$user_complemento->address}}@else{{old('address')}}@endif">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="district">Bairro</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($user_complemento)){{$user_complemento->district}}@else{{old('district')}}@endif">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="number">Número</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($user_complemento)){{$user_complemento->number}}@else{{old('number')}}@endif" >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="state">Estado</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($user_complemento)){{$user_complemento->state}}@else{{old('state')}}@endif">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">Cidade</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($user_complemento)){{$user_complemento->city}}@else{{old('city')}}@endif">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" value="@if(isset($user_complemento)){{$user_complemento->phone}}@else{{old('phone')}}@endif">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cellphone">Celular</label>
                        <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Celular" value="@if(isset($user_complemento)){{$user_complemento->cellphone}}@else{{old('cellphone')}}@endif">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif