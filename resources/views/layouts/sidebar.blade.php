<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="/">
        <img src="/img/logo.gif" style="width: 10rem;">
    </a>
    <div class="sidebar-content">


        <ul class="sidebar-nav">
            <li @if (Route::is('messages.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('messages.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span class="align-middle">Communication</span>
                </a>
            </li>
            <li @if (Route::is('awards.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" class="sidebar-link" href="{{ route('awards.index') }}">
                    <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">Awards</span>
                </a>
            </li>
            <li @if (Route::is('appointments.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('appointments.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span class="align-middle">Appointments</span>
                </a>
            </li>
            <li @if (Route::is('schedule.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('schedule.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar"></i> <span class="align-middle">
                        Scheduling</span>
                </a>
            </li>
            @can('access-store')
            <li @if (Route::is('store.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('store.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-shopping-cart"></i> <span class="align-middle">Store
                        Manager</span>
                </a>
            </li>
            @endcan
            <li @if (Route::is('documents.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('documents.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span class="align-middle">Docs</span>
                </a>
            </li>
            @can('fix-issues')
            <li @if (Route::is('tickets.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#issues" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-tools"></i> <span class="align-middle">Issues</span>
                </a>
                <ul id="issues" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                            href="{{ route('issues.index',['type' => 'raised']) }}">Raised Issues</a></li>
                            @can('fix-issues')
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('issues.index') }}">
                            All Issues</a></li>

                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('ipaddresses.index') }}">
                                Get Unused IPaddress</a></li>
                            @endcan
                </ul>
            </li>
            @endcan
            @can('cot-admin')

            {{-- <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('cot.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Certificate of Broadcast</span>
                </a>
            </li> --}}

            @endcan

            @can('access-sales-production')
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('sales-production.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar"></i><span class="align-middle">Sales Production Scheduler</span>
                </a>
            </li>
            @endcan

            @can('fix-issues')
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('maintenance-schedule.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-calendar"></i><span class="align-middle">Maintenance Scheduler</span>
                </a>
            </li>
            @endcan


            <li class="sidebar-item">
                <a data-bs-target="#reports" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Reports</span>
                </a>
                <ul id="reports" @if (Route::is('reports.*','mcr.*','editors.*','oblogs.*','production.*','engineers.*','prompter.*','transmission.*')) class="sidebar-dropdown list-unstyled " @else class="sidebar-dropdown list-unstyled collapse" @endif data-bs-parent="#sidebar">
                    @canany(['access-dir_reports', 'access-dir_reports-readonly'])
                    <li @if (Route::is('reports.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('reports.index') }}"> <i
                                class="align-middle me-2 fas fa-clipboard-check"></i> <span
                                class="align-middle">Director's Report</span></a></li>
                                @endcanany
                                @can('fix-issues')
                                <li @if (Route::is('engineers.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('engineers.index') }}"> <i
                                    class="align-middle me-2 fas fa-clipboard-check"></i> <span
                                    class="align-middle">Engineer/IT Logs</span></a></li>

                                @endcan
                                @canany(['access-editor_logs', 'access-editor_logs-readonly'])
                    <li @if (Route::is('editors.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('editors.index') }}"> <i
                                class="align-middle me-2 fas fa-video"></i> <span class="align-middle">Video Editors
                                Reports</span></a></li>
                                @endcanany
                                @canany(['access-ob_logs', 'access-ob_logs-readonly'])
                    <li @if (Route::is('oblogs.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('oblogs.index') }}"> <i
                                class="align-middle me-2 fas fa-shipping-fast"></i> <span class="align-middle">OB
                                Logs</span></a></li>
                                @endcanany
                                @canany(['access-mcr_logs', 'access-mcr_logs-readonly'])
                    <li @if (Route::is('mcr.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('mcr.index') }}"> <i
                                class="align-middle me-2 fas fa-file-video"></i> <span class="align-middle">MCR
                                Logs</span></a></li>
                                @endcanany
                                @canany(['access-production_show_logs', 'access-production_show_logs-readonly'])
                    <li @if (Route::is('production.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('production.index') }}"> <i
                                class="align-middle me-2 fas fa-tag"></i> <span class="align-middle">Production Show
                                Logs</span></a></li>
                                @endcanany
                                @canany(['access-ob_logs', 'access-ob_logs-readonly'])
                                <li @if (Route::is('graphics-news.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('graphics-news.index') }}"> <i
                                    class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Graphics Logs (News)</span></a></li>
                                    <li @if (Route::is('graphics.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('graphics-shows.index') }}"> <i
                                        class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Graphics Logs (Shows)</span></a></li>
                                        @endcanany
                    {{-- <li @if (Route::is('engineer.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('engineers.index') }}"> <i
                                class="align-middle me-2 fas fa-wrench"></i> <span class="align-middle">Engineer
                                Logs</span></a></li> --}}
                                @canany(['access-prompter_logs', 'access-prompter_logs-readonly'])
                                 <li @if (Route::is('prompter-news.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('prompter-news.index') }}"> <i
                                class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Prompter
                                Logs (News)</span></a></li>
                                <li @if (Route::is('prompter-shows.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('prompter-shows.index') }}"> <i
                                    class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Prompter
                                    Logs (Shows)</span></a></li>
                                @endcanany
                    {{-- <li @if (Route::is('transmission.*')) class="sidebar-item active" @else class="sidebar-item" @endif><a class="sidebar-link" href="{{ route('transmission.index') }}"> <i
                                class="align-middle me-2 fas fa-file-alt"></i> <span class="align-middle">Transmission
                                Logs</span></a></li> --}}

                </ul>
            </li>
            @can('add-content-calendar')
            <li @if (Route::is('content.*')) class="sidebar-item active " @else class="sidebar-item" @endif>
                <a data-bs-target="#" href="{{ route('content.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-share-alt"></i> <span class="align-middle">Content
                        Calendar</span>
                </a>
            </li>
            @endcan

            @can('access-logistics')
            <li @if (Route::is('triplogger.*', 'vehicles.*, tracker.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#logistics" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-truck"></i> <span class="align-middle">Logistics</span>
                </a>
                <ul id="logistics" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('vehicles.index') }}"> <i
                                class="align-middle me-2 fas fa-car"></i> <span class="align-middle">Vehicle
                                Manager</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('triplogger.index') }}"><i
                                class="align-middle me-2 fas fa-file"></i> <span class="align-middle">Trip
                                Logger</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('tracker.index') }}"><i
                                class="align-middle me-2 fas fa-chart-line"></i> <span class="align-middle">Mileage
                                Tracker</span></a></li>
                </ul>
            </li>
            @endcan
            @canany(['is-manager'])
            <li @if (Route::is('departments.*', 'employees.*')) class="sidebar-item active" @else class="sidebar-item" @endif>
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-cogs"></i> <span
                        class="align-middle">Administration</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    @can('manage-departments')
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('departments.index') }}"><i
                                class="align-middle me-2 fas fa-id-card"></i> <span class="align-middle">Manage
                                Departments</span></a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('facility.index') }}"><i
                                    class="align-middle me-2 fas fa-building"></i> <span class="align-middle">Manage
                                    Facility</span></a></li>
                                @endcan

                                @can('manage-users')
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('employees.index') }}"><i
                                class="align-middle me-2 fas fa-users-cog"></i> <span class="align-middle">Manage User
                                Accounts</span></a></li>

                                    @endcan
                                    @can('role-create')
                                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('roles.index') }}"><i
                                    class="align-middle me-2 fas fa-users-cog"></i> <span class="align-middle">Manage Roles
                                </span></a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('jobs.index') }}"><i
                                    class="align-middle me-2 fas fa-cogs"></i> <span class="align-middle">Manage Queued jobs
                                </span></a></li>
                                @endcan

                </ul>
            </li>
                     @endcanany
            <li class="sidebar-item ">
                <a data-bs-target="#" href="{{ route('analytics.index') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-share-alt"></i> <span class="align-middle">Analytics</span>
                </a>
            </li>
            <li class="sidebar-item">
                <ul  class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                </ul>
            </li>

        </ul>
    </div>
</nav>
