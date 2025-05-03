# TunzaaMauzo (Forked Project)

This is a **fork** of the original Sales Tracker application. It has been enhanced with a modern Laravel + Bootstrap interface and features for managing inventory, products, and sales efficiently.

---

##  What I Built

This fork adds:

- Full CRUD operations for products with advanced fields (SKU, unit, reorder level, etc.)
-  Sales process with line chart for past 7-day tracking using Chart.js
-  Sales linked to users and products via relational models
-  Inventory display with category filters and featured product layout
-  Authenticated dashboard with logout, username, and responsive sidebar using Bootstrap and Font Awesome

---

##  Assumptions

- Users must be authenticated to manage or view sales/products
- Sales are stored along with associated user, products, and their pricing at the time of sale
- Each sale consists of multiple items (product, quantity, and individual sale price)

---

##  How to Run Locally

1. **Fork this repo** and clone it:
   ```bash
   git clone https://github.com/rama47/superteamengineeringchallenge.git
   cd superteamengineeringchallenge
   ```

2. **Install backend dependencies**:
   ```bash
   composer install
   ```

3. **Install frontend dependencies and build assets**:
   ```bash
   npm install
   npm run dev
   ```

4. **Set up environment variables**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run database migrations**:
   ```bash
   php artisan migrate
   ```



6. **Serve the application**:
   ```bash
   php artisan serve
   ```
7. **User Registration**:
when open http://127.0.0.1:8000 add /register for it to be http://127.0.0.1:8000/register that you can register first user
Access the app at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧠 Design Choices

- 🧱 Used Bootstrap grid and utility classes to maintain mobile responsiveness.
- 📊 Included Chart.js to provide a clear visual summary of recent sales.
- 📁 Reused Laravel Blade templates for consistent layout and easy maintenance.
- 👤 User authentication and `user_id` tracking implemented for accountability.
- 📂 Sales are stored using a pivot table `sale_product` for flexible multi-item tracking.

---

## 📸 (Optional) Walkthrough Video

A brief walkthrough video of the features and layout can be found here:

📹 [Loom / YouTube link here if available]

---

## 🔗 Useful Scripts

Rebuild frontend:
```bash
npm run build
```

Reset the DB:
```bash
php artisan migrate:fresh --seed
```

---

## 🛠 Tech Stack

- Laravel 12+
- Bootstrap 5
- Font Awesome
- Chart.js
- MySQL

---

## 🙋‍♂️ Author

**Ramadhani Mohamed Ntulwe**  
📍 Dar es Salaam, Tanzania  
📧 ramantulwe@gmail.com  
📱 +255 745 300 070  
🌐 [GitHub](https://github.com/rama47)

---
