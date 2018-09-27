<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::user()->avatar != '')
                    <img src="{{url('/').defineUploadPath('avatar', null).'/'.Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="img-circle">
                @else
                    <img src="{{asset('images/avatar.png')}}" class="img-circle" alt="{{Auth::user()->name}}">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="{{url('/home')}}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU NAVEGAÇÃO</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cube"></i> <span>Produtos</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('products')}}"><i class="fa fa-circle-o"></i> Listagem</a></li>
                    <li><a href="{{route('product-create')}}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i> <span>Categorias</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('categories')}}"><i class="fa fa-circle-o"></i> Listagem</a></li>
                    <li><a href="{{route('category-create')}}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Documentos</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('documents')}}"><i class="fa fa-circle-o"></i> Listagem</a></li>
                    <li><a href="{{route('document-create')}}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                </ul>
            </li>


            <li><a href="{{route('contacts')}}"><i class="fa fa-envelope"></i> <span>Contatos</span></a></li>
            <li><a href="{{route('quotes')}}"><i class="fa fa-dollar"></i> <span>Orçamentos</span></a></li>
            <li><a href="{{route('newsletters')}}"><i class="fa fa-send"></i> <span>Newsletters</span></a></li>



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('users')}}"><i class="fa fa-circle-o"></i> Listagem</a></li>
                    <li><a href="{{route('user-create')}}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                </ul>
            </li>



            <li><a href="{{route('configuration')}}"><i class="fa fa-circle-o text-red"></i> <span>Configurações</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>