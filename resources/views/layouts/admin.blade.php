@include('components.header')
<section class="content-inner bg-white">
    <div class="container">				
        <div class="row justify-content-between align-items-end border-bottom m-lg-b50 m-b10">
            <div class="text-center text-xl-start col-xl-6 p-lg-0">
                <div class="section-head  style-1 m-0">
                    <h3 class="title wow flipInX" style="font-weight: 600" data-wow-delay="0.4s">@yield('title')</h3>
                </div>
            </div>
            {{-- <div class="text-center text-xl-end col-xl-6 m-b30 p-lg-0">
                <a href="blog-standard.html" class="btn-link btn-gradient wow flipInX" data-wow-delay="0.6s">VIEW ALL SOLUTION</a>
            </div> --}}
        </div>

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

    {{-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles') --}}
                {{-- <div class="admin-header-right">
                    <div class="admin-user-menu">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="admin-avatar">
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}

