@extends('sprintem.template.app')

@section('title', 'Sobre a Sprintem')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/responsive.css">
    @endpush

    @include('sprintem.partials.header') {{--include header--}}


    <!-- About -->

    <div class="single_post">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="single_post_title">Sobre Nós</div>
                    <div class="single_post_text">
                        {!! $configuration['about'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('sprintem.partials.brands') {{--include banner--}}

    @include('sprintem.partials.newsletter') {{--include newsletter--}}

    @include('sprintem.partials.footer') {{--include footer--}}

    @include('sprintem.partials.copyright') {{--include copyright--}}


@endsection