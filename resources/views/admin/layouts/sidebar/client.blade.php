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