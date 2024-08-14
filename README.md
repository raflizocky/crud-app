# CRUD App

A Laravel-based CRUD application with user role management (Superadmin and Admin).

## Demo

<a href="https://github.com/raflizocky/crud-app/blob/main/demo-img/Demo.md">View Demo Images</a>

## Stack

-   Laravel 11 + Breeze (Blade with Alpine)
-   Flowbite
-   PostgreSQL

## Features

-   **Superadmin**:

    -   Dashboard: Home page
    -   List Users: CRUD functionality for superadmin & admin data

-   **Admin**:
    -   Dashboard: Home page

## Installation

1. Database = `crud-app`

2. Terminal
    - ```shell
      git clone https://github.com/raflizocky/crud-app.git
      ```
    - ```shell
      code crud-app
      ```

3. `.env`
   - Terminal (VS Code):
      ```shell
      cp .env.example .env
      ```
    - Adjust `.env`:
      ```shell
      DB_CONNECTION=pgsql
      DB_HOST=127.0.0.1
      DB_PORT=your_postgres_port
      DB_DATABASE=crud-app
      DB_USERNAME=your_postgres_username
      DB_PASSWORD=your_postgres_password
      ```
      
4. Terminal (VS Code)
   - ```shell
     npm i ; npm run dev
     ```
    - ```shell
      composer i ; php artisan key:generate ; php artisan mi:f --seed
      ```
   - ```shell
     php artisan ser
     ```
     
## Usage

- Superadmin
  ```shell
   email   : superadmin@example.com
   password: password 
  ```
  
- Admin
  ```shell
   email   : admin@example.com
   password: password 
  ```
