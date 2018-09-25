<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('images/avatar.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="{{url('/home')}}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU NAVEGAÇÃO</li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Listagem</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Configurações</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>