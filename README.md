# Task App

This is a Laravel-based task management system that allows users to create periodic tasks, manage task groups, and view
pending tasks organized by date. It includes authentication and authorization features using Laravel Breeze for secure
access control.

## Technologies

* **Laravel**: PHP framework for building web applications.
* **Laravel Breeze**: Provides a minimal and simple authentication system.
* **Tailwind CSS**: Utility-first CSS framework for building custom designs.
* **Livewire**: Laravel library for building dynamic interfaces using server-side code.

## Design Decisions

* **Authentication**: Implemented authentication using Laravel Breeze for secure access control, ensuring only authorized
  users can create and manage tasks.
* **Database Modeling**: Utilized Laravel's Eloquent ORM for database modeling. The application includes models for users,
  tasks, task groups, and frequencies, allowing for easy management and retrieval of data.

## Installation

1. Install PHP dependencies using Composer:
    ```bash
    composer install
    ```
2. Copy the .env.example configuration file to .env:
    ```bash
    cp .env.example .env
    ```
3. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

4. Configure your database in the .env file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

5. Run the migrations to create tables in the database:

    ```bash
    php artisan migrate --seed
    ```

6. Run npm:

    ```bash
    npm run dev
    ```

# Test User

A test user has been created to facilitate logging into the application:

* **Email**: test@example.com
* **Password**: 1234
