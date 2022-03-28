# 🛒 Mercatodo, e-commerce web application 🛍️
---
Project created for the management of electronic commerce products, both from the client side and from the administrator side. The platform has an administrator panel from where you can create, edit, enable and disable products, view customer orders and also manage users who register on the platform.

From the client side, the user will be able to see the grid of available products, see the details of the products, add them to the shopping cart and once registered, they will be able to create a purchase order and carry out the corresponding payment process.

## Installation 🚀
This application is built in php using laravel 8, so you must have a web server and for its installation you must take into account the following instructions:

1. Clone the repository and cd int it
2. Composer install
3. Rename or copy .env.example file to .env
4. Generate application key - php artisan key:generate
5. Set your database credentials in your .env file
6. Create Database then migrate and seed - php artisan migrate --seed
7. Linking Storage folder to public - php artisan storage:link
8. Compile all your assets - npm install && npm run dev
9. Serve the application - php artisan serve or use XAMPP, Laragon etc.

### Project Stages 👣
This project is developed in four stages:

1. Authentication and user management module.
2. Product management module, creation, editing and product list display.
3. View product details, add desired products to shopping cart, order management and integration with payment gateway.
4. Import products in bulk from excel, download list of products and generate reports with relevant business information

## Built with 🛠️

Tools used to develop the project:

- Git
- GitHub (repository)
- MySQL
- PHP
- Laravel 8
- Vue JS
- Sass
- Tailwind CSS

## Thank You 🙏🏻
I hope that the information provided in this project is useful and to your liking!

Thank you very much!


---

💻 with ❤️  😊
