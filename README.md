### The chosen challenge is Tunzaa ERP – Mauzo (PHP/Laravel)
 

**Steps to Run the Product**
1. Copy sources to your web server document root

2. Configure your virtual hosts to point to the app if using virtual hosts

3. Change .env settings to match your server settings (DB_DATABASE,DB_USERNAME and DB_PASSWORD)

4. Run this commad **php artisan migrate** to create database tables

5. Run seeder using command **php artisan db:seed --class=DatabaseSeeder** 
   to generate default user as patmark@example.com with password password123

6. Access your app via browser example via http://localhost/tunzaa_mauzo