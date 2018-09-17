@extends('sprintem.template.app')

@section('title', 'Sprintem')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/responsive.css">
    @endpush

    @include('sprintem.partials.header') {{--include header--}}

    @include('sprintem.partials.banner') {{--include banner--}}

    @include('sprintem.partials.new_arrivals') {{--include banner--}}

    @include('sprintem.partials.brands') {{--include banner--}}

    @include('sprintem.partials.newsletter') {{--include newsletter--}}

    @include('sprintem.partials.footer') {{--include footer--}}

    @include('sprintem.partials.copyright') {{--include copyright--}}


@endsection