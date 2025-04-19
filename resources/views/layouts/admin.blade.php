@include('components.header')
<x-breadcrumb :title="$title ?? 'Admin'" content="" />
<section class="content-inner bg-white">
    <div class="container">				
        <div class="row">
            <div class="col-lg-2 p-l0">
                <div class="site-filters style-3 clearfix sticky-top">
                    <ul class="filters" data-bs-toggle="buttons">
                            <li class="btn {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="btn {{ request()->routeIs('admin.beats.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.beats.index') }}">
                                    <i class="fas fa-music"></i>
                                    <span>Beats</span>
                                </a>
                            </li>
                            <li class="btn {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.orders.index') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li class="btn {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                            <li class="btn {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.index') }}">
                                    <i class="fas fa-cog"></i>
                                    <span>Settings</span>
                                </a>
                            </li>
                    
                        </ul>
                    </div>
                </div>
            <div class="col-lg-10">
                <div class="admin-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
    
                    @yield('content')
                </div>
            </div>
</div>

    </div>
</section>

@include('components.footer')

