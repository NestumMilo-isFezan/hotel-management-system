# Hotel Management System (MVC Modernization)

This project represents the modernization of a legacy PHP application, transitioning it from a procedural university assignment into a structured Model-View-Controller (MVC) architecture. It serves as a practical demonstration of my learning and growth during my transition into the professional workforce.

## 🚀 Key Improvements & Learning
- **Architectural Shift**: Successfully migrated from flat-file procedural code to a PSR-4 compliant MVC structure, establishing a clear separation of concerns.
- **Data Integrity & Security**: Implemented a Repository pattern with 100% prepared statements (PDO), adding CSRF protection and XSS escaping—concepts I've refined through real-world experience.
- **Operational Logic**: Refined the transaction flow to enforce a "payment-first" check-out process, ensuring data consistency between booking statuses and room availability.
- **Functional Analytics**: Developed a financial reporting dashboard featuring daily revenue trends (Chart.js) and payment method auditing.
- **Modernized Interface**: Redesigned the Staff Dashboard and navigation with a focus on usability and a consistent dark-theme aesthetic.

## 📁 Project Structure
- `src/`: Core logic, Controllers, Repositories, and Middleware.
- `views/`: Modernized HTML templates and UI partials.
- `public/`: Isolated web root for improved security.
- `legacy/`: Preservation of the original procedural code—kept as a benchmark to measure my progress.

## 🛠️ Setup Instructions
1. **Dependencies**: Run `composer install` to initialize the autoloader.
2. **Database**: Import `db/schema.sql`.
3. **Data Seeding**: Use `ComprehensiveSeeder.php` to populate the environment with structured test data.
4. **Environment**: Configure credentials via environment variables (`DB_HOST`, `DB_DATABASE`, etc.).

## 🔑 Default Credentials (Seeded)
| Role | Username | Password |
| :--- | :--- | :--- |
| **Staff/Admin** | `admin_user` | `password123` |
| **Guest** | `johndoe` | `password123` |

---

## 📜 Reflection
This project originally started as a university group assignment. By applying industry standards and patterns I've learned through real-work experience, I have transformed a "spaghetti" codebase into a maintainable, secure, and data-driven application. It stands as proof of my commitment to continuous learning and technical improvement.