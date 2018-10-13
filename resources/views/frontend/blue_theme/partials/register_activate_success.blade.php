<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">

        @if (Session::has('success'))
            <h1 class="title-internal-page">
                Cadastro ativado com sucesso. Clique <a href="{{route('frontend-login')}}">aqui e faça o login</a>.
            </h1>
            <p class="text-center"><strong>[IMPORTANTE]</strong> Caso esqueceu sua senha, basta clicar <a href="{{route('frontend-login-forgot')}}">aqui</a> para recuperar. =)</p>
            <p class="text-center">Se preferir não fazer o login agora, clique <a href="{{route('frontend-home')}}">aqui</a> e continue navegando no site.</p>
        @endif

        @if (Session::has('error'))
            <h1 class="title-internal-page text-danger">
                Erro ao ativar o cadastro. Favor contactar o suporte caso foi este o link recebido em seu email..
            </h1>
            <p class="text-center"><strong>[IMPORTANTE]</strong> Caso já ativou sua conta, basta clicar <a href="{{route('frontend-login')}}">aqui</a> para acessar. =)</p>
            <p class="text-center">Se preferir não fazer o login agora, clique <a href="{{route('frontend-home')}}">aqui</a> e continue navegando no site.</p>
        @endif
    </div>
</div><!-- /.row -->