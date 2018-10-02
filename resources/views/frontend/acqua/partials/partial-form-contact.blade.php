<!-- Contact start -->
@if($page->googlemaps)
<div class="googlemaps">
    {!! $page->googlemaps !!}
</div>
@endif
@if($page->banner && \Request::is('contato'))
    <section class="pfblock service-image-back" style="background-image: url('{{pathMidia('pages')}}/{{$page->banner}}');"></section>
@endif

<div class="container">
    <div class="row icons-contact">
        <div class="col-xs-12 col-md-3 text-center wow fadeInDown">
            <i class="fa fa-map-marker"></i>
            <h3>ENDEREÇO</h3>
            <p>{{$config_site->address}}, {{$config_site->number}} – {{$config_site->district}}</p>
            <p>{{$config_site->city}} – {{$config_site->state}}</p>
            <p>30720-290</p>
        </div>

        <div class="col-xs-12 col-md-3 text-center wow fadeInDown">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <h3>E-MAIL</h3>
            <p>{{$config_site->email}}</p>
        </div>

        <div class="col-xs-12 col-md-3 text-center wow fadeInDown">
            <i class="fa fa-globe"></i>
            <h3>SITE</h3>
            <p>{{$config_site->site}}</p>
        </div>

        <div class="col-xs-12 col-md-3 text-center wow fadeInDown">
            <i class="fa fa-phone"></i>
            <h3>TELEFONE</h3>
            <p>{{$config_site->phone}}</p>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <form action="{{route('post-contact')}}" method="post" class="contact-form">
                {{ csrf_field() }}
                <div class="ajax-hidden">
                    <div class="row">
                        <div class="form-group wow fadeInUp col-xs-12 col-md-6">
                            <label class="sr-only" for="contact_name">Nome</label>
                            <input type="text" id="contact_name" class="form-control" name="name" placeholder="Infome seu nome" required>
                        </div>

                        <div class="form-group wow fadeInUp col-xs-12 col-md-6" data-wow-delay=".1s">
                            <label class="sr-only" for="contact_email">E-mail</label>
                            <input type="email" id="contact_email" class="form-control" name="email" placeholder="Informe seu e-mail" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group wow fadeInUp col-xs-12 col-md-6">
                            <label class="sr-only" for="contact_phone">Telefone</label>
                            <input type="text" id="contact_phone" class="form-control" name="phone" placeholder="Infome seu telefone" required>
                        </div>

                        <div class="form-group wow fadeInUp col-xs-12 col-md-6" data-wow-delay=".1s">
                            <label class="sr-only" for="contact_about">Informe o assunto</label>
                            <input type="text" id="contact_about" class="form-control" name="about" placeholder="Informe o assunto" required>
                        </div>
                    </div>

                    <div class="form-group wow fadeInUp" data-wow-delay=".2s">
                        <textarea class="form-control" id="contact_message" name="message" rows="7" placeholder="Informe a mensagem" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-lg wow fadeInUp btn-blue btn-submit" data-wow-delay=".3s">Enviar</button>

                    <div class="row">
                        <div class="col-md-12">
                            @include('frontend.acqua.messages.messages_contact')
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div><!-- .row -->
</div><!-- .container -->
</section>

<!-- Contact end -->