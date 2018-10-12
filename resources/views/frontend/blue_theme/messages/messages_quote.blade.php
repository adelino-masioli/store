@if (Session::has('error_quote'))
    <br/>
    <br/>
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        {!! Session::has('error_quote') ? Session::get("error_quote") : '' !!}
    </div>
@endif

@if ($errors->any())
    <br/>
    <br/>
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        {{ $errors->first() }}
    </div>
@endif

@if (Session::has('success_quote'))
    <br/>
    <br/>
    <div class="alert alert-success alert-margin-top hidden-timeout">
        {!! Session::has('success_quote') ? Session::get("success_quote") : '' !!}
    </div>
@endif