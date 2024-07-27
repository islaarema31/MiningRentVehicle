<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mining Rent Vehicle</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('order') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('order') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Order</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    @php
        $role = Auth::user()->role;
    @endphp
    @if ($role == 'admin')
        <li class="nav-item {{ request()->routeIs('logactivity') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('logactivity') }}">
                <i class="fas fa-list fa-sm fa-fw "></i>
                <span>Log Activity</span></a>
        </li>
    @endif

</ul>
<!-- End of Sidebar -->