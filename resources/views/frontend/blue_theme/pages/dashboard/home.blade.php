@extends('frontend.blue_theme.template.layout')

@section('title', $config_site->name .' - Minha conta - '.Auth::user() ?  Auth::user()->name : '' )

@section('content')
<main role="main">

    <div class="container internal-pages">
        @component('frontend.blue_theme.components.breadcrumb')
            <li class="breadcrumb-item active" aria-current="page">Minha conta: {{Auth::user() ?  Auth::user()->name : ''}}</li>
        @endcomponent {{--component breadcrumb--}}

        @include('frontend.blue_theme.partials.customer_home')<!-- customer home-->
    </div>




    @include('frontend.blue_theme.partials.footer')<!-- partial footer-->
</main>
@endsection

@push('scripts')
    <script src="{{asset('templates/'.$config_site->theme)}}/assets/js/plugins.min.js"></script>
    <script>
        maskZipCode();
        maskPhone();
    </script>
@endpush