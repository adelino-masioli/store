@if (Session::has('error_quote'))
    <div class="alert alert-danger alert-margin-top">
        {!! Session::has('error_quote') ? Session::get("error_quote") : '' !!}
    </div>
@endif
@if (Session::has('success_quote'))
    <div class="alert alert-success alert-margin-top">
        {!! Session::has('success_quote') ? Session::get("success_quote") : '' !!}
    </div>
@endif