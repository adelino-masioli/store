<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">

        <h1 class="title-internal-page">
            Pedido efetuado com sucesso. Favor acessar seu email para o acompanhamento da sua compra.
        </h1>
        <p class="text-center"><strong>[IMPORTANTE]</strong> favor conferir em seus spans caso não encontrar o email na caixa de entrada. =)</p>
        <p class="text-center">Agora você pode ir para sua área de cliente, para isso bastar clicar <a href="{{route('frontend-my-account')}}">aqui</a>.</p>

        <p class="text-center">
            Código verificador:
            @if(Session::has('shopcart_token'))
                <strong>{!! Session::has('shopcart_token') ? Session::get("shopcart_token") : '' !!}</strong>
            @endif
        </p>

    </div>
</div><!-- /.row -->