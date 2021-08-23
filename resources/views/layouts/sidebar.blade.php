<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="/">
        <img src="/img/brave_logo.jpeg" style="width: 5rem;">
    </a>
    <div class="sidebar-content">


        <ul class="sidebar-nav">
            <li class="sidebar-item active">
                <a data-bs-target="#" href="{{ route('messages.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span
                        class="align-middle">Communication</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" class="sidebar-link" href="{{ route('humans.index') }}">
                    <i class="align-middle me-2 fas fa-fw fa-users"></i> <span
                        class="align-middle">Humans of NC</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('schedule.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar"></i> <span
                        class="align-middle">NC Scheduling</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('store.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-shopping-cart"></i> <span
                        class="align-middle">Store</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-cogs"></i> <span
                        class="align-middle">Administration</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('departments.index') }}">Manage Departments</a></li>
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('employees.index') }}">Manage User Accounts</a></li>
                </ul>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('documents.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span
                        class="align-middle">Documents</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#issues"  data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-tools"></i> <span
                        class="align-middle">Issues</span>
                </a>
                <ul id="issues" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('tickets.index') }}">Helpdesk</a></li>
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('tickets.index') }}">My Tickets</a></li>
                </ul>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('dutylog.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-clipboard"></i> <span
                        class="align-middle">Duty Logger</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('content.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-share-alt"></i> <span
                        class="align-middle">Content</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#logistics" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-truck"></i> <span
                        class="align-middle">Logistics</span>
                </a>
                <ul id="logistics" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('tracker.index') }}">Mileage tracker</a></li>
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('vehicles.index') }}">Vehicles</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <ul id="logistics" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                </ul>
            </li>

        </ul>
    </div>
</nav>
