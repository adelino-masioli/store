@extends(config('app.template').'.template.app')

@section('title', 'HelprintPapeis')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/responsive.css">
    @endpush

    @include(config('app.template').'.partials.header') {{--include header--}}

    @include(config('app.template').'.partials.banner') {{--include banner--}}

    @include(config('app.template').'.partials.new_arrivals') {{--include banner--}}

    @include(config('app.template').'.partials.brands') {{--include banner--}}

    @include(config('app.template').'.partials.newsletter') {{--include newsletter--}}

    @include(config('app.template').'.partials.footer') {{--include footer--}}

    @include(config('app.template').'.partials.copyright') {{--include copyright--}}


@endsection