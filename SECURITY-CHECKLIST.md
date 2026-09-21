# 🛡️ Pokémon Calculator Hub - Security & Code Protection Architecture

This document provides a breakdown of all security measures implemented to protect your intellectual property, PHP source code, database credentials, and website integrity on shared hosting.

---

## 🔒 1. Source Code & IP Protection (Anti-Theft)
On shared hosting environments, malicious visitors often try to probe sensitive paths to steal source code or database credentials. The following protections are active:

| Resource / Directory | Protection Mechanism | Status |
| :--- | :--- | :--- |
| **`app/`** (Controllers, RBAC, Core logic) | Root & folder `.htaccess` block direct HTTP requests (`Require all denied` / `403 Forbidden`). | 🛡️ Protected |
| **`config/`** (Database passwords, routes) | Strict Apache rule denies all browser requests to `.php`, `.ini`, `.env`. | 🛡️ Protected |
| **`views/`** (Admin & Frontend templates) | Direct access blocked; templates can only be rendered internally by PHP. | 🛡️ Protected |
| **`pkm-data/`** (1,025 Pokémon static database) | Direct access to JSON files blocked via `.htaccess`. | 🛡️ Protected |
| **`.env` & `.env.example`** | Hidden files rule + explicit file match denies access to environment keys. | 🛡️ Protected |
| **`database.sql` / `*.sql`** | Regex rewrite rule prevents downloading raw database backups. | 🛡️ Protected |
| **Directory Indexing** | `Options -Indexes` active across all directories; folder browsing disabled. | 🛡️ Protected |

---

## 🛡️ 2. File Upload Hardening (Anti-Webshell)
Media files are stored in `public/uploads/`. To prevent malicious users from uploading and executing PHP web shells:
- **`public/uploads/.htaccess`** explicitly turns off the PHP engine (`php_flag engine off`).
- Removes script execution handlers for `.php`, `.phtml`, `.php3`, `.php4`, `.php5`, `.php7`, `.php8`, `.phps`, `.cgi`, `.pl`, `.py`, `.sh`.
- File upload controller strictly checks MIME types (`image/jpeg`, `image/png`, `image/webp`, `image/gif`, `image/svg+xml`) and enforces random sanitized alphanumeric filenames.

---

## 🔐 3. Authentication & Session Hardening
- **Password Hashing**: Passwords stored using `password_hash()` with native `PASSWORD_BCRYPT` (Cost 12).
- **Session Protection**:
  - `session.cookie_httponly = 1` (prevents JavaScript/XSS access to session IDs).
  - `session.cookie_samesite = 'Lax'` (mitigates CSRF cross-origin leakage).
  - `session.cookie_secure = 1` (automatically active over HTTPS).
  - `session.use_only_cookies = 1` (disables URL-based session passing).
- **Brute-Force & Lockout Protection**:
  - Self-deletion protection: Admin cannot delete their own active account.
  - Last-admin protection: System prevents deleting or demoting the last remaining admin.

---

## 🛡️ 4. Data Security (SQLi & XSS)
- **SQL Injection**: 100% of SQL statements across all frontend and admin controllers use PDO prepared statements with parameterized input bindings.
- **Cross-Site Scripting (XSS)**: All user and database data rendered in HTML is sanitized using `esc_html()`, `esc_attr()`, `esc_url()`, and `esc_js()`.
- **Cross-Site Request Forgery (CSRF)**: All POST endpoints (Admin logins, tool updates, page edits, media deletion, settings, contact submissions) require a verified cryptographic session CSRF token (`_csrf_token`).

---

## 🌐 5. HTTP Security Headers
The following security response headers are sent on all responses:
- `X-Content-Type-Options: nosniff` (prevents MIME-type sniffing attacks)
- `X-Frame-Options: SAMEORIGIN` (prevents Clickjacking/UI redressing)
- `X-XSS-Protection: 1; mode=block` (activates browser XSS filtering)
- `Referrer-Policy: strict-origin-when-cross-origin` (protects referrer privacy)
- `Permissions-Policy: geolocation=(), microphone=(), camera=()` (blocks unauthorized device hardware access)
