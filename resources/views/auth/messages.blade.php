@if (Session::has('error'))
    <p class="text-red">{!! Session::has('error') ? Session::get("error") : '' !!}</p>
@endif

@if ($errors->any())
    <p class="text-red">{{ $errors->first() }}</p>
@endif

@if (Session::has('success'))
   <p class="text-green">{!! Session::has('success') ? Session::get("success") : '' !!}</p>
@endif