<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">

        <small class="text-info text-right">(*) Campos obrigatórios.</small>
        <form action="{{route('frontend-register-post')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="name" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Nome <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="name"  placeholder="Nome" required autofocus value="{{ old('name')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Telefone <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control phone" name="phone"  placeholder="Telefone" required value="{{ old('phone')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="whatsapp" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">WhatsApp</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="cellphone" id="cellphone" placeholder="WhatsApp" value="{{ old('cellphone')}}" onKeyDown="maskCellphone('#cellphone');">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="email" class="form-control" name="email"  placeholder="Email" required value="{{Request::input('email') ? Request::input('email') : old('email')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email_confirmation" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Confirme o Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="email" class="form-control" name="email_confirmation" id="email_confirmation" placeholder="Confirme o Email" required value="{{Request::input('email_confirmation') ? Request::input('email') : old('email_confirmation')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Senha <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Confirme a Senha <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme a Senha" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="zipcode" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">CEP <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control zipcode" name="zipcode" id="zipcode" placeholder="CEP" required value="{{ old('cep')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="street" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Rua</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Rua" value="{{ old('address')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="number" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Número</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="number" id="number" placeholder="Número" value="{{ old('number')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="district" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Bairro</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="district" id="district" placeholder="Bairro" value="{{ old('district')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Cidade</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Cidade" value="{{ old('city')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="state" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Estado</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="state" id="state" placeholder="Estado" maxlength="2" value="{{ old('state')}}">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-xs-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 offset-sm-3 col-md-9 offset-md-3 col-lg-9 offset-lg-3">
                    <button class="btn btn-primary btn-flat btn-register" type="submit">CADASTRAR</button>

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