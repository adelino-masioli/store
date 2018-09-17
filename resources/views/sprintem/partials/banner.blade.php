<!-- Banner -->

<div class="banner">
    <div class="banner_background" style="background-image:url({{asset('templates/'.config('app.template'))}}/images/banner_background.jpg)"></div>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="text-center"><img class="img-fluid" src="{{asset('templates/'.config('app.template'))}}/images/banner.jpg" alt=""></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="text-center"><img class="img-fluid" src="{{asset('templates/'.config('app.template'))}}/images/banner_2.jpg" alt=""></div>
                    </div>
                </div>
            </div>


        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


</div>