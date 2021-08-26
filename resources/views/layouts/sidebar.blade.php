<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="/">
        <img src="/img/brave_logo.jpeg" style="width: 5rem;">
    </a>
    <div class="sidebar-content">


        <ul class="sidebar-nav">
            <li @if(Route::is('messages.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('messages.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span
                        class="align-middle">Communication</span>
                </a>
            </li>
            <li @if(Route::is('humans.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" class="sidebar-link" href="{{ route('humans.index') }}">
                    <i class="align-middle me-2 fas fa-fw fa-users"></i> <span
                        class="align-middle">Awards</span>
                </a>
            </li>
            <li @if(Route::is('schedule.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('schedule.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar"></i> <span
                        class="align-middle"> Scheduling</span>
                </a>
            </li>
            <li @if(Route::is('store.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('store.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-shopping-cart"></i> <span
                        class="align-middle">Store Manager</span>
                </a>
            </li>
            <li @if(Route::is('documents.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('documents.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span
                        class="align-middle">Docs</span>
                </a>
            </li>
            <li @if(Route::is('tickets.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
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
            <li @if(Route::is('issues.*') ) class="sidebar-item " @else class="sidebar-item" @endif>
                <a data-bs-target="#reports"  data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-chart-bar"></i> <span
                        class="align-middle">Reports</span>
                </a>
                <ul id="reports" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('reports.index') }}"> <i class="align-middle me-2 fas fa-clipboard-check"></i> <span
                        class="align-middle">Director's Report</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('oblogs.index') }}"> <i class="align-middle me-2 fas fa-shipping-fast"></i> <span
                        class="align-middle">OB Logs</span></a></li>
                </ul>
            </li>
            <li @if(Route::is('content.*') ) class="sidebar-item active " @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('content.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-share-alt"></i> <span
                        class="align-middle">Content Calendar</span>
                </a>
            </li>
            <li @if(Route::is('issues.*', 'vehicles.*, tracker.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#logistics" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-truck"></i> <span
                        class="align-middle">Logistics</span>
                </a>
                <ul id="logistics" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('tracker.index') }}">  <i class="align-middle me-2 fas fa-car"></i> <span
                        class="align-middle">Vehicle Manager</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('vehicles.index') }}"><i class="align-middle me-2 fas fa-file"></i> <span
                        class="align-middle">Trip Logger</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link"
                            href="{{ route('vehicles.index') }}"><i class="align-middle me-2 fas fa-chart-line"></i> <span
                            class="align-middle">Mileage Tracker</span></a></li>
                </ul>
            </li>
            <li @if(Route::is('departments.*', 'employees.*') ) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-cogs"></i> <span
                        class="align-middle">Administration</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('departments.index') }}"><i class="align-middle me-2 fas fa-id-card"></i> <span
                        class="align-middle">Manage Departments</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('employees.index') }}"><i class="align-middle me-2 fas fa-users-cog"></i> <span
                        class="align-middle">Manage User Accounts</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('content.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-share-alt"></i> <span
                        class="align-middle">Analysis</span>
                </a>
            </li>
            <li class="sidebar-item">
                <ul id="logistics" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                </ul>
            </li>

        </ul>
    </div>
</nav>
