<section class="topbar">
    <div class="container">
        <ul>
            <li><i class="fa fa-phone"></i> {{$config_site->phone}}</li>
            <li><a href="mailto://{{$config_site->email}}"><i class="fa fa-envelope"></i> <span class="mobile-hidden">{{$config_site->email}}</span></a></li>
        </ul>

        <ul class="pull-right">
            <li><a href="{{url('/')}}">Cadastre-se</a></li>
            <li><a href="{{url('/')}}"><i class="fa fa-user"></i> <span class="mobile-hidden">Minha Conta</span></a></li>
            <li><a href="{{url('/')}}"><i class="fa fa-shopping-cart"></i> <span class="mobile-hidden">Meu Carrinho</span></a></li>
        </ul>
    </div>
</section>