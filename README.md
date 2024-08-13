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

1. New database = `crud-app`.

2. Clone:

    ```shell
    git clone https://github.com/raflizocky/crud-app.git

    ```

3. Commands:
    - ```shell
      code crud-app && composer i && php artisan key:generate && php artisan mi:f --seed && npm i && npm run dev && php artisan ser
      ```

## Usage

-   See `DatabaseSeeder.php` or `crud-app` database for credentials.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
