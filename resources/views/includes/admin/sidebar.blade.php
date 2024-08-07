<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="mt-0">
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/img/logos/logo-puskesmas-png-3.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin-dokter.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-stethoscope"></i>
                        </span>
                        <span class="hide-menu">Data Spesialis</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('user-index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-report-medical"></i>
                        </span>
                        <span class="hide-menu">Data Pasien</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pelayanan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin-jadwal.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-clipboard-data"></i>
                        </span>
                        <span class="hide-menu">Jadwal</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin-antrian') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>

                        </span>

                        <span class="hide-menu">Antrian</span>
                    </a>
                </li>


            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
