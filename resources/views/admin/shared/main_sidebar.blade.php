<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->avatar(160) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
</div>
</div>

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
<li class="active treeview">
<a href="{{ url('/admin') }}">
    <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>

</a>
</li>
</ul>
</section>
<!-- /.sidebar -->
</aside>