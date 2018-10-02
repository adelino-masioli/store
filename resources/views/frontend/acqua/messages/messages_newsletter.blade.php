@if (Session::has('error_newsletter'))
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('error_newsletter') ? Session::get("error_newsletter") : '' !!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ $errors->first() }}
    </div>
@endif

@if (Session::has('success_newsletter'))
    <div class="alert alert-success alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('success_newsletter') ? Session::get("success_newsletter") : '' !!}
    </div>
@endif