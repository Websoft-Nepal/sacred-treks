<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Heading -->
    <div class="sidebar-heading">
        Manage
    </div>
    {{-- Trekking  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrekking"
            aria-expanded="true" aria-controls="collapseTrekking">
            <i class="fas fa-hiking"></i>
            <span>Trekking</span>
        </a>
        <div id="collapseTrekking" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Trekking:</h6>
                <a class="collapse-item" href="{{ route('admin.trekking.create') }}">create</a>
                <a class="collapse-item" href="{{ route('admin.trekking.index') }}">index</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Location:</h6>
                <a class="collapse-item" href="{{ route('admin.location.index') }}">index</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blog.index') }}">
            <i class="fas fa-book-open"></i>
            <span>Blog</span></a>
    </li>

    {{-- Tour  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTour"
            aria-expanded="true" aria-controls="collapseTour">
            <i class="fas fa-compass"></i>
            <span>Tour</span>
        </a>
        <div id="collapseTour" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tour:</h6>
                <a class="collapse-item" href="{{ route('admin.tour.create') }}">create</a>
                <a class="collapse-item" href="{{ route('admin.tour.index') }}">index</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Transportation:</h6>
                <a class="collapse-item" href="{{ route('admin.transportation.index') }}">index</a>
            </div>
        </div>
    </li>

    {{-- Bookings  --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooking"
            aria-expanded="true" aria-controls="collapseBooking">
            <i class="fas fa-compass"></i>
            <span>Bookings</span>
        </a>
        <div id="collapseBooking" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bookings:</h6>
                <a class="collapse-item" href="{{ route('admin.tour.booking.index') }}">Tours</a>
                <a class="collapse-item" href="{{ route('admin.trekking.booking.index') }}">Trekkings</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.social.index')}}">
            <i class="fas fa-globe"></i>
            <span>Social Media</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.privacy.index')}}">
            <i class="fas fa-lock"></i>
            <span>Privacy</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.terms.index')}}">
            <i class="fas fa-file-alt"></i>
            <span>Terms</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.contact.index')}}">
            <i class="fas fa-envelope"></i>
            <span>Contact</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
