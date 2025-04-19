<!-- Header Start -->
<header class="site-header mo-left header header-text-white style-1">
<!-- Main Header -->
<div class="sticky-header main-bar-wraper navbar-expand-lg">
    <div class="main-bar clearfix">
        <div class="container-fluid clearfix d-lg-flex d-block">
            <!-- Website Logo -->
            <div class="logo-header mostion">
                <a href="{{ route('home') }}" class="logo-dark">
                    <img src="{{ asset('/assets/images/logo.svg') }}" alt="Meekismusic">
                </a>
            </div>
            
            <!-- Nav Toggle Button -->
            <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <!-- Main Nav -->
            <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                <div class="logo-header">
                    <a href="{{ route('home') }}" class="logo-dark">
                        <img src="{{ asset('/assets/images/logo.svg') }}" alt="Meekismusic">
                    </a>
                </div>
                <ul class="nav navbar-nav dark-nav">
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}"><span>Home</span></a>
                    </li>
                    <li class="has-mega-menu sub-menu-down {{ request()->routeIs('marketplace.index') ? 'active' : '' }}">
                        <a href="{{ route('marketplace.index') }}"><span>Marketplace</span><i class="fas fa-chevron-down"></i></a>
                        <div class="mega-menu">
                            <div class="row">
                                <div class="col-lg-3">
                                    <a href="{{ route('marketplace.index') }}" class="menu-title">Browse by Genre</a>
                                    <ul>
                                        @forelse(allgenres() as $genre)
                                            <li><a href="{{ route('marketplace.index', ['genre' => $genre->slug]) }}">{{ $genre->name }}</a></li>
                                        @empty
                                            <li>No music genres yet</li>
                                        @endforelse
                                        <li><a href="{{ route('marketplace.index') }}">View All Genres</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3">
                                    <a href="{{ route('marketplace.index') }}" class="menu-title">Search by Keywords</a>
                                    <ul>
                                        <li><a href="{{ route('marketplace.index', ['sort' => 'popular']) }}">Popular Keywords</a></li>
                                        <li><a href="{{ route('marketplace.index', ['sort' => 'recent']) }}">Recent Searches</a></li>
                                        <li><a href="{{ route('marketplace.index') }}">Advanced Search</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3">
                                    <a href="{{ route('marketplace.index') }}" class="menu-title">Browse by Tags</a>
                                    <ul>
                                        <li><a href="{{ route('marketplace.index', ['tag' => 'popular']) }}">Popular Tags</a></li>
                                        <li><a href="{{ route('marketplace.index', ['tag' => 'mood']) }}">Mood</a></li>
                                        <li><a href="{{ route('marketplace.index', ['tag' => 'instruments']) }}">Instruments</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="{{ request()->routeIs('marketplace.afrobeat') ? 'active' : '' }}">
                        <a href="{{ route('marketplace.afrobeat') }}"><span>Afrobeat</span></a>
                    </li>
                    <li class="{{ request()->routeIs('marketplace.featured') ? 'active' : '' }}">
                        <a href="{{ route('marketplace.featured') }}"><span>Featured</span></a>
                    </li>
                    <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        <a href="{{ route('contact') }}"><span>Contact</span></a>
                    </li>
                </ul>
            </div>

            <!-- Extra Nav -->
            <div class="extra-nav">
                <div class="extra-cell">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <span>Login</span>
                    </a>
                @else
                    <div class="dropdown">
                        <button class="btn {{(Auth::user()->role === 'admin')?'btn-dark':'btn-primary'}} dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="la la-user-circle me-2"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if (Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.beats.index') }}">Beats</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Users</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}">Settings</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('wishlist.index') }}">Wishlist</a></li>
                                <li><a class="dropdown-item" href="{{ route('purchased.index') }}">Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
                            @endif
                
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
                
                </div>
            </div>
        </div>
    </div>
</div>
</header> 