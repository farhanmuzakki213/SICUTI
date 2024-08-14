<style>
    .simplebar-content::-webkit-scrollbar {
        width: 12px;
    }

    .simplebar-content::-webkit-scrollbar-track {
        background: #fff;
    }

    .simplebar-content::-webkit-scrollbar-thumb {
        background-color: #000;
        border-radius: 20px;
        border: 3px solid #fff;
    }
</style>


<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('backend/assets/images/profile/user-1.jpg') }}" alt="" width="35"
                            height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2"
                        style="width: 360px;">
                        <div class="message-body">
                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                <img src="{{ asset('backend/assets/images/profile/user-1.jpg') }}"
                                    class="rounded-circle" width="80" height="80" alt="modernize-img">
                                <div class="ms-3">
                                    <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                    <span class="mb-1 d-block">{{Auth::user()->roles->pluck('name')->implode(', ')}}</span>
                                    <p class="mb-0 d-flex align-items-center gap-2">
                                        <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('user.logout') }}"
                                class="btn btn-outline-primary mx-3 mt-2 mb-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new SimpleBar(document.querySelector('.message-body'));
        });
    </script>
</header>
