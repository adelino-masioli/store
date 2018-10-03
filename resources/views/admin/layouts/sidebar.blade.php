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
            @if(Auth::user()->type_id < 4)
                <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

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
            @endif

            @if(Auth::user()->type_id < 4)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cube"></i> <span>Catálogo</span>
                        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('products')}}"><i class="fa fa-circle-o"></i> Produtos</a></li>
                        <li><a href="{{route('categories')}}"><i class="fa fa-circle-o"></i> Categorias</a></li>
                        <li><a href="{{route('subcategories')}}"><i class="fa fa-circle-o"></i> SubCategorias</a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->type_id < 4)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dollar"></i> <span>Pedidos</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('orders')}}"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                        <li><a href="{{route('order-create')}}"><i class="fa fa-circle-o"></i> Novo Pedido</a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->type_id == 4)
                    <li><a href="{{route('orders-financial')}}"><i class="fa fa-dollar"></i> <span>Pedidos</span></a></li>
            @endif


            @if(Auth::user()->type_id < 4)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-keyboard-o"></i> <span>Formulários</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('contacts')}}"><i class="fa fa-circle-o"></i> Contatos</a></li>
                        <li><a href="{{route('quotes')}}"><i class="fa fa-circle-o"></i> Orçamentos</a></li>
                        <li><a href="{{route('newsletters')}}"><i class="fa fa-circle-o"></i> Newsletters</a></li>
                    </ul>
                </li>

                    <li><a href="{{route('supports')}}"><i class="fa fa-envelope-o"></i> <span>Suporte</span></a></li>
            @endif




            @if(Auth::user()->type_id < 3)
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
            @endif

            @if(Auth::user()->type_id < 3)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o text-red"></i> <span>Configurações</span>
                            <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('configuration')}}"><i class="fa fa-circle-o"></i> Cadastro</a></li>
                            <li><a href="{{route('banners')}}"><i class="fa fa-circle-o"></i> Banners</a></li>
                            <li><a href="{{route('midias')}}"><i class="fa fa-circle-o"></i> Mídias</a></li>
                            <li><a href="{{route('pages')}}"><i class="fa fa-circle-o"></i> Páginas</a></li>
                        </ul>
                    </li>
            @endif


            {{--customer--}}
            @if(Auth::user()->type_id == 5)
                    <li><a href="{{route('customer-dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-text-o"></i> <span>Documentos</span>
                            <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('customer-documents', ['approval'])}}"><i class="fa fa-circle-o"></i>Aprovação</a></li>
                            <li><a href="{{route('customer-documents', ['several'])}}"><i class="fa fa-circle-o"></i>Diversos</a></li>
                            <li><a href="{{route('customer-documents', ['financial'])}}"><i class="fa fa-circle-o"></i>Financeiros</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('customer-supports')}}"><i class="fa fa-envelope-o"></i> <span>Suporte</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>