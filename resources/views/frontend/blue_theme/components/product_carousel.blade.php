<div id="productcarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#productcarousel" data-slide-to="0" class="active"></li>
        <li data-target="#productcarousel" data-slide-to="1"></li>
        <li data-target="#productcarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php $i = 0; ?>
        @if(\App\Models\ProductImage::getImages($product->id)->count() > 0)
            @foreach(\App\Models\ProductImage::getImages($product->id) as $image)
                <div class="carousel-item @if($i==0) active @endif">
                    @if($image->image))
                    <img class="first-slide img-fluid" src="{{pathMidia('catalog')}}/{{$image->image}}" alt="{{$image->name}}">
                    @else
                        <img class="first-slide img-fluid" src="{{asset('assets/images/no-photo_500x500.jpg')}}" alt="{{$image->name}}">
                    @endif
                </div>
                <?php $i++; ?>
            @endforeach
        @else
            <div class="carousel-item active">
                <img class="first-slide img-fluid" src="{{asset('assets/images/no-photo_500x500.jpg')}}" alt="{{$product->name}}">
            </div>
        @endif
    </div>
    <a class="carousel-control-prev" href="#productcarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#productcarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>