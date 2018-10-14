@if($page_display->banner)
    <section class="product-banner" style="background-image: url('{{pathMidia('pages')}}/{{$page_display->banner}}');" alt="{{$page_display->title}}">
        <h1 class="product-banner-title text-uppercase">{{$page_display->title}}</h1>
    </section>
@else
    <section class="product-banner" style="background: #f1f1f1;" alt="{{$page_display->title}}">
        <h1 class="product-banner-title text-uppercase">{{$page_display->title}}</h1>
    </section>
@endif