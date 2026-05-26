@auth
<nav class="navbar navbar-expand navbar-theme">
    <a class="sidebar-toggle d-flex me-2">
        <i class="hamburger align-self-center"></i>
    </a>


    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">

            @if (count(Session::get('allRequestedItems', []))>0)
                <li class="nav-item dropdown ms-lg-2">
                    <a style="color:orange" class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                    data-bs-toggle="dropdown">
                    <i class="align-middle fas fa-cart-plus"></i>&nbsp;
                    <span> Batch</span>
                    @if(count(Session::get('allRequestedItems', [])) > 0)
                        <span class="badge">{{ count(Session::get('allRequestedItems', [])) }}</span>
                    @endif
                 </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <a  id="clear-batch-link"  class="dropdown-item" href="#"><i
                                class="align-middle me-1 fas fa-fw fa-eye"></i>
                            View Items in Batch</a>
                        <a class="dropdown-item" href="{{ route('store.requests.batch.clear') }}"><i
                                class="align-middle me-1 fas fa-fw fa-ban"></i> Clear current batch</a>
                    </div>
                </li>
                @include('layouts.components.batch-modal')
                @endif
            <li class="nav-item dropdown ms-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                    data-bs-toggle="dropdown">
                    <i class="align-middle fas fa-calendar-plus"></i>&nbsp;<span>  Bookings</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('booking.index', ['type'=>'boardroom']) }}"><i class="align-middle me-1 fas fa-fw fa-podcast"></i>
                        Book Boardroom</a>
                        <a class="dropdown-item" href="{{route('appointments.create') }}"><i class="align-middle me-1 fas fa-fw fa-calendar"></i>
                            Book an Appointment</a>

                    <a class="dropdown-item" href="{{route('booking.index', ['type'=>'studio']) }}"><i
                            class="align-middle me-1 fas fa-fw fa-film"></i> Book a Studio</a>
                </div>
            </li>
            <li class="nav-item dropdown ms-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                    data-bs-toggle="dropdown">
                    <i class="align-middle fas fa-tools"></i>&nbsp;<span>  Support</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('store-requests.index')}}"><i class="align-middle me-1 fas fa-fw fa-cart-plus"></i>
                        Request Item from Store</a>

                        <a class="dropdown-item" href="{{route('ipaddresses.index')}}"><i class="align-middle fas fa-tools"></i>
                            Get Unused Address</a>
                    <a class="dropdown-item" href="{{route('issues.create')}}"><i
                            class="align-middle me-1 fas fa-fw fa-exclamation-triangle"></i> Report  Tech Problem</a>
                </div>
            </li>

            @role('Admin')
            <li class="nav-item dropdown ms-lg-2" id="notif-bell-item">
                <a class="nav-link position-relative" href="#" id="notifDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                    <i class="align-middle fas fa-bell"></i>
                    <span id="notif-badge" style="display:none;position:absolute;top:4px;right:2px;
                          background:#e84040;color:#fff;border-radius:50%;font-size:0.6rem;
                          min-width:16px;height:16px;line-height:16px;text-align:center;padding:0 3px;"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notifDropdown"
                    style="min-width:320px;max-width:360px;">
                    <div class="d-flex justify-content-between align-items-center px-3 py-2"
                        style="border-bottom:1px solid #333;background:#1c1c1c;">
                        <strong style="font-size:.85rem;">Notifications</strong>
                        <button id="notif-mark-read" class="btn btn-link btn-sm p-0 text-muted"
                            style="font-size:.75rem;">Mark all read</button>
                    </div>
                    <div id="notif-list" style="max-height:340px;overflow-y:auto;">
                        <div id="notif-empty" class="text-center text-muted py-4" style="font-size:.82rem;">
                            No new notifications
                        </div>
                    </div>
                </div>
            </li>
            @endrole

            <li class="nav-item ms-lg-2" id="push-nav-item" style="display:none;">
                <a class="nav-link" href="#" onclick="window.ncSubscribeToPush();return false;" title="Enable push notifications">
                    <i class="align-middle fas fa-bell-slash"></i>
                </a>
            </li>

            <li class="nav-item dropdown ms-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                    data-bs-toggle="dropdown">
                    <i class="align-middle fas fa-user"></i>&nbsp;<span>  {{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('employees.show', Auth::user()->id ) }}"><i class="align-middle me-1 fas fa-fw fa-user"></i>
                        Profile</a>
                    <a class="dropdown-item" href="#"><i
                            class="align-middle me-1 fas fa-fw fa-keyboard"></i> Change Password</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i
                            class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>

</nav>
@endauth
<script>
    $(document).ready(function () {
        const batchModalEl = document.getElementById('batch-modal');
        const batchModal = batchModalEl ? new bootstrap.Modal(batchModalEl) : null;

        $('#clear-batch-link').click(function () {
            if (batchModal) batchModal.show();
        });

        $('#change-password-cancel').click(function (event) {
            event.preventDefault();
            if (batchModal) batchModal.hide();
        });
    });

    // Show bell icon only when push is supported and not yet permitted
    if ('Notification' in window && 'PushManager' in window && Notification.permission === 'default') {
        document.getElementById('push-nav-item').style.display = 'block';
    }
</script>
