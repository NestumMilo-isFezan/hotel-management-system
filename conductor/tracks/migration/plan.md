# Migration Implementation Plan

## Phase 1: Foundation & Setup
- [x] **Directory Structure**: Create `public/`, `src/`, `views/`, `config/`.
- [x] **Autoloading**: Update `composer.json` for PSR-4 autoloading of `App` mapping to `src/`.
- [x] **Database Connection**: Create a `Database` class using PDO (Singleton or DI).
- [x] **Router**: Implement a basic Router to handle URL requests.
- [x] **Base Controller**: Create an abstract `Controller` class with `render()` and `redirect()` methods.

## Phase 2: Core Components
- [x] **View Engine**: Create a simple View loader that extracts variables and includes templates.
- [x] **Security Helper**: Create classes/helpers for CSRF token generation/validation and XSS escaping.
- [x] **Session Manager**: Create a wrapper for Session handling with security defaults.

## Phase 3: Migration (Iterative)
### Authentication
- [x] **Model/Repository**: Create `UserRepository` (migrating from `auth/login-action.php`).
- [x] **Controller**: Create `AuthController` (Login, Register, Logout).
- [x] **Views**: Migrate login/register HTML to `views/auth/` (integrated into home view).
- [x] **Route**: Register `/login`, `/register`, `/logout` routes.

### Booking (Guest)
- [x] **Model/Repository**: Refine `BookingRepository`, `RoomRepository`, `ServiceRepository`.
- [x] **Controller**: Create `BookingController`, `RoomController`.
- [x] **Views**: Migrate guest booking forms and room catalogue.

### Staff/Admin
- [x] **Middleware**: Implement simple AuthMiddleware to protect admin routes.
- [x] **Controllers**: Create `StaffController`, `StaffRoomController`, `StaffBookingController`.
- [x] **Controllers**: Create `StaffCheckInController`, `StaffCheckOutController`.
- [x] **Controllers**: Create `StaffPaymentController`.
- [x] **Controllers**: Create `StaffHotelInfoController`.
- [x] **Controllers**: Create `StaffServiceController`, `StaffRoomTypeController`.
- [x] **Views**: Migrate Staff Dashboard, Room Management, Booking Management, Check-In, Check-Out, Hotel Info, Services, Room Types, and Payments.

### Guest Features & Profile
- [x] **Controllers**: Create `GuestProfileController`, `GuestBookingHistoryController`.
- [x] **Views**: Migrate profile editing and personal booking history.

## Phase 4: Cleanup & Verification
- [x] **Tests**: Created unit tests for User and Room repositories.
- [x] **Code Cleanup**: Removed `app/` (legacy) and redundant files.
- [x] **Final Audit**: Architecture modernized and README updated.
