#### Tunzaa Mauzo Web Application

The app provides core functionality for managing sales transactions, and products.
The application supports secure authentication, role-based access control (for later implementation),
and audit-friendly logging, making it suitable for multi-user commercial environments.

*** Assumptions Made ***

- The deployment environment includes PHP 7.4 or higher, Composer, and MySQL.
- Laravel is installed and configured appropriately in the local or server environment.
- Users will interact with the system via predefined roles (e.g., Administrator, Manager, Cashier) though not fully implemented now
- Application access logs will be stored locally and secured through standard Laravel practices.

### How to Run It

1.  Clone the repository
    ```bash
    git clone https://github.com/your-org/tunzaa-mauzo.git
    cd tunzaa-mauzo

2.  Install dependencies
    ```bash
    composer install

3.  Set up environment
    ```bash
    cp .env.example .env
    php artisan key:generate
    => edit .env to configure your database credentials and app settings.

4.  Run database migrations and seeders
    ```bash
    php artisan migrate --seed

5.  Start your server
    ```bash
    php artisan serve
    => Alternatively, if you have active apache server, configure v-host