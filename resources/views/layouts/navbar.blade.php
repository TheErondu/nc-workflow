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
        const batchModal = new bootstrap.Modal($('#batch-modal'));

        $('#clear-batch-link').click(function () {
            batchModal.show();
        });

        $('#change-password-cancel').click(function (event) {
            event.preventDefault();
            batchModal.hide();
        });
    });
</script>
