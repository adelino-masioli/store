@if (Session::has('error'))
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('error') ? Session::get("error") : '' !!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ $errors->first() }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-margin-top hidden-timeout">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('success') ? Session::get("success") : '' !!}
    </div>
@endif