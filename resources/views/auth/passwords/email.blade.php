@extends('admin.layouts.login')

@section('content')

    <div class="login-logo"> man<strong>aže</strong>r </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Informe seu email válido</p>

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">Enviar o link de redefinição de senha</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
@endsection
