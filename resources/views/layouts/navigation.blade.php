<div class="admin-sidebar">
    <div class="admin-sidebar-inner">
        <div class="admin-sidebar-header">
            <div class="admin-logo">
                <a href="{{ route('admin.dashboard') }}">
                    <h2 class="text-white">{{ config('app.name') }}</h2>
                </a>
            </div>
        </div>
        <div class="admin-sidebar-body">
            <ul class="admin-menu">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.beats.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.beats.index') }}">
                        <i class="fas fa-music"></i>
                        <span>Beats</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <style>
        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            background: #2c3e50;
            color: #fff;
            z-index: 1000;
        }

        .admin-sidebar-inner {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .admin-sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .admin-logo a {
            text-decoration: none;
            color: #fff;
        }

        .admin-logo h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .admin-sidebar-body {
            flex: 1;
            padding: 1rem 0;
        }

        .admin-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-menu li {
            margin: 0;
            padding: 0;
        }

        .admin-menu li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .admin-menu li a:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }

        .admin-menu li.active a {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }

        .admin-menu li i {
            width: 20px;
            margin-right: 10px;
        }

        /* Adjust main content area to account for sidebar */
        .admin-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-content {
                margin-left: 0;
            }
        }
    </style>
</div>

<!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler border-0" type="button" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                         alt="{{ Auth::user()->name }}" 
                         class="rounded-circle"
                         style="width: 32px; height: 32px; object-fit: cover;">
                    <span class="ms-2">{{ Auth::user()->name }}</span>
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
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle sidebar toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
});
</script> 