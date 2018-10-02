<!-- Home start -->
<section>
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php $i=0; ?>
            @foreach($banners as $banner)
                <div class="item <?php if($i == 0){ echo 'active';} ?>">
                    <img class="wow fadeIn" src="{{pathMidia('banners')}}/{{$banner->file}}" alt="{{$banner->name}}">
                </div>
                <?php $i++; ?>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="glyphicon-chevron-left" aria-hidden="true"><img src="{{asset('templates/'.$config_site->theme)}}/assets/images/arrow-left.jpg" alt="{{$config_site->name}}"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="glyphicon-chevron-right" aria-hidden="true"><img src="{{asset('templates/'.$config_site->theme)}}/assets/images/arrow-right.jpg" alt="{{$config_site->name}}"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- Home end -->