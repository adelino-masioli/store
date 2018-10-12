@if (Session::has('error_newsletter'))
    <div class="col-xs-12 col-sm-12 offset-lg-3 col-lg-9"><br/>
        <div class="alert alert-danger alert-margin-top hidden-timeout">
            {!! Session::has('error_newsletter') ? Session::get("error_newsletter") : '' !!}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="col-xs-12 col-sm-12 offset-lg-3 col-lg-9"><br/>
        <div class="alert alert-danger alert-margin-top hidden-timeout">
            {{ $errors->first() }}
        </div>
    </div>
@endif

@if (Session::has('success_newsletter'))
    <div class="col-xs-12 col-sm-12 offset-lg-3 col-lg-9"><br/>
        <div class="alert alert-success alert-margin-top hidden-timeout">
            {!! Session::has('success_newsletter') ? Session::get("success_newsletter") : '' !!}
        </div>
    </div>
@endif