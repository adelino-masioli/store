@extends('admin.layouts.login')

@section('content')

        <div class="login-logo"> man<strong>aže</strong>r </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Informe se email e senha válidos</p>

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
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ENTRAR</button>
                    </div>
                    <!-- /.col -->

                    <div class="col-xs-12">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Lembrar-me
                            </label>
                        </div>
                    </div>


                    <a class="btn btn-link hidden" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
@endsection
