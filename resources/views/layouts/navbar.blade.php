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
                    <i class="align-middle fas fa-bell"></i>&nbsp;<span>  Notifications</span>
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

            {{-- push-nav-item removed; replaced by floating push button below --}}

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
<style>
@keyframes push-ring {
    0%,100% { transform: translateY(-50%) rotate(0deg); }
    6%  { transform: translateY(-50%) rotate(18deg); }
    12% { transform: translateY(-50%) rotate(-16deg); }
    18% { transform: translateY(-50%) rotate(13deg); }
    24% { transform: translateY(-50%) rotate(-9deg); }
    30% { transform: translateY(-50%) rotate(5deg); }
    36% { transform: translateY(-50%) rotate(0deg); }
}
@keyframes push-glow {
    0%,100% { box-shadow: 0 0 0 0 rgba(39,174,96,.55), 0 4px 14px rgba(0,0,0,.45); }
    50%     { box-shadow: 0 0 0 9px rgba(39,174,96,0),  0 4px 14px rgba(0,0,0,.45); }
}
#push-float-btn {
    position: fixed;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9990;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: none;          /* shown via JS */
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    transition: background .3s, box-shadow .3s;
}
#push-float-btn.push-off {
    background: #e84040;
    box-shadow: 0 4px 14px rgba(0,0,0,.45);
    animation: push-ring 2.8s ease-in-out infinite;
}
#push-float-btn.push-off:hover {
    background: #c0392b;
}
#push-float-btn.push-on {
    background: #27ae60;
    animation: push-glow 2.2s ease-in-out infinite;
    cursor: default;
}
#push-float-btn .push-tooltip {
    position: absolute;
    right: 60px;
    top: 50%;
    transform: translateY(-50%);
    background: #1c1c1c;
    color: #eee;
    font-size: .72rem;
    white-space: nowrap;
    padding: 4px 10px;
    border-radius: 4px;
    pointer-events: none;
    opacity: 0;
    transition: opacity .2s;
    border: 1px solid #333;
}
#push-float-btn:hover .push-tooltip { opacity: 1; }
</style>

<button id="push-float-btn" type="button" title="">
    <i class="fas fa-bell" id="push-float-icon"></i>
    <span class="push-tooltip" id="push-float-tip"></span>
</button>

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

    (function () {
        if (!('Notification' in window) || !('PushManager' in window) || !('serviceWorker' in navigator)) return;

        var btn  = document.getElementById('push-float-btn');
        var icon = document.getElementById('push-float-icon');
        var tip  = document.getElementById('push-float-tip');

        function setEnabled() {
            btn.className  = 'push-on';
            btn.style.display = 'flex';
            icon.className = 'fas fa-bell';
            tip.textContent = 'Push notifications on';
        }

        function setDisabled() {
            btn.className  = 'push-off';
            btn.style.display = 'flex';
            icon.className = 'fas fa-bell-slash';
            tip.textContent = 'Enable push notifications';
            btn.onclick = function () { window.ncSubscribeToPush(); };
        }

        // Check actual subscription state (not just permission)
        navigator.serviceWorker.ready.then(function (reg) {
            return reg.pushManager.getSubscription();
        }).then(function (sub) {
            if (sub && Notification.permission === 'granted') {
                setEnabled();
            } else if (Notification.permission === 'denied') {
                // Blocked — show red but not clickable
                btn.className  = 'push-off';
                btn.style.display = 'flex';
                btn.style.opacity = '0.5';
                btn.style.cursor  = 'not-allowed';
                btn.style.animation = 'none';
                icon.className = 'fas fa-bell-slash';
                tip.textContent = 'Notifications blocked — check browser settings';
            } else {
                setDisabled();
            }
        });

        // After subscribing, switch to green
        var _orig = window.ncSubscribeToPush;
        window.ncSubscribeToPush = function () {
            if (typeof _orig === 'function') {
                _orig();
                // Watch for permission change
                var check = setInterval(function () {
                    if (Notification.permission === 'granted') {
                        clearInterval(check);
                        navigator.serviceWorker.ready.then(function (r) {
                            return r.pushManager.getSubscription();
                        }).then(function (sub) {
                            if (sub) setEnabled();
                        });
                    }
                }, 800);
            }
        };
    })();
</script>
