@if (Session::has('error_contact'))
    <div class="alert alert-danger alert-margin-top">
        {!! Session::has('error_contact') ? Session::get("error_contact") : '' !!}
    </div>
@endif
@if (Session::has('success_contact'))
    <div class="alert alert-success alert-margin-top">
        {!! Session::has('success_contact') ? Session::get("success_contact") : '' !!}
    </div>
@endif