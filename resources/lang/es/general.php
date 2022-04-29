<?php

return [
    'welcome' => [
        'welcome_description' => 'Bienvenido a MercaTodo, una tienda virtual donde puedes encontrar todo tipo de productos para ti y toda la familia',
        'slogan' => '"MercaTodo donde lo tienes TODO"',
    ],

    'api' => [
        'user' => [
             'update_status_success' => 'El usuario ha sido modificado satisfactoriamente',
            'update_status_error' => 'El usuario no pudo ser modificado',
        ],

        'category' => [
            'update_status_success' => 'La Categoría ha sido modificada satisfactoriamente',
            'update_status_error' => 'La Categoría no pudo ser modificada',
            'create_status_success' => 'La categoría ha sido creada con éxito',
            'name_category_rule_message' => 'El nombre de la categoria ya existe',
        ],

        'product' => [
            'update_status_success' => 'El producto ha sido modificado satisfactoriamente',
            'update_status_error' => 'El producto no pudo ser modificado',
            'create_status_success' => 'El producto ha sido creado con éxito',
            'name_product_rule_message' => 'El nombre del producto ya existe',
            'characters_number_product_rule_message' => 'Ingrese mínimo 4 caracteres para la búsqueda',
        ],

        'order' => [
            'update_status_success' => 'El pedido ha sido modificado satisfactoriamente',
            'update_status_error' => 'El pedido no pudo ser modificado',
            'create_status_success' => 'El pedido ha sido creado con éxito',
        ],

        'checkout' => [
            'payment_description' => 'Pago del pedido - :attribute del comercio electrónico MercaTodo',
        ],

        'data_management' => [
            'import_status_success' => 'Productos importados exitosamente',
        ],

        'exceptions' => [
            'model_not_found' => 'Elemento No Encontrado',
        ],
    ],

    'web' => [

        'close' => 'Cerrar',
        'save' => 'Guardar',
        'show' => 'Ver',
        'edit' => 'Editar',
        'select' => 'Seleccione una opción',
        'search' => 'Buscar',
        'search_sentence' => '¿Qué quieres encontrar?',
        'see_more' => 'Ver Más',
        'follow_us' => 'Síguenos',
        'previous' => 'Anterior',
        'next' => 'Siguiente',
        'file_import' => 'Archivo para importar',
        'choose_file' => 'Escoger archivo',
        'download' => 'Descargar',

        'user' => [
            'user_list' => 'Lista de Usuarios',
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'status' => 'Estado',
            'actions' => 'Acciones',
            'active' => 'Activo',
            'inactive' => 'Inactivo',
            'password' => 'Contraseña',
            'confirm-password' => 'Confirmar Contraseña',
            'register' => 'Registro',
            'register-in' => 'Registrarse',
            'edit-user' => 'Editar Usuario',
            'show-user' => 'Usuario',
        ],

        'category' => [
            'category_list' => 'Lista de Categorías',
            'create_category' => 'Crear Categoría',
            'edit_category' => 'Editar Categoría',
            'name' => 'Nombre',
            'name_es' => 'Nombre en español',
            'name_en' => 'Nombre en inglés',
            'outstanding_image' => 'Imagen destacada',
            'slug' => 'Url amigable',
            'type' => 'Tipo',
            'category' => 'Categoría',
            'subcategory' => 'Subcategoría',
            'status' => 'Estado',
            'actions' => 'Acciones',
            'active' => 'Activo',
            'inactive' => 'Inactivo',
            'icon' => 'ícono',
            'add' => 'Agregar',
        ],

        'product' => [
            'product_list' => 'Lista de Productos',
            'create_product' => 'Crear Producto',
            'edit_product' => 'Editar Producto',
            'product' => 'Producto',
            'name' => 'Nombre',
            'sku' => 'sku',
            'name_es' => 'Nombre en Español',
            'name_en' => 'Nombre en Inglés',
            'description_es' => 'Descripción en Español',
            'description_en' => 'Descripción en Inglés',
            'image' => 'Imagen',
            'price' => 'Precio',
            'taxes' => 'Impuestos',
            'stock' => 'Inventario',
            'status' => 'Estado',
            'slug' => 'Url amigable',
            'actions' => 'Acciones',
            'active' => 'Activo',
            'inactive' => 'Inactivo',
            'add' => 'Agregar',
            'products_found' => 'Productos Encontrados',
            'product_found' => 'Producto Encontrado',
            'not_found' => 'Lo Sentimos, Producto No Encontrado',
            'information' => 'Información',
            'images' => 'Imágenes',
            'images0' => 'Imágenes0',
            'images1' => 'Imágenes1',
            'images2' => 'Imágenes2',
            'images3' => 'Imágenes3',
            'images4' => 'Imágenes4',
        ],
        'order' => [
            'cart' => 'Carrito',
            'empty_cart' => 'Tu carrito esta vacío',
            'checkout' => 'Comprar Ahora',
            'add_to_cart' => 'Agregar al Carrito',
            'added_successfully' => '¡Tu producto ha sido agregado exitosamente al carrito!',
            'see_cart' => 'Ver Carrito',
            'total_cost' => 'Costo Total',
            'taxes' => 'Impuestos',
            'subtotal' => 'Subtotal',
            'continue_shopping' => 'Continuar Comprando',
            'quantity' => 'Cantidad',
            'price' => 'Precio',
            'total' => 'Total',
            'product_details' => 'Detalles de Producto',
            'items' => 'Items',
            'order_summary' => 'Resumen Orden',
            'shipping_information' => 'Información de Envío',
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'document_type' => 'Tipo de Documento',
            'document_number' => 'Número de Documento',
            'citizenship_id' => 'Cédula de Ciudadanía',
            'foreigner_id' => 'Cédula de Extranjería',
            'passport' => 'Pasaporte',
            'email' => 'Correo Electrónico',
            'address' => 'Dirección',
            'city' => 'Ciudad',
            'postcode' => 'Código Postal',
            'phone' => 'Teléfono',
            'notes' => 'Notas (Opcional)',
            'notes_delivery' => 'Notas de Entrega',
            'process' => 'Procesar Pago',
            'back_home' => 'Volver a inicio',
            'our_payment_gateway' => 'Nuestra pasarela de pagos es',
            'click_button_gateway' => 'Haga click en continuar con el pago y lo redirigiremos a la pasarela de pagos.',
            'pay_with_confidence' => '¡Pague con confianza!',
            'cancel' => 'Cancelar',
            'continue_payment' => 'Continuar con el pago',
            'orders_review' => 'Si desea volver a ver el pedido y reanudar el pago, consulte el historial en la sección de pedidos',
            'your_orders' => 'Tus Pedidos',
            'reference' => 'Referencia',
            'date' => 'Fecha',
            'status' => 'Estado',
            'customer_cart' => 'Carrito del Cliente',
            'customer' => 'Cliente',
            'shipping_address' => 'Dirección de envío',
            'order' => 'Pedido',
            'see_orders' => 'Ver Pedidos',
            'check_history_orders' => 'Si desea ver el pedido nuevamente y reanudar el pago, consulte el historial en la sección de pedidos',
        ],
        'payment' => [
            'reference' => 'Referencia',
            'retry_payment' => 'Reintentar Pago',
            'payment_record' => 'Registro Intentos de Pago',
            'rejected' => 'Rechazado',
            'approved' => 'Aprobado',
            'pending' => 'Pendiente',
            'cancelled' => 'Cancelado',
            'successful_payment' => '¡Pago Exitoso!',
            'successful_description' => 'Gracias por completar su pago seguro en línea.',
            'rejected_payment' => 'Pago Rechazado :(',
            'rejected_description' => 'Lo sentimos, no se pudo realizar su pago, por favor intenta nuevamente',
            'pending_payment' => 'Pago Pendiente',
            'pending_description' => 'El proceso de pago está pendiente, consulte mas tarde.',
            'great_day' => '¡Que tengas un gran día!',
        ],
        'data_management' => [
            'import_products' => 'Importar Productos',
            'import_description' => 'El archivo de importación debe estar en formato xlsx. Para importar los productos correctamente, por favor descargue el archivo de ejemplo con el formato requerido.',
        ],
    ],

    'sidebar' => [
        'home' => 'Inicio',
        'users' => 'Usuarios',
        'categories' => 'Categorías',
        'products' => 'Productos',
        'e-commerce' => 'E-commerce',
        'dashboard' => 'Tablero de Inicio',
        'customer_orders' => 'Pedido de los clientes',
    ],
];
