@if (Session::has('error_contact'))
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('error_contact') ? Session::get("error_contact") : '' !!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ $errors->first() }}
    </div>
@endif

@if (Session::has('success_contact'))
    <div class="alert alert-success alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('success_contact') ? Session::get("success_contact") : '' !!}
    </div>
@endif