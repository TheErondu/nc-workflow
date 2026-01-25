# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

A CRM system for broadcast media companies built on Laravel 8. The application manages various broadcast operations including scheduling, engineering logs, production tracking, sales, content management, equipment maintenance, and signage displays.

## Technology Stack

- **Backend**: Laravel 8 (PHP 7.3+/8.0+)
- **Frontend**: Vue.js 3 with Laravel Mix for asset compilation
- **Authentication**: Laravel Sanctum for API authentication, built-in Auth for web
- **Authorization**: Spatie Laravel Permission for role-based access control
- **Key Packages**:
  - `yajra/laravel-datatables-oracle` - DataTables server-side processing
  - `maatwebsite/excel` - Excel import/export functionality
  - `arielmejiadev/larapex-charts` - Chart generation
  - `spatie/laravel-query-builder` - Advanced query building
  - `rap2hpoutre/laravel-log-viewer` - Log viewing (Admin only)
  - `barryvdh/laravel-debugbar` - Debug toolbar (dev environment)

## Development Commands

### Setup
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file and generate application key
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed database (if seeders exist)
php artisan db:seed
```

### Development
```bash
# Serve application locally
php artisan serve

# Watch and compile frontend assets
npm run watch

# Compile assets for development
npm run dev

# Compile assets for production
npm run production

# Clear and cache configuration (use after config changes)
php artisan config:cache

# Clear route cache
php artisan route:clear

# Cache routes for performance
php artisan route:cache

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Performance optimization (warmup)
composer warmup
# This runs: config:cache and route:cache
```

### Testing
```bash
# Run all tests
php artisan test
# or
vendor/bin/phpunit

# Run specific test suite
vendor/bin/phpunit --testsuite=Feature
vendor/bin/phpunit --testsuite=Unit

# Run specific test file
vendor/bin/phpunit tests/Feature/ExampleTest.php
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Refresh database (rollback and re-run all migrations)
php artisan migrate:refresh

# Generate migration from existing database
php artisan migrate:generate
```

### Code Generation
```bash
# Create controller
php artisan make:controller ControllerName

# Create model with migration
php artisan make:model ModelName -m

# Create model with migration, factory, and seeder
php artisan make:model ModelName -mfs

# Create middleware
php artisan make:middleware MiddlewareName

# Create event
php artisan make:event EventName

# Create listener
php artisan make:listener ListenerName --event=EventName

# Create mail class
php artisan make:mail MailClassName
```

## Architecture Overview

### Event-Driven System

The application uses Laravel's event/listener pattern for notifications and record tracking:

- **Events** (`app/Events/`):
  - `RecordCreatedEvent` - Fired when new records are created
  - `RecordUpdatedEvent` - Fired when records are updated
  - `TicketCreatedEvent` - Fired when issue tickets are created
  - `TicketUpdatedEvent` - Fired when tickets are updated
  - `EngineerAssignedEvent` - Fired when engineers are assigned to tasks
  - `UserLoggedIn` - Fired on user login

- **Listeners** (`app/Listeners/`): Corresponding listeners send email notifications for each event

- **Mail Classes** (`app/Mail/`): Mailable classes for different notification types

Event-listener mappings are registered in `app/Providers/EventServiceProvider.php`.

### Mailing System

Two helper systems for sending emails:

1. **MailingLists Helper** (`app/Helpers/MailingLists.php`): Generates CC recipient lists based on roles and departments
2. **Globals Utility** (`app/Utils/Globals.php`): Provides mailing groups by department (e.g., "Engineers")

### Authentication & Authorization

- **Web Auth**: Standard Laravel authentication with role-based middleware
- **API Auth**: Laravel Sanctum for token-based authentication
- **Roles**: Managed via Spatie Permission package
  - Admin role has access to logs viewer (`/logs`) and log dumping
  - Role-based route groups in `routes/web.php` (e.g., `middleware => ['role:Admin']`)
  - All authenticated routes wrapped in `auth` middleware

### API Structure

- **API Routes** (`routes/api.php`):
  - Public endpoints for schedule/calendar data (multiple calendar views)
  - Authentication endpoints (`/api/login`, `/api/logout`)
  - Protected endpoints behind `auth:sanctum` middleware
  - Separate API controllers in `app/Http/Controllers/API/`

### Key Domain Models

The application manages these core business entities (all in `app/Models/`):

**Broadcasting Operations**:
- `EngineerLogs`, `EditorLogs`, `McrLogs`, `OBlogs` - Production/broadcast logs
- `GraphicsLogs`, `GraphicsLogShows` - Graphics department logs
- `PrompterLogs`, `PrompterLogShows` - Prompter logs
- `ProductionShowLogs` - Production show tracking
- `TransmissionReport` - Transmission reports

**Scheduling & Planning**:
- `Schedule` - Production scheduling
- `SalesSchedule` - Sales production schedule
- `Appointment` - Appointments/meetings
- `Booking` - Resource bookings

**Content & Assets**:
- `Content` - Content items
- `Signage`, `Screen` - Digital signage management

**Operations**:
- `Issue` - Issue/ticket tracking
- `MaintenanceScheduler` - Equipment maintenance scheduling
- `GatePass` - Gate pass management
- `Dutylogger`, `TripLogger` - Duty and trip logs

**Resources**:
- `Employee`, `Department` - Staff management
- `Facility`, `FacilityType` - Facility management
- `Vehicle` - Vehicle tracking
- `Store`, `StoreRequest`, `BatchStoreRequest` - Inventory/store requests

**System**:
- `User`, `Role` - Users and roles
- `Message`, `Document` - Communications and documents
- `COT` - Change over time logs

### Controller Organization

Controllers follow Laravel resource conventions (`app/Http/Controllers/`):
- Web controllers handle CRUD operations for web routes
- API controllers (`app/Http/Controllers/API/`) serve JSON responses
- Most controllers use Laravel resource routing (`Route::resource()`)
- Special controllers:
  - `HomeController` - Dashboard
  - `SignageController` - Digital signage management (both admin and display views)
  - `GenerateReportsController` - Report generation
  - `Auth/` - Authentication controllers

### Frontend Architecture

- **Asset Compilation**: Laravel Mix (`webpack.mix.js`)
  - JavaScript: `resources/js/app.js` → `public/js/app.js`
  - Styles: `resources/sass/app.scss` → `public/css/app.css`
  - Vue.js 3 support enabled

- **Views** (`resources/views/`):
  - Blade templates organized by feature
  - Layout files in `layouts/`
  - PDF templates in `pdf/`
  - Email templates in `mail/`
  - Auth views in `auth/`

### Middleware

Custom middleware in `app/Http/Middleware/`:
- `JsonResponseMiddleware` - Likely handles JSON response formatting
- Standard Laravel middleware (CSRF, auth, etc.)

### Helpers & Services

- **Services** (`app/Services/`):
  - `Analytics.php` - Analytics service

- **Helpers** (`app/Helpers/`):
  - `MailingLists.php` - Email distribution list management
  - `ItemRequestHelpers.php` - Store request helpers

- **Utils** (`app/Utils/`):
  - `Globals.php` - Global utility functions

## Important Development Notes

### Signage System

The signage system has two distinct interfaces:
- Admin interface (`/signage/admin`) - Screen management
- Display interface (`/signage/show/{screen:name}`) - Public display (no auth required)
- List screens API (`/signage/screens`)

### Database Migrations

Only 4 migrations exist in the repository. The system likely uses:
- `bennett-treptow/laravel-migration-generator` to generate migrations from existing database
- `orangehill/iseed` for seeding from existing data

### Log Management

- Admin users can access log viewer at `/logs` (requires Admin role)
- Logs can be dumped via `/dumplogs` (Admin only)

### Performance Optimization

The `composer warmup` script caches config and routes for production deployment:
```bash
composer warmup
```

### Environment Configuration

Key environment variables to configure (see `.env.example`):
- Database credentials
- Mail server settings
- Queue connection (currently `sync`, consider `redis` or `database` for production)
- Session driver
- Cache driver

---

## Code Review Findings (January 2026)

### Codebase Statistics

| Metric | Count |
|--------|-------|
| Models | 42 |
| Web Controllers | 48 |
| API Controllers | 42 |
| Routes | 160+ |
| Events | 7 |
| Listeners | 7 |
| Mail Classes | 9 |

### Strengths

1. **Clean Architecture** - Proper separation of web/API concerns, organized feature directories
2. **Event-Driven System** - Well-implemented notification system with events, listeners, and queued mail
3. **Authentication** - Modern Sanctum API auth combined with Spatie Permission for RBAC
4. **Laravel Conventions** - Resource routing, middleware, proper directory structure

### Critical Issues

#### 1. ~~SQL Injection Vulnerabilities~~ ✅ FIXED (January 2026)

Previously had raw `DB::select()` queries with string interpolation. **All 7 critical instances have been fixed** by replacing with Eloquent queries:

- `TripLoggerController.php` - 3 instances fixed
- `StoreController.php` - 1 instance fixed
- `API/StoreController.php` - 3 instances fixed
- `BatchStoreRequestsController.php` - 1 instance fixed (dynamic query building)

#### 2. ~~Debug Code in Production~~ ✅ FIXED (January 2026)

All debug code has been removed:
- Removed test routes (`/dev/test`, `/event-test`)
- Removed all commented `dd()`, `var_dump()`, `print_r()` statements from 15 files
- Removed inappropriate comments

#### 3. ✅ Authorization Hardening Added (January 2026)

Controller-level middleware added for sensitive operations:
- `EmployeeController` - `role:Admin` on `store`, `update`, `destroy`, `resetpass`
- `PermissionController` - `role:Admin` on all methods
- `StoreController` - `permission:manage-store-requests` on `Approve`, `Reject`, `Return`
- Routes moved to Admin group: `roles`, `permissions/store`, `employees/password/reset`

#### 4. Missing Test Coverage

- Only 2 example tests exist
- No feature tests for 40+ modules
- No API endpoint tests

#### 5. Hard-coded Values

- Department IDs: 11, 7, 13, 34
- Status strings: 'Pending', 'Approved', 'Returned'
- Magic numbers throughout controllers

### Technical Debt Summary

| Issue | Count | Priority | Status |
|-------|-------|----------|--------|
| ~~Raw SQL queries (injection risk)~~ | ~~7~~ | ~~Critical~~ | ✅ Fixed |
| ~~Debug code / test routes~~ | ~~15+ files~~ | ~~Critical~~ | ✅ Fixed |
| ~~Authorization gaps~~ | ~~3 controllers~~ | ~~Critical~~ | ✅ Fixed |
| Missing tests | 40+ modules | High | Pending |
| Code duplication | 15+ patterns | High | Pending |
| Missing validation | 25+ methods | High | Pending |
| Hard-coded values | 50+ instances | Medium | Pending |
| N+1 query problems | 20+ locations | Medium | Pending |

---

## Next Steps / Roadmap

### Phase 1: Security Hardening (Critical) ✅ COMPLETED

- [x] **Fix SQL Injection vulnerabilities** - Replaced all `DB::select()` with Eloquent queries (7 instances)
- [x] **Remove debug code** - Removed all `dd()` statements, test routes, and inappropriate comments (15+ files)
- [x] **Audit authentication** - Added authorization middleware to sensitive controllers (EmployeeController, PermissionController, StoreController)
- [ ] **Input validation** - Create Form Request classes for all store/update methods

### Phase 2: Code Quality (High Priority)

- [ ] **Add test coverage** - Implement feature tests for critical workflows:
  - Store request approval flow
  - Issue ticket lifecycle
  - User authentication (web and API)
  - Schedule CRUD operations
- [ ] **Create constants/enums** - Replace hard-coded IDs and status strings:
  ```php
  // Create app/Enums/Department.php
  // Create app/Enums/RequestStatus.php
  ```
- [ ] **Implement Form Requests** - Move validation from controllers to dedicated request classes

### Phase 3: Architecture Improvements (Medium Priority)

- [ ] **Extract service classes** - Move business logic from controllers:
  - `StoreRequestService` - Handle approval workflows
  - `ScheduleService` - Calendar and scheduling logic
  - `NotificationService` - Centralize email sending
- [ ] **Fix N+1 queries** - Add eager loading with `with()` for relationships
- [ ] **Add caching** - Cache analytics queries and frequently accessed data
- [ ] **Implement repository pattern** - Abstract database access for testability

### Phase 4: Performance & Monitoring (Lower Priority)

- [ ] **Add pagination** - Replace `Model::all()` with paginated queries
- [ ] **Database indexes** - Add indexes for common query filters
- [ ] **Error tracking** - Integrate Sentry or similar
- [ ] **Structured logging** - Implement proper log channels

### Phase 5: Frontend Modernization (Future)

- [ ] **Migrate to Vue 3 components** - Replace jQuery with Vue components
- [ ] **Add TypeScript** - Type safety for frontend code
- [ ] **API documentation** - Generate OpenAPI/Swagger docs

---

## Development Guidelines

### When Writing New Code

1. **Never use raw SQL** - Always use Eloquent or parameterized Query Builder
2. **Always validate input** - Create Form Request classes for validation
3. **Write tests first** - Add feature tests for new functionality
4. **Use constants** - Never hard-code IDs or status values
5. **Eager load relationships** - Prevent N+1 queries with `with()`

### Code Review Checklist

- [ ] No raw SQL queries (`DB::select`, `DB::statement` with concatenation)
- [ ] No `dd()` or debug statements
- [ ] Form Request class for validation
- [ ] Feature test coverage
- [ ] No hard-coded IDs or magic numbers
- [ ] Eager loading for relationships
