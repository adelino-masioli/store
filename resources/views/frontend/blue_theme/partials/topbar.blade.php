<section class="topbar">
    <div class="container">
        <ul>
            <li><i class="fa fa-phone"></i> {{$config_site->phone}}</li>
            <li><a href="mailto://{{$config_site->email}}"><i class="fa fa-envelope"></i> <span class="mobile-hidden">{{$config_site->email}}</span></a></li>
        </ul>

        <ul class="pull-right">
            @if(Auth()->user() && Auth()->user()->type_id == userTypeId('customer'))
                <li><a href="{{route('frontend-logout')}}"><i class="fa fa-sign-out"></i> <span class="mobile-hidden">Sair</span></a></li>
                <li><a href="{{route('frontend-my-account')}}"><i class="fa fa-user"></i> <span class="mobile-hidden">Minha Conta</span></a></li>
            @else
                <li><a href="{{route('frontend-register')}}">Cadastre-se</a></li>
                <li><a href="{{route('frontend-login')}}"><i class="fa fa-lock"></i> <span class="mobile-hidden">Entrar</span></a></li>
            @endif
                <li><a href="{{route('frontend-shoppingcart-home')}}"><i class="fa fa-shopping-cart"></i> <span class="mobile-hidden">{{Cart::content()->count()}}</span></a></li>
        </ul>
    </div>
</section>