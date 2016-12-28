<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="@if (Request::is('admin/dashboard')) active @endif">
                <a href="{{url('admin/dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{trans('language.dashboard')}}</span>
                </a>
            </li>
            <li class="treeview @if (Request::is('admin/automanufacturer') || Request::is('admin/automanufacturer/add')) active @endif">
                <a href="#"><i class='fa fa-automobile'></i> <span>{{trans('language.automanufacturer')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/automanufacturer')) class="active" @endif><a href="{{url('admin/automanufacturer')}}"><i class="fa fa-list"></i> {{trans('language.list')}}</a></li>
                    <li @if (Request::is('admin/automanufacturer/add')) class="active" @endif><a href="{{url('admin/automanufacturer/add')}}"><i class="fa fa-plus-circle"></i> {{trans('language.add')}}</a></li>
                </ul>
            </li>
            <li class="treeview @if (Request::is('admin/auto') || Request::is('admin/auto/add')) active @endif">
                <a href="#"><i class='fa fa-automobile'></i> <span>Auto</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/auto')) class="active" @endif><a href="{{url('admin/auto')}}"><i class="fa fa-list"></i> List Auto</a></li>
                    <li @if (Request::is('admin/auto/add')) class="active" @endif><a href="{{url('admin/auto/add')}}"><i class="fa fa-plus-circle"></i> Add Auto</a></li>
                </ul>
            </li>
            <li class="">
                <a href="http://localhost/laravel/503_adminlte/public/admin/pages">
                    <i class="fa fa-fw fa-file "></i>
                    <span>Pages</span>
                    <span class="pull-right-container">
                        <span class="label label-success pull-right">4</span>
                    </span>
                </a>
            </li>
            <li class="header">ACCOUNT SETTINGS</li>
            <li class="">
                <a href="http://localhost/laravel/503_adminlte/public/admin/settings">
                    <i class="fa fa-fw fa-user "></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="">
                <a href="http://localhost/laravel/503_adminlte/public/admin/settings">
                    <i class="fa fa-fw fa-lock "></i>
                    <span>Change Password</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-share "></i>
                    <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="#">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>Level One</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>Level One</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-fw fa-circle-o "></i>
                                    <span>Level Two</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-fw fa-circle-o "></i>
                                    <span>Level Two</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="">
                                        <a href="#">
                                            <i class="fa fa-fw fa-circle-o "></i>
                                            <span>Level Three</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#">
                                            <i class="fa fa-fw fa-circle-o "></i>
                                            <span>Level Three</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>Level One</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="header">LABELS</li>
            <li class="">
                <a href="#">
                    <i class="fa fa-fw fa-circle-o text-red"></i>
                    <span>Important</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-fw fa-circle-o text-yellow"></i>
                    <span>Warning</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-fw fa-circle-o text-aqua"></i>
                    <span>Information</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>