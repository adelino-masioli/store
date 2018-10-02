<!-- Newsletter start -->



<div class="container">

    <div class="row">

        <div class="row">

            <div class="col-md-12">

                <div class="wow fadeInUp newsletter">
                    <form action="{{route('post-newsletter')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 newsletter-icon full-wxs">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <span>Receba nossas <br/>novidades</span>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 full-wxs news_name">
                                <input type="text" class="form-control" id="news_name" name="name" placeholder="Informe seu nome" required/>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-5 full-wxs">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="news_email" name="email" placeholder="Informe seu email" required/>
                                    <span class="input-group-btn">
                                            <button  class="btn btn-blue" type="submit">ASSINAR</button>
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @include('frontend.acqua.messages.messages_newsletter')
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div><!-- .row -->

    </div><!--End row -->

</div>



<!-- Newsletter end -->