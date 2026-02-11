# Data Center Resources Booking System

A comprehensive web application for managing data center resources, including equipment reservations, incident reporting, and user management. Built with **Laravel 10** and **Vue.js/Vite**.

## Features

-   **Resource Management**: Catalogue of available data center resources (servers, racks, switches, etc.).
-   **Reservation System**: Users can book resources for specific time slots.
-   **Role-Based Access Control**:
    -   **Admin**: Full system control, user management, logs.
    -   **Responsable**: Manager role for overseeing resources and approvals.
    -   **User**: Standard access for making reservations.
    -   **Guest**: View-only access to the catalogue.
-   **Incident Reporting**: Track and manage technical issues.
-   **Notifications**: Real-time alerts for booking statuses and system updates.
-   **Dark/Light Mode**: User interface preference toggle.

## Tech Stack

-   **Backend**: Laravel 10 (PHP 8.1+)
-   **Frontend**: Blade Templates, Vanilla JS, CSS (Custom Design)
-   **Build Tool**: Vite
-   **Database**: MySQL

## Installation & Setup

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/datacenter-resources-booking.git
    cd datacenter-resources-booking
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Configuration**
    Copy the example env file and configure your database settings.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Update `.env` with your DB_DATABASE, DB_USERNAME, and DB_PASSWORD.*

4.  **Database Migration & Seeding**
    ```bash
    php artisan migrate --seed
    ```

5.  **Build Assets**
    ```bash
    npm run build
    ```

6.  **Run the Application**
    Start the local development server:
    ```bash
    php artisan serve
    ```
    Access the app at `http://127.0.0.1:8000`.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
