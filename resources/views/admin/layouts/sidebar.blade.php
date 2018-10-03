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
            @if(Auth::user()->type_id === 2)
                @include('admin.layouts.sidebar.admin')
            @endif
            @if(Auth::user()->type_id === 3)
                @include('admin.layouts.sidebar.manager')
            @endif
            @if(Auth::user()->type_id === 4)
                @include('admin.layouts.sidebar.user')
            @endif
            @if(Auth::user()->type_id === 5)
                @include('admin.layouts.sidebar.financial')
            @endif
            @if(Auth::user()->type_id === 6)
                @include('admin.layouts.sidebar.production')
            @endif
            @if(Auth::user()->type_id === 7)
                @include('admin.layouts.sidebar.expedition')
            @endif
            @if(Auth::user()->type_id === 8)
                @include('admin.layouts.sidebar.client')
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>