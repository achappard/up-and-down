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

        <ul class="sidebar-menu">
            @foreach($adminNav as $nav)

                @if( !empty ($hightMenuItem) )
                    <li @if($nav['hightlight_menu'] == $hightMenuItem) class="active" @endif>
                @else
                    <li>
                @endif
                    <a href="{{ $nav['url'] }}">
                        {!! $nav['label'] !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

