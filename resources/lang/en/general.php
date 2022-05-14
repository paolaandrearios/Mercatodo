<?php

return [

    'welcome' => [
        'welcome_description' => 'Welcome to MercaTodo, a virtual store where you can find all kinds of products for you and the whole family',
        'slogan' => '"MercaTodo where you have EVERYTHING"',
    ],

    'api' => [
        'user' => [
            'update_status_success' => 'User has been successfully modified',
            'update_status_error' => 'User could not be modified',
        ],

        'category' => [
            'update_status_success' => 'Category has been successfully modified',
            'update_status_error' => 'Category could not be modified',
            'create_status_success' => 'Category has been successfully created',
            'name_category_rule_message' => 'Category name is used',
        ],

        'product' => [
            'update_status_success' => 'Product has been successfully modified',
            'update_status_error' => 'Product could not be modified',
            'create_status_success' => 'Product has been successfully created',
            'name_product_rule_message' => 'Product name is used',
            'characters_number_product_rule_message' => 'Enter minimum 4 characters for the search',
        ],

        'order' => [
            'update_status_success' => 'Order has been successfully modified',
            'update_status_error' => 'Order could not be modified',
            'create_status_success' => 'Order has been successfully created',
        ],

        'checkout' => [
            'payment_description' => 'Payment of the order - :attribute of the e-commerce MercaTodo',
        ],

        'data_management' => [
            'import_status' => 'The data is being processed, a notification will be sent to your e-mail when the process is finished.',
            'export_status' => 'Your request is being processed, once completed, you will receive an email notification with a link to download the excel file.',
            'report_status' => 'Your request is being processed, once completed, you will receive an email notification with a link to download the pdf file.',
        ],

        'exceptions' => [
            'model_not_found' => 'Element Not Found',
        ],

    ],

    'web' => [
        'errors' => 'Errors!',
        'hello' => 'Hello!',
        'thanks_use_application' => 'Thank you for using our application!',
        'regards' => 'Regards',
        'mercatodo' => 'MercaTodo',
        'close' => 'Close',
        'save' => 'Save',
        'show' => 'Show',
        'edit' => 'Edit',
        'select' => 'Select one option',
        'search' => 'Search',
        'search_sentence' => 'What do you want to find?',
        'see_more' => 'See More',
        'follow_us' => 'Follow Us',
        'previous' => 'Previous',
        'next' => 'Next',
        'file_import' => 'File to Import',
        'choose_file' => 'Choose File',
        'download' => 'Download',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'initial_date' => 'Initial Date',
        'end_date' => 'End Date',

        'user' => [
            'user_list' => 'User List',
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'administrator' => 'Administrator',
            'client' => 'Client',
            'stock_assistant' => 'Stock Assistant',
            'financial_assistant' => 'Financial Assistant',
            'logistic_assistant' => 'Logistic Assistant',
            'marketing_assistant' => 'Marketing Assistant',
            'status' => 'Status',
            'actions' => 'Actions',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'password' => 'Password',
            'confirm-password' => 'Confirm Password',
            'register' => 'Register',
            'register-in' => 'Register',
            'edit-user' => 'Edit User',
            'show-user' => 'User',
        ],

        'category' => [
            'category_list' => 'Category List',
            'create_category' => 'Create Category',
            'edit_category' => 'Edit Category',
            'name' => 'Name',
            'name_es' => 'Spanish Name',
            'name_en' => 'English Name',
            'outstanding_image' => 'Outstanding Image',
            'slug' => 'Friendly Url',
            'type' => 'Type',
            'category' => 'Category',
            'subcategory' => 'Subcategory',
            'status' => 'Status',
            'actions' => 'Actions',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'icon' => 'icon',
            'add' => 'Add',
        ],

        'product' => [
            'product_list' => 'Product List',
            'create_product' => 'Create Product',
            'edit_product' => 'Edit Product',
            'product' => 'Product',
            'name' => 'Name',
            'sku' => 'sku',
            'name_es' => 'Spanish Name',
            'name_en' => 'English Name',
            'description_es' => 'Spanish Description',
            'description_en' => 'English Description',
            'image' => 'Image',
            'price' => 'Price',
            'taxes' => 'Taxes',
            'stock' => 'Stock',
            'status' => 'Status',
            'slug' => 'Friendly Url',
            'actions' => 'Actions',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'add' => 'Add',
            'products_found' => 'Products Found',
            'product_found' => 'Product Found',
            'not_found' => 'Sorry, Product Not Found',
            'information' => 'Information',
            'images' => 'Images',
            'images0' => 'Images0',
            'images1' => 'Images1',
            'images2' => 'Images2',
            'images3' => 'Images3',
            'images4' => 'Images4',

        ],
        'order' => [
            'cart' => 'Cart',
            'checkout' => 'Checkout',
            'empty_cart' => 'Your cart is empty',
            'add_to_cart' => 'Add to Cart',
            'added_successfully' => 'Your product has been successfully added to cart!',
            'see_cart' => 'See Cart',
            'total_cost' => 'Total Cost',
            'taxes' => 'Taxes',
            'subtotal' => 'Subtotal',
            'continue_shopping' => 'Continue Shopping',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
            'product_details' => 'Product Details',
            'items' => 'Items',
            'order_summary' => 'Order Summary',
            'shipping_information' => 'Shipping Information',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'document_type' => 'Document Type',
            'document_number' => 'Document Number',
            'citizenship_id' => 'Citizenship Id',
            'foreigner_id' => 'Foreigner Id',
            'passport' => 'Passport',
            'email' => 'Email',
            'address' => 'Address',
            'city' => 'City',
            'postcode' => 'Post Code',
            'phone' => 'Phone',
            'notes' => 'Notes (Optional)',
            'notes_delivery' => 'Notes for delivery',
            'process' => 'Process Payment',
            'back_home' => 'Back Home',
            'our_payment_gateway' => 'Our Payment Gateway is',
            'click_button_gateway' => 'Click in continue with the payment and we redirect you to the payment gateway.',
            'pay_with_confidence' => 'Pay with confidence!',
            'cancel' => 'Cancel',
            'continue_payment' => 'Continue with the payment',
            'orders_review' => 'If you want to see the order again and resume the payment, check the history in the orders section',
            'your_orders' => 'Your Orders',
            'reference' => 'Reference',
            'date' => 'Date',
            'status' => 'Status',
            'customer_cart' => 'Customer\'s Cart',
            'customer' => 'Customer',
            'shipping_address' => 'Shipping Address',
            'order' => 'Order',
            'see_orders' => 'See Orders',
            'check_history_orders' => 'If you want to see the order again and resume the payment, check the history in the orders section',
        ],
        'payment' => [
            'reference' => 'Reference',
            'retry_payment' => 'Retry Payment',
            'payment_record' => 'Record Payment Attempts',
            'rejected' => 'Rejected',
            'approved' => 'Approved',
            'pending' => 'Pending',
            'cancelled' => 'Cancelled',
            'successful_payment' => 'Successful Payment!',
            'successful_description' => 'Thank you for completing your secure online payment.',
            'rejected_payment' => 'Payment Rejected :(',
            'rejected_description' => 'Sorry, your payment could not be processed, please try again.',
            'pending_payment' => 'Payment Pending',
            'pending_description' => 'The payment process is pending, check later',
            'great_day' => 'Have a great day!',
        ],
        'data_management' => [
            'import_products' => 'Import Products',
            'export_products' => 'Export Products',
            'import_description' => 'The import file must be in xlsx format. In order to import the products correctly, please download the sample file with the required format.',
            'all_products' => 'All Products',
            'active_products' => 'Active Products',
            'inactive_products' => 'Inactive Products',
            'export_description' => 'Please select the option according to the products you want to export',
            'by_status' => 'By Status',
            'by_category' => 'By Category',
            'reports' => 'Reports',
            'generate_report' => 'Generate Report',
            'select_report_type' => 'Select report type',
            'most_visited_products' => 'Top 10 most visited products',
            'best_selling_products' => 'Top 10 best-selling products',
            'least_sold_products' => 'Top 10 least sold products',
            'abandoned_carts' => 'Abandoned Carts',
            'best_selling_category' => 'Best selling category',
            'reports_description' => 'For an adequate management of your business it is necessary to generate reports that allow you to take action, select below the report you wish to generate.',
            'error_email_description' => 'Sorry, the products in the ":fileName" file could not be imported, please try again',
            'success_email_description' => 'We inform you that the products in the file ":fileName" were successfully imported.',
            'error_mail_products' => 'The products could not be imported (file: :fileName)',
            'success_mail_products' => 'Successfully imported products (file: :fileName)',
            'success_mail_exported_products' => 'Successfully Exported products (file: :fileName)',
            'success_mail_report_generated' => 'Report generated successfully (file: :fileName)',
            'go_store' => 'Go to the store',
            'download_file' => 'Download File',
            'success_export_email_description' => 'We inform you that the requested products were successfully exported, below you will find a button for downloading, file ":fileName".',
            'success_report_email_description' => 'We inform you that the requested report was successfully generated, below you will find a button for downloading, file ":fileName".',

        ],
    ],

    'sidebar' => [
        'home' => 'Home',
        'users' => 'Users',
        'categories' => 'Categories',
        'products' => 'Products',
        'e-commerce' => 'E-commerce',
        'dashboard' => 'Dashboard',
        'customer_orders' => 'Customer Orders',
    ],

];
