@extends('sprintem.template.app')

@section('title', $category->name)

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/sprintem')}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/sprintem')}}/styles/responsive.css">
    @endpush

    @include('sprintem.partials.header') {{--include header--}}

    @include('sprintem.partials.product_category') {{--include banner--}}

    @include('sprintem.partials.product_list') {{--include banner--}}

    @include('sprintem.partials.brands') {{--include banner--}}

    @include('sprintem.partials.newsletter') {{--include newsletter--}}

    @include('sprintem.partials.footer') {{--include footer--}}

    @include('sprintem.partials.copyright') {{--include copyright--}}


@endsection