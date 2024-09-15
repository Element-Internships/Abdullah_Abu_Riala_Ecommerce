# 💫 BU eCommerce Website :

This is an eCommerce website built using PHP and the Laravel framework. The project includes a user-facing interface for shopping and an admin dashboard for managing products, categories, orders, and users.

Features
User Interface:
Product Browsing: Users can view products by category and see detailed product information.
Search Functionality: Includes an auto-complete search bar that suggests products as the user types.
Shopping Cart: Users can add products to their cart, update quantities, and proceed to checkout.
Order Management: Users can view their past orders and order details.
Favorites: Users can add products to their favorites list for easy access later.
Payment Integration: Cash on delivery option is available for orders.
Admin Dashboard:
Product Management: Admins can view, add, edit, and delete products.
Category Management: Admins can manage product categories.
Order Management: Admins can view all user orders and update order statuses.
User Management: Admins can view and manage users.
Technology Stack
Backend: PHP 9, Laravel 10
Frontend: Blade templates, Bootstrap, jQuery, SweetAlert2
Database: MySQL
Version Control: Git
Installation
Prerequisites:
PHP 8.x or higher
MySQL 5.7 or higher
Composer
Node.js and npm (for front-end dependencies)
Steps:
Clone the repository:

bash
Copy code
git clone https://github.com/Element-Internships/Abdullah_Abu_Riala_Ecommerce.git
cd your-ecommerce-project
Install PHP dependencies:

bash
Copy code
composer install
Install front-end dependencies:

bash
Copy code
npm install
npm run dev
Set up the environment file:

Copy the .env.example file to .env:

bash
Copy code
cp .env.example .env
Update the database connection details in the .env file:

makefile
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
Generate an application key:

bash
Copy code
php artisan key:generate
Run database migrations and seed the database:

bash
Copy code
php artisan migrate --seed
Serve the application:

bash
Copy code
php artisan serve
The application will be accessible at http://127.0.0.1:8000.
