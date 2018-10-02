@include('frontend.acqua.template.header') {{--include header--}}
@include('frontend.acqua.template.nav') {{--include header--}}


@yield('content') {{--include content--}}


@include('frontend.acqua.partials.partial-footer-call'){{--include partial-footer-call--}}

@include('frontend.acqua.partials.partial-footer'){{--include partial-footer--}}
@include('frontend.acqua.template.footer') {{--include footer--}}