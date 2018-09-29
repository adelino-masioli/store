    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nome do usuário<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="@if(isset($user)){{$user->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="@if(isset($user)){{$user->email}}@else{{old('email')}}@endif" required>
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

    @if(isset($user)) {{--complements--}}
    <div class="box">
        <div class="box-header with-border">
            <strong>Complementos do usuário</strong>
        </div>
        <div class="box-body">
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