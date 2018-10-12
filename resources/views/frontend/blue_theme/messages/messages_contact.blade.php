@if (Session::has('error_contact'))
    <br/>
    <br/>
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        {!! Session::has('error_contact') ? Session::get("error_contact") : '' !!}
    </div>
@endif

@if ($errors->any())
    <br/>
    <br/>
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        {{ $errors->first() }}
    </div>
@endif

@if (Session::has('success_contact'))
    <br/>
    <br/>
    <div class="alert alert-success alert-margin-top hidden-timeout">
        {!! Session::has('success_contact') ? Session::get("success_contact") : '' !!}
    </div>
@endif