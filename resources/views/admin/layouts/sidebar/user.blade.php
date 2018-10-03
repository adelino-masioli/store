<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

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
    </ul>
</li>

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