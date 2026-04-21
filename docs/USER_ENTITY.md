# User Entity Documentation

## 1. Overview
The `User` entity is the central identity model of the system. It is responsible for:
- authentication (login/logout)
- registration
- profile management
- ownership of tickets (`User` -> `Ticket`)

Main file:
- `app/Models/User.php`

## 2. Database Structure
The `users` table is created in:
- `database/migrations/0001_01_01_000000_create_users_table.php`

Key fields:
- `id` (primary key)
- `name` (string)
- `email` (unique string)
- `email_verified_at` (nullable timestamp)
- `password` (string)
- `department` (string)
- `remember_token`
- `created_at` / `updated_at`

Important note:
- `department` is currently a plain string field with fixed allowed values in validation.

## 3. Model Definition and Logic
File:
- `app/Models/User.php`

Class details:
- Extends `Authenticatable`
- Uses traits: `HasFactory`, `Notifiable`

### 3.1 Mass Assignment (`$fillable`)
The model allows mass assignment for:
- `name`
- `email`
- `password`
- `department`

Why this matters:
- `User::create([...])` in registration only works for attributes listed in `$fillable`.

### 3.2 Hidden Attributes (`$hidden`)
Hidden in serialization:
- `password`
- `remember_token`

Why this matters:
- protects sensitive data when user model is converted to array/JSON.

### 3.3 Casts (`casts()`)
Current casts:
- `email_verified_at` => `datetime`
- `password` => `hashed`

Why `password => hashed` is important:
- guarantees hashing when password is assigned through model attributes.

### 3.4 Relationships
Current relationship:
- `tickets()` -> `hasMany(Ticket::class)`

Used by ticket flow to connect each ticket with its owner.

## 4. Registration Flow (Create User)
Controller:
- `app/Http/Controllers/Auth/RegisteredUserController.php`

Main methods:
- `create(): View` -> returns registration screen
- `store(Request $request): RedirectResponse` -> validates and persists user

Validation rules in `store()`:
- `name`: required, string, max 255
- `email`: required, lowercase, valid email, unique
- `department`: required, must be one of:
  - Financeiro
  - Comercial
  - Tecnologia
  - RH
- `password`: required, confirmed, default Laravel password rules

Persistence logic:
- `User::create([...])` with `name`, `email`, `department`, `password`
- dispatches `Registered` event
- logs user in immediately with `Auth::login($user)`
- redirects to `dashboard`

## 5. Auth Routes and Middleware
Auth routes are in:
- `routes/auth.php`

Key route groups:
- `Route::middleware('guest')`:
  - register/create
  - login/create
  - forgot/reset password
- `Route::middleware('auth')`:
  - email verification routes
  - password confirmation/update
  - logout

Why this matters:
- ensures only guests can register/login
- ensures only authenticated users can logout/update sensitive auth data

## 6. Profile Update Logic
Controller:
- `app/Http/Controllers/ProfileController.php`

Request validation:
- `app/Http/Requests/ProfileUpdateRequest.php`

Current profile update allows only:
- `name`
- `email`

Important behavior:
- if email changes, `email_verified_at` is reset to `null`

Note:
- `department` is not currently editable in profile update.

## 7. Blade Directives and Helpers Relevant to User
Main register view:
- `resources/views/auth/register.blade.php`

Important directives/helpers used:
- `@csrf`
  - required CSRF token for POST form security
- `old('field')`
  - repopulates form values after validation error
- `<x-input-error :messages="$errors->get('field')" />`
  - shows validation messages per field
- `route('register')`, `route('login')`
  - route name resolution

Why this matters for User entity:
- these directives are part of the user creation UX and security guarantees.

## 8. User Logic in Ticket Domain
Ticket ownership is enforced in:
- `app/Http/Controllers/TicketController.php`

Key logic:
- listing filters tickets by `where('user_id', auth()->id())`
- show/edit/update/delete check ownership with `abort_unless($ticket->user_id === auth()->id(), 403)`
- ticket list can filter by ticket owner department via `whereHas('user', ...department...)`

Why this matters:
- user identity is part of authorization and data isolation.

## 9. Factory / Test Data
Factory:
- `database/factories/UserFactory.php`

Generated attributes include:
- random `name`
- unique `email`
- random `department` from allowed list
- hashed default password

Use case:
- test and seed scenarios involving user and department-dependent behavior.

## 10. Current Design Decisions
- Department is modeled as string in `users`.
- Allowed department values are duplicated in validation and form options.

Tradeoff:
- simple and quick for small scope
- harder to maintain when department list grows or changes frequently

## 11. Suggested Improvements (Optional)
1. Replace hardcoded department list with a `departments` table and relation:
   - `users.department_id` FK
2. Move ownership checks to Policy (`TicketPolicy`) for cleaner controller methods
3. Create constants or enum for department values to avoid duplication
4. Add profile support to edit `department` when business rule allows

## 12. File Map
- `app/Models/User.php`
- `database/migrations/0001_01_01_000000_create_users_table.php`
- `app/Http/Controllers/Auth/RegisteredUserController.php`
- `resources/views/auth/register.blade.php`
- `routes/auth.php`
- `app/Http/Controllers/ProfileController.php`
- `app/Http/Requests/ProfileUpdateRequest.php`
- `app/Http/Controllers/TicketController.php`
- `database/factories/UserFactory.php`
