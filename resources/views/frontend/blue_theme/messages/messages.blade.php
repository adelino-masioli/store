@if (Session::has('error_message'))
    <div class="alert alert-danger alert-margin-top hidden-timeout">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('error_message') ? Session::get("error_message") : '' !!}
    </div><br/>
@endif


@if (Session::has('success_message'))
    <div class="alert alert-success alert-margin-top hidden-timeout">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::has('success_message') ? Session::get("success_message") : '' !!}
    </div><br/>
@endif