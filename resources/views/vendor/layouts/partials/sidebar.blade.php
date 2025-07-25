<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('vendor.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Belqas Store</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('vendor.dashboard') }}">
            <i class="fas fa-tachometer-alt mr-2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Products Section -->
    <div class="sidebar-heading">Products Management</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                aria-expanded="true" aria-controls="collapseProducts">
                <i class="fas fa-box-open mr-2"></i>
                <span>Products</span>
            </a>
            <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Product Status</h6>
                    
                    <a class="collapse-item" href="{{ route('vendor.products.index') }}">
                        <i class="fas fa-list mr-2 text-secondary"></i>All
                    </a>

                    <a class="collapse-item" href="{{ route('vendor.products.index', ['status' => 'approved']) }}">
                        <i class="fas fa-check-circle mr-2 text-success"></i>Approved
                    </a>

                    <a class="collapse-item" href="{{ route('vendor.products.index', ['status' => 'pending']) }}">
                        <i class="fas fa-hourglass-half mr-2 text-primary"></i>Pending
                    </a>

                    <a class="collapse-item" href="{{ route('vendor.products.index', ['status' => 'rejected']) }}">
                        <i class="fas fa-times-circle mr-2 text-danger"></i>Rejected
                    </a>

                    <a class="collapse-item" href="{{ route('vendor.products.index', ['status' => 'archived']) }}">
                        <i class="fas fa-archive mr-2 text-muted"></i>Archived
                    </a>

                    <a class="collapse-item" href="{{ route('vendor.products.index', ['in_stock' => 0]) }}">
                        <i class="fas fa-boxes mr-2 text-warning"></i>Out of Stock
                    </a>

                </div>
            </div>
        </li>


    <hr class="sidebar-divider">

    <!-- Tools & Features -->
    <div class="sidebar-heading">Tools & Features</div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-envelope mr-2"></i>
            <span>Messages</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-star mr-2"></i>
            <span>Reviews</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-tags mr-2"></i>
            <span>Coupons</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-chart-bar mr-2"></i>
            <span>Analytics</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-users mr-2"></i>
            <span>Followers</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- User Account -->
    <div class="sidebar-heading">User Account</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount"
            aria-expanded="true" aria-controls="collapseAccount">
            <i class="fas fa-user-cog mr-2"></i>
            <span>Account</span>
        </a>
        <div id="collapseAccount" class="collapse" aria-labelledby="headingAccount" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Panel</h6>
                <a class="collapse-item" href="#"><i class="fas fa-id-card mr-2"></i>Profile</a>
                <a class="collapse-item" href="#"><i class="fas fa-user-edit mr-2"></i>Edit Profile</a>
            </div>
        </div>
    </li>

    <!-- Settings -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
            aria-expanded="true" aria-controls="collapseSettings">
            <i class="fas fa-cogs mr-2"></i>
            <span>Settings</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Authentication</h6>
                <a class="collapse-item" href="#"><i class="fas fa-unlock-alt mr-2"></i>Forgot Password</a>
                <a class="collapse-item" href="#"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
