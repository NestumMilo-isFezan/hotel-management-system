# Migration Specification

## Goal
Transform the existing procedural PHP application into a structured MVC application following PSR-12 standards, utilizing PDO for database interactions, and implementing robust security measures.

## Key Requirements

### 1. Architecture
- **MVC Pattern**: Separation of Models, Views, and Controllers.
- **Routing**: Centralized routing (single entry point `public/index.php`).
- **Dependency Injection**: Basic container or manual injection for services/repositories.

### 2. Database
- **PDO**: Complete migration from `mysqli` to `PDO`.
- **Repositories**: All SQL queries encapsulated in Repository classes.
- **Prepared Statements**: STRICT use of prepared statements for all variable data.

### 3. Security
- **XSS**: Automatic output escaping (possibly via a simple view helper).
- **CSRF**: Token verification on all POST requests.
- **Sessions**: Secure session configuration (`httpOnly`, `secure`, `samesite`).
- **Passwords**: Continue using `password_hash`/`verify` (already present, but ensure correct usage).

### 4. Code Quality
- **PSR-12**: Enforce coding styles.
- **Strict Types**: `declare(strict_types=1);` in new files.
- **Cleanup**: Removal of all `.txt` notes and unused artifacts.
