<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-6" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">

        <h1 class="register-title col-xs-12 col-sm-12  col-md-8 offset-md-4 col-lg-8 offset-lg-4">Criar uma conta</h1>

        <small class="text-info text-right">(*) Campos obrigatórios.</small>
        <form action="{{route('frontend-register')}}" method="get">
            <div class="form-group row">
                <label for="email" class="col col-xs-12 col-sm-4 col-md-4 col-lg-4 col-form-label text-right">Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="email" class="form-control" name="email"  placeholder="Email" required autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="email_confirmation" class="col col-xs-12 col-sm-4 col-md-4 col-lg-4 col-form-label text-right">Confirme o Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="email" class="form-control" name="email_confirmation"  placeholder="Confirme o Email" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-8 offset-md-4 col-lg-8 offset-lg-4">
                    <button class="btn btn-success btn-flat btn-continue" type="submit">CONTINUAR</button>
                </div>
            </div>
        </form>

    </div>

    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-5" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">
        <h1 class="login-title col-xs-12 col-sm-12 col-md-8 offset-md-4 col-lg-9 offset-lg-3">Informe seu email válido</h1>

        <small class="text-info text-right">(*) Campos obrigatórios.</small>
        <form action="{{route('frontend-email-post')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="email" class="col col-xs-12 col-sm-4 col-md-4 col-lg-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                    <input type="email" class="form-control" name="email"  placeholder="Email" required autofocus autocomplete="off" value="{{old('email')}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-8 offset-md-4 col-lg-9 offset-lg-3">
                    <button class="btn btn-success btn-flat btn-login" type="submit">ENVIAR LINK</button>

                    <div class="show-alert"><br/>
                        @if (Session::has('success_message') || Session::has('error_message'))
                            @include('frontend.blue_theme.messages.messages')
                        @endif
                    </div>
                </div>
            </div>
        </form>

    </div>
</div><!-- /.row -->