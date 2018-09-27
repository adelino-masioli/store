<header class="main-header">

    <!-- Logo -->
    <a href="{{url('/home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>GED</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Control</b>GED</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user()->avatar != '')
                            <img src="{{url('/').defineUploadPath('avatar', null).'/'.Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="user-image">
                        @else
                            <img src="{{asset('images/avatar.png')}}" class="user-image" alt="{{Auth::user()->name}}">
                        @endif

                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if(Auth::user()->avatar != '')
                                <img src="{{url('/').defineUploadPath('avatar', null).'/'.Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="img-circle">
                            @else
                                <img src="{{asset('images/avatar.png')}}" class="img-circle" alt="{{Auth::user()->name}}">
                            @endif
                            <p>
                                {{Auth::user()->name}}
                                <small>{{Auth::user()->email}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body hidden">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Categorias</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Produtos</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Usuários</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('me')}}" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sair</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>