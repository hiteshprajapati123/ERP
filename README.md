# 🏢 Enterprise Resource Planning (ERP) System

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.x-FDAE4B?style=for-the-badge&logo=data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMiAyMkgyMkwxMiAyWiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**A comprehensive web-based ERP solution for managing organizational operations, events, financial transactions, and content management.**

[Features](#-features) • [Installation](#-installation) • [Documentation](#-project-structure) • [Contributing](#-contributing)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Screenshots](#-screenshots)
- [Technology Stack](#-technology-stack)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Project Structure](#-project-structure)
- [Usage](#-usage)
- [Development](#-development)
- [Testing](#-testing)
- [Security](#-security)
- [API Documentation](#-api-documentation)
- [Contributing](#-contributing)
- [License](#-license)
- [Support](#-support)

---

## 🎯 Overview

This Enterprise Resource Planning (ERP) system is a modern, full-featured web application built with Laravel and Filament PHP. It provides a robust platform for managing various organizational aspects including user management, event coordination, media galleries, financial tracking, and content management.

### Key Highlights

✨ **Modern Tech Stack** - Built with Laravel 12.x and Filament PHP for a powerful admin experience  
🔐 **Security First** - Role-based access control, CSRF protection, and secure authentication  
📱 **Responsive Design** - Mobile-friendly interface with Tailwind CSS  
🎨 **Admin Dashboard** - Beautiful and intuitive admin panel powered by Filament  
🚀 **High Performance** - Optimized with Vite for fast asset bundling  

---

## ✨ Features

### 👥 User Management
- **Authentication & Authorization** - Secure login and registration system
- **Role-Based Access Control (RBAC)** - Fine-grained permission management
- **User Profiles** - Customizable user profiles with avatars
- **User Dashboard** - Personalized dashboard for each user

### 📅 Event Management
- **Event Creation & Scheduling** - Comprehensive event management tools
- **Registration System** - Easy event registration and tracking
- **Notifications** - Automated event reminders and updates
- **Calendar Integration** - Visual event calendar

### 🖼️ Gallery System
- **Media Management** - Upload and organize images and videos
- **Media Library** - Centralized media asset management
- **Public & Private Galleries** - Control visibility and access
- **Optimized Storage** - Powered by Spatie Media Library

### 💰 Financial Management
- **Zakat Management** - Track and manage Zakat contributions
- **Sadqa Tracking** - Monitor charitable donations
- **Donation System** - Comprehensive donation management
- **Financial Reports** - Generate detailed financial reports

### 📢 Content Management
- **Notice Board** - Post announcements and notices
- **About Sections** - Manage organizational information
- **Privacy Policy** - Customizable privacy policy pages
- **Dynamic Content** - Easy content updates through admin panel

---

## 📸 Screenshots

<div align="center">
  <h3>Application Interface</h3>
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin: 20px 0;">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-19-41.png" alt="Dashboard Overview" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-19-57.png" alt="User Management" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-20-05.png" alt="Event Management" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-20-26.png" alt="Gallery View" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-20-30.png" alt="Financial Dashboard" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-20-34.png" alt="Content Management" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  </div>
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin: 20px 0;">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-20-55.png" alt="Admin Panel" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-21-02.png" alt="User Profile" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-21-11.png" alt="Settings" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-21-23.png" alt="Mobile View" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <img src="public/readme_img/Screenshot from 2025-11-11 19-21-35.png" alt="Responsive Design" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
  </div>
</div>

## 🛠️ Technology Stack

| Category | Technologies |
|----------|-------------|
| **Backend Framework** | Laravel 12.x |
| **Admin Panel** | Filament PHP 3.x |
| **Frontend** | Blade Templates, Tailwind CSS, Alpine.js |
| **Build Tool** | Vite |
| **Database** | MySQL 8.0+ / PostgreSQL 13+ |
| **Media Handling** | Spatie Media Library |
| **Authentication** | Laravel Breeze/Jetstream |
| **Package Manager** | Composer, NPM |

---

## 📦 Requirements

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer** >= 2.5
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **MySQL** >= 8.0 or **PostgreSQL** >= 13
- **Web Server** (Nginx or Apache)
- **Git**

### PHP Extensions Required
```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- GD or Imagick
```

---

## 🚀 Installation

Follow these steps to get your ERP system up and running:

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/yourusername/erp-system.git
cd erp-system
```

### 2️⃣ Install PHP Dependencies

```bash
composer install
```

### 3️⃣ Install Node.js Dependencies

```bash
npm install
```

### 4️⃣ Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5️⃣ Configure Database

Edit your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=erp_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6️⃣ Run Migrations & Seeders

```bash
# Run migrations
php artisan migrate

# Seed the database with initial data
php artisan db:seed
```

### 7️⃣ Build Assets

```bash
# For production
npm run build

# For development (with hot reload)
npm run dev
```

### 8️⃣ Storage Link

```bash
# Create symbolic link for storage
php artisan storage:link
```

### 9️⃣ Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## ⚙️ Configuration

### Environment Variables

Configure the following key variables in your `.env` file:

#### Application Settings
```env
APP_NAME="ERP System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

#### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=erp_database
DB_USERNAME=root
DB_PASSWORD=
```

#### Mail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@erp.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Filesystem Configuration
```env
FILESYSTEM_DISK=public
```

### File Permissions

Ensure proper permissions for storage and cache directories:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 📁 Project Structure

```
erp-system/
├── 📂 app/
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/
│   │   │   ├── 📂 Api/              # API Controllers
│   │   │   ├── 📂 Auth/             # Authentication Controllers
│   │   │   └── 📂 UserDashboard/    # User Dashboard Controllers
│   │   ├── 📂 Middleware/
│   │   └── 📂 Requests/
│   ├── 📂 Models/                   # Eloquent Models
│   ├── 📂 Providers/                # Service Providers
│   └── 📂 View/Components/          # Blade Components
│
├── 📂 config/                       # Configuration Files
│   ├── app.php
│   ├── database.php
│   ├── filesystems.php
│   └── ...
│
├── 📂 database/
│   ├── 📂 factories/                # Model Factories
│   ├── 📂 migrations/               # Database Migrations
│   └── 📂 seeders/                  # Database Seeders
│
├── 📂 public/                       # Public Assets
│   ├── 📂 css/
│   ├── 📂 js/
│   ├── 📂 images/
│   └── index.php
│
├── 📂 resources/
│   ├── 📂 css/                      # Stylesheets
│   ├── 📂 js/                       # JavaScript Files
│   └── 📂 views/
│       ├── 📂 auth/                 # Authentication Views
│       ├── 📂 components/           # Blade Components
│       ├── 📂 layouts/              # Layout Templates
│       └── 📂 user-dashboard/       # User Dashboard Views
│
├── 📂 routes/
│   ├── api.php                      # API Routes
│   ├── web.php                      # Web Routes
│   └── user.php                     # User Routes
│
├── 📂 storage/
│   ├── 📂 app/
│   ├── 📂 framework/
│   └── 📂 logs/
│
├── 📂 tests/
│   ├── 📂 Feature/                  # Feature Tests
│   └── 📂 Unit/                     # Unit Tests
│
├── .env.example
├── composer.json
├── package.json
├── phpunit.xml
├── vite.config.js
└── README.md
```

---

## 🎮 Usage

### Accessing the Admin Panel

1. Navigate to `/Madarsa-AdminSide` in your browser
2. Login with your admin credentials
3. Default admin credentials (if seeded):
   - Email: `admin@example.com`
   - Password: `Reset@123`

### User Dashboard

Users can access their personalized dashboard at `/dashboard` after logging in.

### API Endpoints

API endpoints are available at `/api/*`. See [API Documentation](#-api-documentation) for details.

---

## 💻 Development

### Running Development Server

```bash
# Start Laravel development server
php artisan serve

# In a separate terminal, start Vite dev server
npm run dev
```

### Useful Artisan Commands

```bash
# Clear all caches
php artisan optimize:clear

# Create a new controller
php artisan make:controller YourController

# Create a new model with migration
php artisan make:model YourModel -m

# Create a new Filament resource
php artisan make:filament-resource YourResource

# Run queue worker
php artisan queue:work

# Schedule commands
php artisan schedule:work
```

### Code Style

This project follows PSR-12 coding standards. Format your code with:

```bash
# Install Laravel Pint
composer require laravel/pint --dev

# Run Pint
./vendor/bin/pint
```

---

### Writing Tests

Tests are located in the `tests/` directory:
- **Feature Tests** - Test complete features and workflows
- **Unit Tests** - Test individual components and methods

Example test:

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserDashboardTest extends TestCase
{
    public function test_user_can_access_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }
}
```

---

## 🔒 Security

This application implements multiple security layers:

### Security Features

- ✅ **CSRF Protection** - All forms protected against CSRF attacks
- ✅ **XSS Protection** - Input sanitization and output escaping
- ✅ **SQL Injection Prevention** - Eloquent ORM and prepared statements
- ✅ **Password Hashing** - Bcrypt hashing with salt
- ✅ **Role-Based Access Control** - Fine-grained permissions
- ✅ **Input Validation** - Server-side validation for all inputs
- ✅ **Secure Headers** - Security headers configured
- ✅ **Rate Limiting** - API and form submission rate limiting

### Reporting Security Vulnerabilities

If you discover a security vulnerability, please email security@erp.com. Do not create a public issue.

---

## 📚 API Documentation

API documentation is available through:

- **Swagger UI**: `/api/documentation`
- **Postman Collection**: Available in `/docs` directory

### Authentication

API uses token-based authentication:

```bash
# Example API request
curl -X GET "http://localhost:8000/api/users" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Accept: application/json"
```

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

### Contribution Guidelines

1. **Fork** the repository
2. **Create** your feature branch
   ```bash
   git checkout -b feature/AmazingFeature
   ```
3. **Commit** your changes
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```
4. **Push** to the branch
   ```bash
   git push origin feature/AmazingFeature
   ```
5. **Open** a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Write descriptive commit messages
- Add tests for new features
- Update documentation as needed
- Ensure all tests pass before submitting PR

### Pull Request Process

1. Update the README.md with details of changes if applicable
2. Update the CHANGELOG.md with your changes
3. The PR will be merged once you have the sign-off of maintainers

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2025 ERP System

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
```

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework for web artisans
- [Filament](https://filamentphp.com) - Beautiful admin panel framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Spatie](https://spatie.be) - Amazing Laravel packages
- All our [contributors](https://github.com/yourusername/erp-system/graphs/contributors)

<div align="center">

**Made with ❤️ by the ERP System Team**

⭐ Star us on GitHub — it motivates us a lot!

[Report Bug](https://github.com/yourusername/erp-system/issues) • [Request Feature](https://github.com/yourusername/erp-system/issues)

</div>