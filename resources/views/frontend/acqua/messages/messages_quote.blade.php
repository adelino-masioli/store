@if (Session::has('error_quote'))
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('error_quote') ? Session::get("error_quote") : '' !!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ $errors->first() }}
    </div>
@endif

@if (Session::has('success_quote'))
    <div class="alert alert-success alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('success_quote') ? Session::get("success_quote") : '' !!}
    </div>
@endif