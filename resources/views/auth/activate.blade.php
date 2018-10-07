@extends('admin.layouts.login')

@section('content')

    <div class="login-logo"> man<strong>aže</strong>r </div>
    <!-- /.login-logo -->
    <div class="login-box-body text-center">

        @include('auth.messages')

        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn  btn-block btn-lg btn-flat bg-fuchsia" href="{{ route('login') }}">
                    Fazer login
                </a>
            </div>
        </div>

    </div>
    <!-- /.login-box-body -->
@endsection
