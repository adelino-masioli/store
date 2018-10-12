<div class="row quote-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">
        <small class="text-info">(*) Favor preencher o formulário abaixo que entraremos em contato respondendo suas dúvidas.</small>
        <form action="{{route('post-quote')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden"  name="product_id" value="{{base64_encode($product->id)}}">
            <input type="hidden"  name="product_name" value="{{$product->name}}">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 inner-addon left-addon">
                    <div class="inner-addon left-addon">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Informe seu nome" required autofocus>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="inner-addon left-addon">
                        <i class="fa fa-envelope-o"></i>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Informe seu email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="inner-addon left-addon">
                        <i class="fa fa-mobile-phone"></i>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Informe seu telefone" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="inner-addon left-addon">
                        <i class="fa fa-comment-o"></i>
                        <input type="text" class="form-control" name="about" id="about" placeholder="Informe seu assunto" required>
                    </div>
                </div>
            </div>
            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Informe a mensagem" required></textarea>
            <button class="btn btn-primary btn-flat">ENVIAR</button>

            @include('frontend.blue_theme.messages.messages_quote')
        </form>
    </div>
</div><!-- /.row -->