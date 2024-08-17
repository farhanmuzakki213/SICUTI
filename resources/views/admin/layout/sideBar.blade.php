@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/side-drop.css') }}" />
@endsection


<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between my-3 mb-3">
            <a class="text-nowrap logo-img ms-auto me-auto">
                <img class="centered-image" src="{{ asset('assets/img/logo/logo-transparant.png') }}" width="100"
                    alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @hasanyrole('manager|staff|assistant')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-aperture"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data Master</span>
                    </li>
                    @hasrole('manager')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('karyawan') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Data Karyawan</span>
                            </a>
                        </li>
                    @endhasrole
                @endhasanyrole
                @hasanyrole('manager|staff|assistant|employee')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span class="d-flex">
                                <i class="ti ti-briefcase"></i>
                            </span>
                            <span class="hide-menu">Data Cuti</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item dropdown-item-custom">
                                <a href="{{ url('dataCuti') }}" class="sidebar-link dropdown-item-custom">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    @if (auth()->user()->roles->pluck('name')->implode(', ') == 'employee')
                                        <span class="hide-menu">My History</span>
                                    @else
                                        <span class="hide-menu">Cuti Karyawan</span>
                                    @endif

                                </a>
                            </li>
                            @hasrole('employee')
                                <li class="sidebar-item dropdown-item-custom">
                                    <a href="{{ url('pengajuanCuti/create') }}" class="sidebar-link dropdown-item-custom">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Pengajuan Cuti</span>
                                    </a>
                                </li>
                            @endhasrole
                        </ul>
                    </li>
                @endhasanyrole
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
