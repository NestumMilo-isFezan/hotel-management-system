# 🚀 Deployment Guide: Dokploy & VPS

This document provides step-by-step instructions for deploying the modernized Hotel Management System using **Dokploy** on your VPS.

## 📋 Prerequisites
1. A VPS with **Dokploy** installed.
2. A database (MariaDB or MySQL) accessible by your VPS.
3. This repository pushed to GitHub or GitLab.

---

## 🛠 Dokploy Configuration

### 1. Create Application
- Open Dokploy Dashboard.
- Click **Create Application**.
- Select your **Source** (e.g., GitHub) and choose the `hotel-management-system` repository.

### 2. Build Settings
Dokploy will automatically detect the root `Dockerfile`. Ensure the settings match:
- **Build Type**: `Dockerfile`
- **Dockerfile Path**: `./Dockerfile`
- **Context Path**: `.`

### 3. Environment Variables
Go to the **Environment** tab in Dokploy and add the following keys. Refer to `.env.example` for guidance:

| Key | Value |
| :--- | :--- |
| `DB_HOST` | (Your DB Host/IP) |
| `DB_DATABASE` | `hotelmanagement` |
| `DB_USERNAME` | (Your DB Username) |
| `DB_PASSWORD` | (Your DB Password) |
| `DB_PORT` | `3306` |
| `APACHE_DOCUMENT_ROOT` | `/var/www/html/public` |
| `APP_ENV` | `production` |

### 4. Networking
- **Internal Port**: Set this to `80`.
- Assign your **Domain** (e.g., `hotel.yourdomain.com`) in the Dokploy networking settings.

### 5. Persistent Storage (Volumes)
To prevent losing uploaded images (room photos, etc.) during redeployments, you must mount a volume:
- Go to the **Mounts/Volumes** tab.
- **Service Path**: `/var/www/html/public/upload`
- **Host Path**: `/var/lib/dokploy/hotel-management/uploads` (or any persistent path on your VPS).

---

## 🔄 Automated Workflow
The production setup includes a specialized entrypoint script (`scripts/prod-entrypoint.sh`) that automates the following every time you click **Deploy**:

1. **Database Check**: Waits until the database connection is established.
2. **Auto-Migrations**: Automatically runs `php migrate.php migrate` to ensure your production schema is up to date.
3. **Optimized Autoloader**: Uses the pre-built, production-optimized Composer autoloader.
4. **Apache Start**: Boots the web server with the isolated `/public` root.

---

## 🧪 Seeding Production (First Time Only)
If you want to populate your production site with the initial data (Rooms, Types, Services) after the first successful deployment:

1. Access the Dokploy **Terminal** for your application.
2. Run the following command manually:
   ```bash
   php migrate.php seed
   ```

---

## 🔐 Security Notes
- The production `Dockerfile` does **not** include development dependencies (`--no-dev`).
- The `.dockerignore` file ensures that your local `.env`, `tests/`, and `legacy/` backup are never exposed in the production image.
- Only the `public/` directory is exposed to the web, protecting your `src/` logic.
