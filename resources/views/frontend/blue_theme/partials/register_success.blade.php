<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">

        <h1 class="title-internal-page">
            Cadastro efetuado com sucesso. Favor acessar seu email e confirmar a conta.
        </h1>
        <p class="text-center"><strong>[IMPORTANTE]</strong> favor conferir em seus spans caso não encontrar o email na caixa de entrada. =)</p>
        <p class="text-center">Se preferir não quiser fazer a verificação agora, clique <a href="{{route('frontend-home')}}">aqui</a>  e continue navegando no site.</p>

        <p class="text-center">
            Código verificador:
            @if (Session::has('verify_code'))
                <strong>{!! Session::has('verify_code') ? Session::get("verify_code") : '' !!}</strong>
            @endif
        </p>

    </div>
</div><!-- /.row -->