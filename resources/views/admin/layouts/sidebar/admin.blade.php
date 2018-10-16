<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-users"></i> <span>Clientes</span>
        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{route('customers')}}"><i class="fa fa-circle-o"></i> Listagem</a></li>
        <li><a href="{{route('customer-create')}}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
    </ul>
</li>

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

        <li><a href="{{route('orders-financial')}}"><i class="fa fa-circle-o"></i> <span>Financeiro</span></a></li>
        <li><a href="{{route('orders-financial-report')}}"><i class="fa fa-circle-o"></i> <span>Relatórios</span></a></li>
        <li><a href="{{route('orders-production')}}"><i class="fa fa-circle-o"></i> <span>Produção</span></a></li>
        <li><a href="{{route('orders-expedition')}}"><i class="fa fa-circle-o"></i> <span>Expedição</span></a></li>
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

<li class="treeview hidden">
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
<li><a href="{{route('midias')}}"><i class="fa fa-photo"></i> <span>Mídias</span></a></li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-circle-o text-red"></i> <span>Configurações</span>
        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{route('configuration')}}"><i class="fa fa-circle-o text-blue"></i> Cadastro</a></li>
        <li><a href="{{route('users')}}"><i class="fa fa-circle-o"></i> Usuários</a></li>
        <li class="hidden"><a href="{{route('banners')}}"><i class="fa fa-circle-o"></i> Banners</a></li>
        <li class="hidden"><a href="{{route('midias')}}"><i class="fa fa-circle-o"></i> Mídias</a></li>
        <li><a href="{{route('pages')}}"><i class="fa fa-circle-o"></i> Páginas</a></li>
        <li class="hidden"><a href="{{route('themes')}}"><i class="fa fa-circle-o"></i> Temas</a></li>
    </ul>
</li>