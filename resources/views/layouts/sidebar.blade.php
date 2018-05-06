<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('img/boxed-bg.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->fullname()}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="@if(seg(1) == 'calls') active @endif">
                <a href="{{route('calls')}}">
                    <i class="fa fa-phone"></i> <span>Calls</span>
                </a>
            </li>
            <li class="@if(seg(1) == 'sms') active @endif">
                <a href="{{route('sms')}}">
                    <i class="fa fa-envelope-o"></i> <span>SMS</span>
                </a>
            </li>
            <li class="treeview @if(seg(1) == 'users') active @endif">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(seg(2) == 'list' && seg(1) == 'users') active @endif"><a href="{{route('users.list')}}"><i class="fa fa-circle-o @if(seg(2) == 'list') text-green @endif"></i> List Users</a></li>
                    <li class="@if(seg(2) == 'import' && seg(1) == 'users') active @endif"><a href="{{route('users.importForm')}}"><i class="fa fa-circle-o @if(seg(2) == 'import') text-green @endif"></i> Import Users</a></li>
                </ul>
            </li>
            <li class="treeview @if(seg(1) == 'settings') active @endif">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(seg(2) == 'tariffs' && seg(1) == 'settings') active @endif"><a href="{{route('settings.tariffs')}}"><i class="fa fa-circle-o @if(seg(2) == 'tariffs') text-green @endif"></i> Call Tariffs</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>