# 🚀 Complete Deployment Guide: Hostinger Shared Hosting
**Target Domain**: [https://pokemoncalculator.site](https://pokemoncalculator.site)  
**System Architecture**: Standalone Custom PHP 8.x CMS with Custom Admin Panel & MySQL/MariaDB

---

## ⚡ Method A: 1-Click Auto-Deployer (Fastest — 60 Seconds)

1. **Create Database in Hostinger hPanel**:
   - Go to **Websites** &rarr; `pokemoncalculator.site` &rarr; **MySQL Databases**.
   - Create a new database: note down the **Database Name**, **Username**, and **Password**.
2. **Upload `deploy.php`**:
   - Open Hostinger **File Manager** &rarr; navigate into `public_html/`.
   - Upload the single file **`deploy.php`**.
3. **Run Installer in Browser**:
   - Visit: `https://pokemoncalculator.site/deploy.php`
   - Enter your Database Name, User, and Password.
   - Click **Deploy Entire Site & Database**.
4. **Done!**:
   - The installer automatically unpacks all files, creates security barriers, generates `.env`, and imports all 11 database tables and 1,025 Pokémon records!

---

## 📦 Method B: Manual ZIP Upload & phpMyAdmin Import

1. **Create Database in Hostinger hPanel**:
   - Under **MySQL Databases**, create a new database and user.
2. **Import `database.sql` via phpMyAdmin**:
   - Click **Enter phpMyAdmin** next to your database.
   - Click the **Import** tab &rarr; Choose `database.sql` &rarr; Click **Go**.
3. **Upload & Extract ZIP**:
   - In Hostinger **File Manager**, upload `pokemoncalculator.zip` into `public_html/`.
   - Right-click `pokemoncalculator.zip` &rarr; Click **Extract**.
4. **Configure `.env`**:
   - In `public_html/`, rename `.env.example` to `.env` (or edit `.env`).
   - Enter your DB credentials:
     ```ini
     DB_HOST=localhost
     DB_NAME=your_database_name
     DB_USER=your_database_username
     DB_PASS=your_database_password
     ```
5. **Enable SSL & HTTPS**:
   - In hPanel &rarr; **Security** &rarr; **SSL** &rarr; Enable Free SSL and toggle **Force HTTPS**.

---

## 🔐 Admin Panel Login & Verification
- **Admin URL**: `https://pokemoncalculator.site/admin/login`
- **Default Username**: `admin`
- **Default Password**: `admin123`
- *Change your password immediately after your first login under My Profile (`/admin/profile`).*

---

## 🛡️ Security Features Tailored for Hostinger
- **Anti-Theft Protection**: Root and sub-directory `.htaccess` files block direct HTTP access to `.env`, `/app/`, `/config/`, `/views/`, and `/data/`.
- **Upload Directory Hardening**: `public/uploads/.htaccess` disables PHP script execution.
- **SQL Injection Prevention**: 100% of queries use PDO prepared statements.
- **CSRF & XSS Protection**: Form tokens and strict contextual HTML escaping on all views.

---

## 1. Overview & Prerequisites
- A Hostinger Shared Hosting plan (Single, Premium, Business, or Cloud).
- Domain name pointed to Hostinger nameservers (or A-record pointing to your Hostinger server IP).
- PHP Version set to **PHP 8.1, 8.2, 8.3, or 8.4** in Hostinger hPanel.

---

## 2. Step 1: Create MySQL Database in Hostinger hPanel
1. Log in to your **Hostinger hPanel** (`https://hpanel.hostinger.com`).
2. Go to **Websites** &rarr; Select `pokemoncalculator.site` &rarr; Click **Manage**.
3. In the left menu, search for **Databases** &rarr; click **MySQL Databases**.
4. Under **Create a New MySQL Database And Database User**:
   - **Database Name**: e.g. `u123456789_pkmcalc`
   - **Database Username**: e.g. `u123456789_pkmuser`
   - **Password**: Enter a strong password (e.g. `PkmCalcSecure2026!#`)
5. Click **Create**.
6. **Important**: Note down the full Database Name, Username, and Password.

---

## 3. Step 2: Import `database.sql` via phpMyAdmin
1. On the same **MySQL Databases** page in hPanel, find your new database in the list.
2. Click the **Enter phpMyAdmin** button next to your database.
3. In phpMyAdmin, click on your database name on the left sidebar.
4. Click the **Import** tab on the top navigation bar.
5. Click **Choose File** and select `database.sql` from the extracted zip archive.
6. Click the **Go** / **Import** button at the bottom of the page.
7. You should see a green success banner: *"Import has been successfully finished, 11 tables imported."*

---

## 4. Step 3: Upload & Extract ZIP in Hostinger File Manager
1. In hPanel, go to **Files** &rarr; **File Manager** (access files for `pokemoncalculator.site`).
2. Navigate to your website's root folder: `public_html/`.
3. Click the **Upload** icon in the top right &rarr; Select `pokemoncalculator_site_release.zip`.
4. Right-click the uploaded `.zip` file &rarr; click **Extract**.
5. Extract the files into `public_html/`.

---

## 5. Step 4: Configure `.env` Database Connection
1. In Hostinger File Manager, navigate inside `public_html/`.
2. Find the file `.env.example` &rarr; rename it to **`.env`** (or create a new file named `.env`).
3. Right-click `.env` &rarr; click **Edit**.
4. Update the values with your Hostinger MySQL database details:

```ini
APP_ENV=production
APP_DEBUG=false
APP_URL=https://pokemoncalculator.site

DB_HOST=localhost
DB_PORT=3306
DB_NAME=u123456789_pkmcalc
DB_USER=u123456789_pkmuser
DB_PASS=PkmCalcSecure2026!#
DB_CHARSET=utf8mb4
```
5. Click **Save & Close**.

*(Alternative: You can also edit `config/config.php` directly and put your database credentials in the `define('DB_NAME', ...)` constants).*

---

## 6. Step 5: Set Document Root & File Permissions

### Directory Structure on Server
```text
public_html/
├── .htaccess             <-- Master security router & anti-theft barrier
├── .env                  <-- Protected database credentials
├── app/                  <-- Backend controllers & models (Protected)
├── config/               <-- App configurations (Protected)
├── views/                <-- Templates & layouts (Protected)
├── pkm-data/             <-- 1,025 Pokemon JSON stats (Protected)
├── pkm-calculators/      <-- Calculator calculation logic (Protected)
├── public/               <-- Public web root
│   ├── index.php         <-- Single front-controller entry point
│   ├── .htaccess         <-- URL rewrite rules & security headers
│   ├── assets/           <-- CSS, JS, Images, SVGs
│   └── uploads/          <-- User media uploads (PHP execution blocked)
```

### Folder Permissions
In Hostinger File Manager, verify permissions:
- Standard folders: `755`
- Standard files: `644`
- `public/uploads/` directory: `755` (writable for media uploads)
- `.env` file: `600` or `644` (protected by root `.htaccess`)

---

## 7. Step 6: Enable Free SSL Certificate (HTTPS)
1. In Hostinger hPanel, go to **Security** &rarr; **SSL**.
2. Click **Install SSL** (Hostinger provides free lifetime Let's Encrypt SSL).
3. Toggle **Force HTTPS** to ON.
4. The `.htaccess` file automatically redirects all HTTP traffic to `https://pokemoncalculator.site`.

---

## 8. Step 7: Admin Panel Login & Verification
1. Open your browser and visit:  
   👉 **`https://pokemoncalculator.site/admin/login`**
2. Enter default administrative credentials:
   - **Username**: `admin`
   - **Password**: `admin123`
3. Once logged in:
   - Go to **My Profile** (`/admin/profile`) &rarr; Change the default administrator password immediately.
   - Go to **Site Settings** (`/admin/settings`) &rarr; Add your Google AdSense Publisher ID, Left/Right Skyscraper ads, and Custom Header tags.
   - Go to **Google Indexing API** (`/admin/indexing`) &rarr; Submit all URLs to Google in 1 click!

---

## 9. Security Best Practices for Shared Hosting
- **Anti-Code Theft Protection**: The included multi-tier `.htaccess` files completely block all direct HTTP access to `/app/`, `/config/`, `/views/`, `/pkm-data/`, and `.env`. Any external visitor trying to download your raw PHP scripts or JSON database will receive a strict **403 Forbidden** error.
- **Upload Directory Hardening**: `public/uploads/.htaccess` disables PHP script execution, preventing shell uploads.
- **SQL Injection Prevention**: 100% of database interactions run through PDO prepared statements with parameterized queries.
- **XSS & CSRF**: All output is filtered through `esc_html()` / `esc_attr()`, and every POST form requires a verified CSRF session token.
- **Cookie Hardening**: Admin cookies are protected with `HttpOnly`, `SameSite=Lax`, and `Secure` SSL flags.
