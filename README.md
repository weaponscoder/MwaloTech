---

📄 README.md (Copy Paste Hii Kwenye GitHub)

```markdown
# 💼 Mwalo Tech Portfolio

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange.svg)](https://mysql.com)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow.svg)](https://javascript.com)
[![CSS3](https://img.shields.io/badge/CSS3-Modern-blue.svg)](https://css3.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> A professional portfolio website showcasing my skills, services, projects, and testimonials. Built with modern technologies and responsive design.

🔗 **Live Demo:** [https://mwalotech.infinityfreeapp.com](https://mwalotech.infinityfreeapp.com)

---

## 📋 **Table of Contents**

- [✨ Features](#-features)
- [🛠️ Technologies Used](#️-technologies-used)
- [📁 Project Structure](#-project-structure)
- [💻 Installation](#-installation)
- [🗄️ Database Setup](#️-database-setup)
- [🔧 Configuration](#-configuration)
- [👥 Admin Panel](#-admin-panel)
- [📱 Responsive Design](#-responsive-design)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)
- [📞 Contact](#-contact)

---

## ✨ **Features**

### Frontend
- ✅ Fully responsive design (mobile, tablet, desktop)
- ✅ Dynamic services from database
- ✅ Dynamic projects with images
- ✅ Dynamic skills with progress bars
- ✅ Contact form with database storage
- ✅ Testimonials with ratings and images
- ✅ CV download button
- ✅ Social media integration
- ✅ Dark/Light mode toggle
- ✅ Smooth scroll animations
- ✅ Glassmorphism effects
- ✅ Custom scrollbar
- ✅ Back to top button

### Admin Panel
- ✅ Secure admin login
- ✅ Dashboard with statistics
- ✅ Manage services (Add, Edit, Delete, Toggle status)
- ✅ Manage projects (Add, Edit, Delete)
- ✅ Manage skills (Add, Edit, Delete)
- ✅ View contact messages
- ✅ View testimonials
- ✅ Reply to messages via email
- ✅ Change admin password
- ✅ Dark/Light mode for admin panel
- ✅ Responsive admin interface

---

## 🛠️ **Technologies Used**

| Category | Technologies |
|----------|--------------|
| **Frontend** | HTML5, CSS3, JavaScript (Vanilla), Font Awesome Icons |
| **Backend** | PHP 7.4+ |
| **Database** | MySQL (MariaDB) |
| **Server** | Apache (XAMPP / InfinityFree) |
| **Tools** | Git, GitHub, phpMyAdmin, FileZilla |

---

## 📁 **Project Structure**

```

mwalo-portfolio/
├── index.php                 # Homepage
├── db.php                    # Database connection
├── contact_submit.php        # Contact form handler
├── testimonial_submit.php    # Testimonial handler
├── get_testimonials.php      # Fetch testimonials API
│
├── asset/                    # Assets folder
│   ├── portifolio.css        # Main stylesheet
│   ├── portifolio.js         # JavaScript file
│   ├── logo.png              # Logo image
│   ├── portifo2.png          # About image
│   └── cv.pdf                # CV file
│
├── admin/                    # Admin panel
│   ├── index.php             # Dashboard
│   ├── login.php             # Admin login
│   ├── header.php            # Admin header
│   ├── footer.php            # Admin footer
│   ├── logout.php            # Logout
│   ├── services.php          # Manage services
│   ├── services_add.php      # Add service
│   ├── services_edit.php     # Edit service
│   ├── services_delete.php   # Delete service
│   ├── projects.php          # Manage projects
│   ├── projects_add.php      # Add project
│   ├── projects_edit.php     # Edit project
│   ├── projects_delete.php   # Delete project
│   ├── skills.php            # Manage skills
│   ├── skills_add.php        # Add skill
│   ├── skills_edit.php       # Edit skill
│   ├── skills_delete.php     # Delete skill
│   ├── messages.php          # View messages
│   ├── messages_delete.php   # Delete message
│   ├── users.php             # View users
│   ├── settings.php          # Admin settings
│   └── css/
│       └── admin.css         # Admin styles
│
└── uploads/                  # Testimonial images

```

---

## 💻 **Installation**

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache server (XAMPP / WAMP / Lamp)

### Step 1: Clone the Repository
```bash
git clone https://github.com/weaponscoder/mwalo-portfolio.git
cd mwalo-portfolio
```

Step 2: Setup Database

1. Open phpMyAdmin
2. Create database: mwalo_portfolio
3. Import database.sql file

Step 3: Configure Database Connection

Edit db.php and update credentials:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "mwalo_portfolio";
```

Step 4: Run the Project

```bash
# Using XAMPP/WAMP
Move the folder to htdocs/www directory

# Access the website
http://localhost/mwalo-portfolio/
```

---

🗄️ Database Setup

Database Schema

Table Description
users Admin and user accounts
services Services offered
projects Portfolio projects
skills Technical skills
contact_messages Contact form submissions
testimonials Client testimonials
password_resets Password reset tokens

Sample SQL Data

```sql
-- Insert admin user (password: admin123)
INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@mwalotech.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
```

---

🔧 Configuration

Database Connection (db.php)

```php
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "mwalo_portfolio";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

Admin Login Credentials

Field Value
URL /admin/login.php
Email admin@mwalotech.com
Password admin123

⚠️ Important: Change the default password after first login!

---

👥 Admin Panel

Features

· Dashboard - View statistics and recent messages
· Services Management - Add, edit, delete, and toggle service status
· Projects Management - Add, edit, delete projects with images
· Skills Management - Add, edit, delete skills with progress percentages
· Messages - View and reply to contact messages
· Users - View registered users (for shop integration)
· Settings - Change admin password
· Dark/Light Mode - Toggle theme preference

Admin Panel Access

```
URL: http://yourdomain.com/admin/login.php
Email: admin@mwalotech.com
Password: admin123
```

---

📱 Responsive Design

The website is fully responsive and works on all devices:

Device Breakpoint Status
Mobile 320px - 768px ✅ Fully optimized
Tablet 768px - 1024px ✅ Fully optimized
Desktop 1024px+ ✅ Fully optimized

---

🎨 Color Palette

Color Hex Code Usage
Primary Orange #d36804 Buttons, links, accents
Gradient Purple #667eea → #764ba2 Headers, gradients
Dark Navy #0f172a Dark mode background
Light Gray #f8fafc Light mode background
White #ffffff Cards, text

---

🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (git checkout -b feature/AmazingFeature)
3. Commit your changes (git commit -m 'Add some AmazingFeature')
4. Push to the branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

---

📄 License

Distributed under the MIT License. See LICENSE file for more information.

---

📞 Contact

Ezekiel Mwalongo

· 📧 Email: mwalongojoshua042@gmail.com
· 📱 Phone: +255 688 902 638
· 💻 GitHub: @weaponscoder
· 🔗 LinkedIn: Ezekiel Mwalongo
· 🐙 WhatsApp: Chat on WhatsApp

---

🙏 Acknowledgments

· Font Awesome - Icons
· Google Fonts - Poppins & Inter fonts
· Unsplash - Stock images
· Pexels - Stock images

---

⭐ Show Your Support

If you found this project helpful, please give it a ⭐ on GitHub!

---

Built with ❤️ by Ezekiel Mwalongo

```

---

## 📥 **JINSI YA KUITUMIA KWENYE GITHUB**

### **Njia 1: Kupitia GitHub Website**
1. Nenda kwenye repository yako ya GitHub
2. Bonyeza **"Add file"** → **"Create new file"**
3. Jina la file: `README.md`
4. Bandika code yote hapo juu
5. Bonyeza **"Commit new file"**

### **Njia 2: Kupitia Terminal**
```bash
# Create README file
echo "# Mwalo Tech Portfolio" > README.md

# Open with editor
nano README.md

# Copy paste the content above

# Save and push to GitHub
git add README.md
git commit -m "Add README file"
git push origin main
```
