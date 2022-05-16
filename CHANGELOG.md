# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.4] 2022-05-16
### Added
- Install prettier code formatter
- Implement logic to import products with multiple images, within a selected date range
- Create an excel file explaining the format to import products correctly
- Implement logic to export products within a selected date range, taking into account status and category
- Implement product updates when importing products
- Generate pdf reports of relevant information for the store, using the dompdf library
- Create code so that products can be managed from a REST API
- Create permission list for users according to roles using Laravel-permission (ACL)

### Changed
- Perform massive import and export of products using the laravel excel library.
- Generate business-relevant reports using dompdf library


## [1.0.3] 2022-03-27
### Added
- Implement logic to add multiple images to the product.
- Implement logic to update product with multiple images
- Create view and logic to show product details and add to cart products
- Implement logic to remove items from shopping cart using localstorage
- Implemnt logic to add items to the order
- Implement logic to change quantity items in the cart details view
- Implement accumulated values in cart order summary
- Create route and view for checkout page
- Create checkout modal with message to go to placetopay gateway payment
- Implement dropdown menus for admin and client
- Implement order listing from client and admin side
- Implement StoreOrderRequest to validate client information in the form checkout and apply pagination to orders
- Implement connection with webcheckout and add tests.
- Create session in webcheckout from frontend when creating an order
- Implement payment attempts and store the records in the database
- Update order status according to payment status
- Create a thank you page and connect it with payment gateway information
- Implement order editing and additional functionalities
- Implement test to api in the orders in the methods, index, store and update.

### Changed
- Integration with Placetopay Web Checkout
- Implement authentication to API through laravel Sanctum


## [1.0.2] 2022-02-06
### Added
- Install laravel-permission and configure roles and access 
- Create categories and implement controller for index,store,show and updated methods
- Organize application routes based on roles
- Create Products and implement controller for index,store,show and update methods
- Implement form request for validation in all fields entered by the user
- Implement many to many relationship between categories and products
- Create homepage for products in vue components
- Implement product searcher in homepage
- Implement product filtering by category
- Implement helper to currency local format
- Adding language picker to switch languages (spanish and english)
- Add categories to cache
- Implement environment variables for pagination and images route

### Changed
- Refactor code using repositories and actions


## [1.0.1] 2022-01-02
### Added
- Configuration to verify email for new users
- Module creation to manage users
- Base template to have the first look and feel version
- Configuration to install the changelog
- Add laravel/ui vue and tailwind to the project including authentication scaffold

### Changed
- User migration and model in order to manage status active or inactive

## [1.0.0] 2021-12-19
### Added
- Install Laravel version 8 initial version

## [Unreleased]
### Added
