<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Multi-Auth Registration & Verification


This project provides:  
- Separate **Customer** & **Admin** registration  
- Role-based assignment (Customer/Admin)  
- Email Verification using **verification code**  
- Admin-only login (customers blocked)  
- Restriction: Only **verified admins** can log in  

## ⚙️ Installation Steps

1. **Clone the repository**

   git clone https://github.com/SEEMA-PANCHAL/techerudite-practical.git
   
   cd techerudite-practical

   enter code .

   open vs code 

## Install dependencies
- composer install

## Setup environment
- cp .env.example .env
- Update .env with DB and mail credentials:

    DB_DATABASE=(Your_database_name)
    DB_USERNAME=(username)
    DB_PASSWORD=

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.yourmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your_email@example.com
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your_email@example.com
    MAIL_FROM_NAME="Laravel App"

## Development Commands
- php artisan migrate
- php artisan optimize:clear

## Start the server

php artisan serve

App available at 👉 http://127.0.0.1:8000

🔑 Features

Customer Registration → Assigns customer role.

Admin Registration → Assigns admin role.

Email Verification → User receives verification code after registering.

Verification Page → Enter code to activate account.

Admin Login

Only verified admins can log in.

If customer tries → "You are not allowed to login from here".

If unverified admin tries → blocked.
