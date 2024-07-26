<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Robust Teacher Portal

The Robust Teacher Portal is a web application designed to manage student information efficiently. Built with Laravel (PHP) and utilizing modern front-end technologies, this portal provides a seamless experience for teachers to manage student records, including adding, updating, and deleting student details.

## Features

- **Login Functionality:** Secure authentication for teachers.
- **Teacher Portal Home & Student Listing:** View and manage student details with options to edit and delete records.
- **New Student Entry:** Add new students or update existing records with the option to check for duplicate entries.

## Prerequisites

Before you begin, ensure you have met the following requirements:

### 1. Install PHP

- **Windows:** Download and install PHP from [PHP for Windows](https://windows.php.net/download/).
- **macOS:** Install PHP via Homebrew:

  ```bash
  brew install php
  ```

- **Linux:** Install PHP using your package manager. For Debian-based systems:

  ```bash
  sudo apt update
  sudo apt install php php-cli php-mbstring php-xml php-mysql
  ```

### 2. Install Composer

Composer is a dependency manager for PHP. Install it by following the instructions on the [Composer website](https://getcomposer.org/download/).

For Windows:
- Download and run the Composer-Setup.exe installer from [Composer Downloads](https://getcomposer.org/download/).

For macOS and Linux:
- Use the following commands:

  ```bash
  curl -sS https://getcomposer.org/installer | php
  sudo mv composer.phar /usr/local/bin/composer
  ```

### 3. Install Node.js and npm

Node.js is required for front-end dependencies. Download and install Node.js from [Node.js website](https://nodejs.org/). npm is included with Node.js.

For Windows and macOS:
- Download and install from the website.

For Linux:
- Use the following commands:

  ```bash
  sudo apt update
  sudo apt install nodejs npm
  ```

### 4. Install MySQL or Any Compatible Database

Download and install MySQL from [MySQL Downloads](https://dev.mysql.com/downloads/installer/).

For macOS:
- You can use Homebrew:

  ```bash
  brew install mysql
  ```

For Linux:
- Use the following commands:

  ```bash
  sudo apt update
  sudo apt install mysql-server
  ```

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/robust-teacher-portal.git
   ```

2. **Navigate to the Project Directory**

   ```bash
   cd robust-teacher-portal
   ```

3. **Install PHP Dependencies**

   ```bash
   composer install
   ```

4. **Set Up Environment Configuration**

   Copy the example environment configuration file and update it with your database credentials.

   ```bash
   cp .env.example .env
   ```

   Edit the `.env` file to configure your database and other settings.

5. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**

   ```bash
   php artisan migrate
   ```

7. **Install Front-End Dependencies**

   ```bash
   npm install
   ```

8. **Build Front-End Assets**

   ```bash
   npm run dev
   ```

9. **Start the Development Server**

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`.

## Usage

- **Login:** Access the login page at `http://localhost:8000/login` and enter your credentials.
- **Manage Students:** After logging in, you will be redirected to the student listing screen where you can view, edit, or delete student records.
- **Add New Students:** Use the modal to add new student records or update existing ones.

## Contributing

Feel free to fork the repository and submit pull requests. Please ensure your contributions follow the project's coding standards and add tests for new features.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any questions or feedback, please contact:

- **Saurabh Prasad**: saurabhkpofficial@gmail.com
