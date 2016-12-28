<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo"><b>Admin</b>LTE</a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ url('admin/logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off"></i>
                        {{ Auth::guard('admin')->user()->name }}
                    </a>

                    <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

                <li class="dropdown"> 
                    <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle lang" href="#">
                        <img src="{{url('images/'.App::getLocale().'.gif')}}"> 
                        <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu ">
                        <li><a class="switch_lang" href="#" id="en"><img src="{{url('images/en.gif')}}"/> English</a></li>
                        <li><a class="switch_lang" href="#" id="fr"><img src="{{url('images/fr.gif')}}"/> français</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>