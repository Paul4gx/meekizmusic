    @include('components.header')
    <x-breadcrumb :title="$title ?? ''" content="" />
    <section class="content-inner bg-white pt-0">
        <div class="container">				
            <div class="row">
                <div class="col-lg-2 p-l0">
                    <div class="site-filters style-3 clearfix sticky-top">
                        <ul class="filters" data-bs-toggle="buttons">
                            <li data-filter="dashboard" class="btn {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}">
                                        <i class="fas fa-home"></i> Dashboard
                                    </a>
                                </li>
                            <li data-filter="wishlist" class="btn {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">
                                <a href="{{ route('wishlist.index') }}">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </a>
                                </li>
                            <li data-filter="purchased" class="btn {{ request()->routeIs('purchased.index') ? 'active' : '' }}">
                                <a href="{{ route('purchased.index') }}">
                                        <i class="fas fa-shopping-cart"></i> Purchased
                                    </a>
                                </li>
                            <li data-filter="profile" class="btn {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                                <a href="{{ route('profile.index') }}">
                                        <i class="fas fa-user"></i> Profile
                                    </a>
                                </li>
                            <li data-filter="settings" class="btn {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                                <a href="{{ route('settings.index') }}">
                                        <i class="fas fa-cog"></i> Settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <div class="col-lg-10">
                    @yield('content')
        </div>
    </div>

        </div>
    </section>

    @include('components.footer')