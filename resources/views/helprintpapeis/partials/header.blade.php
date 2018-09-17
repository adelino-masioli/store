<!-- Header -->
<header class="header">

	@include(config('app.template').'.partials.header.top_bar') {{--include top_bar--}}

	@include(config('app.template').'.partials.header.header_main') {{--include header_main--}}

	@include(config('app.template').'.partials.header.main_nav') {{--include main_nav--}}

	@include(config('app.template').'.partials.header.page_menu') {{--include page_menu--}}


</header>