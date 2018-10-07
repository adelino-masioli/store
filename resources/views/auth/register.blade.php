@extends('admin.layouts.login')

@section('content')

    <div class="login-logo"> man<strong>aže</strong>r </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Preencha o formulário abaixo</p>

        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Nome" name="name" value="{{ old('name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Senha" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar a Senha" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>


            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">Cadastrar</button>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <a class="btn-link" href="{{ route('login') }}">
                        Já sou cadastrado
                    </a>
                </div>
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
@endsection
