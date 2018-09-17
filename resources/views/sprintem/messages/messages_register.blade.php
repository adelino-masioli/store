@if (Session::has('error'))
    <div class="alert alert-danger alert-margin-top">
        {!! Session::has('error') ? Session::get("error") : '' !!}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-margin-top">
        {!! Session::has('success') ? Session::get("success") : '' !!}
    </div>
@endif