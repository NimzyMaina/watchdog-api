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
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>