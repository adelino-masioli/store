<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-0" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">
        <h1 class="customer-title">Meus dados</h1>

        @if (Session::has('success_message') || Session::has('error_message'))
            <div class="show-alert">
                <div class="form-group row">
                    <div class="col-xs-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 offset-sm-3 col-md-9 offset-md-3 col-lg-9 offset-lg-3">
                        @include('frontend.blue_theme.messages.messages')
                    </div>
                </div>
            </div>
        @endif
        <small class="text-info text-right">(*) Campos obrigatórios.</small>
        <form action="{{route('frontend-register-update')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" name="id" value="{{Auth::user() ?  Auth::user()->id : ''}}">


            <div class="form-group row">
                <label for="name" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Nome <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="name"  placeholder="Nome" required autofocus value="{{Auth::user() ?  Auth::user()->name : old('name')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Telefone <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control phone" name="phone"  placeholder="Telefone" required value="{{Auth::user()->complement ?  Auth::user()->complement->phone : old('phone')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="whatsapp" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">WhatsApp</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="cellphone" id="cellphone" placeholder="WhatsApp" value="{{Auth::user()->complement ?  Auth::user()->complement->cellphone : old('cellphone')}}" onKeyDown="maskCellphone('#cellphone');">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="email" class="form-control" name="email"  placeholder="Email" required value="{{Auth::user() ?  Auth::user()->email : old('email')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Senha</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Confirme a Senha </label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme a Senha">
                </div>
            </div>

            <div class="form-group row">
                <label for="zipcode" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">CEP <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control zipcode" name="zipcode" id="zipcode" placeholder="CEP" required value="{{Auth::user()->complement ?  Auth::user()->complement->zipcode : old('zipcode')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="street" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Rua</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Rua" value="{{Auth::user()->complement ?  Auth::user()->complement->address : old('address')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="number" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Número</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="number" id="number" placeholder="Número" value="{{Auth::user()->complement ?  Auth::user()->complement->number : old('number')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="district" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Bairro</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="district" id="district" placeholder="Bairro" value="{{Auth::user()->complement ?  Auth::user()->complement->district : old('district')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Cidade</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Cidade" value="{{Auth::user()->complement ?  Auth::user()->complement->city : old('city')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="state" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Estado</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="state" id="state" placeholder="Estado" maxlength="2" value="{{Auth::user()->complement ?  Auth::user()->complement->state : old('state')}}">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-xs-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 offset-sm-3 col-md-9 offset-md-3 col-lg-9 offset-lg-3">
                    <button class="btn btn-primary btn-flat btn-register" type="submit">ATUALIZAR</button>

                    @if (Session::has('success_message') || Session::has('error_message'))
                        <div class="show-alert"><br/>
                            @include('frontend.blue_theme.messages.messages')
                        </div>
                    @endif
                </div>
            </div>
        </form>

    </div>
</div><!-- /.row -->