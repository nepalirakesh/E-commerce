<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span><br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/person.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{Request::routeIs('admin.dashboard')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>


                <li class="nav-item @yield('user_select') {{Request::routeIs('users*')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('users*')?'active':''}}">
                        <i class="nav-icon fas fa-users"></i>

                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item @yield('user_select')  ">
                            <a href="/admin/users" class="nav-link {{Request::routeIs('users*')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Users</p>
                            </a>
                        </li>




                    </ul>
                </li>
                <li class="nav-item {{Request::routeIs('product.index')||Request::routeIs('product.create')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('product.*')?'active':''}}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Manage Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link {{Request::routeIs('product.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}" class="nav-link {{Request::routeIs('product.create')?'active':''}} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Products</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::routeIs('category.index')||Request::routeIs('category.create')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('category.*')?'active':''}}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Manage Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{Request::routeIs('category.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link {{Request::routeIs('category.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::routeIs('orders*')?'menu-open':''}}">
                    <a href="#" class="nav-link  {{Request::routeIs('orders*')?'active':''}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="/admin/orders" class="nav-link  {{Request::routeIs('orders.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Details</p>
                            </a>
                        </li>




                    </ul>
                </li>
            </ul>
            <ul class="nav navbar">
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->