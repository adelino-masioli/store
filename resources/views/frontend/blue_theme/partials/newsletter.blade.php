<div class="container">
    <div class="col-md-12 newsletter">
        <form action="{{route('post-newsletter')}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-3 news-label" data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out">
                    <i class="fa fa-envelope-open-o"></i>
                   <span>Receba nossas<br/> novidades</span>
                </div>

                <div class="col-xs-12 col-sm-12  col-lg-4 news-input" data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out">
                    <input type="text" class="form-control" name="name" placeholder="Informe seu nome" required>
                </div>

                <div class="col-xs-12 col-sm-12  col-lg-5" data-aos="fade-down" data-aos-delay="50" data-aos-easing="ease-in-out">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Informe seu email" aria-label="Informe seu email" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-flat" type="submit" id="button-assign">ASSINAR</button>
                        </div>
                    </div>
                </div>

                @include('frontend.blue_theme.messages.messages_newsletter')
            </div><!-- /.row -->
        </form>
    </div>
</div><!-- /.container -->