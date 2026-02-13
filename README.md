<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20Logo%20Vertical/1%20Logo%20Vertical%20-%20Black.svg" width="100" alt="Laravel Logo">
  <h1>🚀 Data Center Resources Booking</h1>
  <p>A premium, state-of-the-art resource management system built for Data Centers.</p>

  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
  [![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
</div>

---

## ✨ Features

- **🎯 Interactive Resource Catalogue**: Browse servers, storage, and networking resources in a sleek 3-column grid.
- **📅 FullCalendar Integration**: Visualize approved and active reservations in a modern calendar interface.
- **🛡️ Secure Authentication**: Multi-role system (User, Responsible, Admin) with magic login capabilities.
- **🎨 Premium UI/UX**: Built with the **Outfit** font, custom glassmorphism effects, and "Orange Tiger" rotating border animations on login.
- **📊 Incident Reporting**: Track and report technical issues directly from your reservation history.
- **🌘 Dark Mode Support**: Fully responsive design with native dark mode support.

---

## 🛠️ Tech Stack

- **Backend**: [Laravel 12+](https://laravel.com) & [PHP 8.2](https://php.net)
- **Frontend**: [Vite](https://vitejs.dev), Vanilla CSS, [FullCalendar](https://fullcalendar.io/)
- **Icons & Fonts**: [FontAwesome](https://fontawesome.com), [Outfit (Google Fonts)](https://fonts.google.com/specimen/Outfit)
- **Animation**: Custom CSS Keyframes & Conic Gradients

---

## 🚀 Getting Started

Follow these steps to get the project running on your local machine.

### 📋 Prerequisites

- **XAMPP** (PHP 8.2+, MySQL)
- **Composer**
- **Node.js & NPM**

### 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/salimelbourmaki/datacenter-resources-booking.git
   cd datacenter-resources-booking
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JS dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Edit `.env` to configure your database credentials (DB_DATABASE, DB_USERNAME, etc.).*

5. **Database Migration**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Run the Application**

   #### Option A: Using Artisan (Development)
   ```bash
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000`

   #### Option B: Using XAMPP/Apache (Recommended for your setup)
   1. Ensure the project is located in `C:\xampp\htdocs\datacenter-resources-booking`.
   2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
   3. Visit `http://localhost/datacenter-resources-booking/public` or configure a VirtualHost for a cleaner URL like `http://dc-manager.test`.

---

## 👨‍💻 Developed By

**EL BOURMAKI Salim**  
*Ingénierie & Développement*

<div align="left">
  <a href="https://github.com/salimelbourmaki" target="_blank">
    <img src="https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
  </a>
  <a href="https://www.linkedin.com/in/salim-el-bourmaki-885304373" target="_blank">
    <img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn">
  </a>
  <a href="mailto:salimelbourmaki1@gmail.com">
    <img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white" alt="Gmail">
  </a>
</div>

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
