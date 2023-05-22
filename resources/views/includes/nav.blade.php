<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                <?php $shop = App\Models\ShopInfo::all() ?>
                @foreach($shop as $shop)
                <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="user-image img-circle elevation-2 alt=">
                @endforeach
                <span class="hidden-xs">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span>

                <!-- <br>@if (empty(Auth::user()->branch->name))
                <span class="brand-text font-weight-light"></span>
                @else
                <span class="brand-text font-weight-light">{{ Auth::user()->branch->name }}</span>
                @endif -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Wasifu</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-default">
                    <i class="fas fa-lock mr-2"></i> Badili password
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-lg">
                    <i class="fas fa-file mr-2"></i> Badili taarifa
                </a>
            </div>
            
        </li>
    </ul>
</nav>
<!-- /.navbar -->


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{URL::asset($shop->logo)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight" style="font-size: 12px;"><b>{{ $shop->name }}</b></span>
    </a>
    <div class="sidebar">
   <!-- Sidebar Menu -->
   <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route( 'dashboard') }}" class="nav-link {{Request::is('dashboard')?'active':''}} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                
                @can('wasimamizi-duka')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usimamizi wa Duka
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('matawi') }}" class="nav-link {{Request::is('matawi')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Matawi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jukumu') }}" class="nav-link {{Request::is('jukumu')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jukumu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wauzaji') }}" class="nav-link {{Request::is('wauzaji')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>wauzaji</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('ona-bidhaa')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Usimamizi wa Bidhaa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sajilbidhaa') }}" class="nav-link {{Request::is('sajilbidhaa')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sajili Bidhaa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bidhaa') }}" class="nav-link {{Request::is('bidhaa')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bidhaa</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                
                @endcan
                @can('fanya-mauzo')
                <li class="nav-item has-treeview">
                    <a href="{{ route('mauzo') }}" class="nav-link {{Request::is('mauzo')?'active':''}}">
                        <i class="nav-icon fas fa-shopping-cart "></i>
                        <p>
                            Mauzo
                        </p>
                    </a>
                </li>
                @endcan

                @can('fanya-mauzo')

                <li class="nav-item">
                    <a href="{{ route('mauzomuuzaji') }}" class="nav-link {{Request::is('mauzomuuzaji')?'active':''}}">
                        <i class="nav-icon fa  fa-th"></i>
                        <p>
                            Historia ya mauzo
                        </p>
                    </a>
                </li>
            
                @endcan
                @can('ona-order')
                <li class="nav-item">
                    <a href="{{ route('order') }}" class="nav-link {{Request::is('order')?'active':''}}">
                        <i class="nav-icon fa  fa-th"></i>
                        <p>
                            Historia ya Order
                        </p>
                    </a>
                </li>
                @endcan
                
                <li class="nav-item">
                    <a href="{{ route('order') }}" class="nav-link">
                        <i class="nav-icon fa  fa-th"></i>
                        <p>
                            Historia ya Order
                        </p>
                    </a>
                </li>
                
            
                <li class="nav-item">
                    <a href="{{ route('matumizi') }}" class="nav-link {{Request::is('matumizi')?'active':''}}">
                        <i class="nav-icon fa fa-folder-open"></i>
                        <p>
                            Matumizi
                        </p>
                    </a>
                </li>
              
                @can('tengeneza-report')
                <li class="nav-item">
                    <a href="{{ route('report') }}" class="nav-link {{Request::is('report')?'active':''}}">
                        <i class="nav-icon fa fa-folder-open"></i>
                        <p>
                            Ripoti
                        </p>
                    </a>
                </li>
                @endcan
               
                <li class="nav-item has-treeview">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Wasifu
                        </p>
                    </a>
                </li>
                @can('wasimamizi-duka')
                <li class="nav-item">
                    <a href="{{ route('punguzo') }}" class="nav-link {{Request::is('punguzo')?'active':''}}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Mfumo
                        </p>
                    </a>
                </li>
                @endcan
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fa fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


@include('includes/script')