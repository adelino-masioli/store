@extends('admin.layouts.login')

@section('content')

        <div class="login-logo"> man<strong>aže</strong>r </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Informe seu email e senha válidos</p>

            <div class="text-center">@include('auth.messages')</div>

            <form method="POST" action="{{ route('login') }}">
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
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">

                    <div class="col-xs-12">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Lembrar-me
                            </label>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                   <div class="col-md-12 text-center">
                       <a class="btn  btn-block btn-lg btn-flat bg-fuchsia" href="{{ route('register') }}">
                           Criar uma conta
                       </a>
                   </div>

                    <div class="col-md-12 text-center">
                       <a class="btn-link" href="{{ route('password.request') }}">
                           Esqueci minha senha
                       </a>
                   </div>
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
@endsection
