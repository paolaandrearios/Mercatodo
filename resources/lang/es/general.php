<?php

return [
    'welcome' => [
        'welcome_description' => 'Bienvenido a MercaTodo, una tienda virtual donde puedes encontrar todo tipo de productos para ti y toda la familia',
        'slogan' => '"MercaTodo donde lo tienes TODO"',
    ],

    'api' => [
        'user' => [
             'update_status_success' => 'El usuario ha sido modificado satisfactoriamente',
            'update_status_error' => 'El usuario no pudo ser modificado'
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
        ],

        'exceptions' => [
            'model_not_found' => 'Elemento No Encontrado',
        ],
    ],

    'web' => [

        'close' => 'Cerrar',
        'save' => 'Guardar',
        'select' => 'Seleccione una opción',
        'search' => 'Buscar',
        'see_more' => 'Ver Más',
        'follow_us' => 'Síguenos',
        'previous' => 'Anterior',
        'next' => 'Siguiente',

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
            'actions' => 'Acciones',
            'active' => 'Activo',
            'inactive' => 'Inactivo',
            'add' => 'Agregar',
        ]
    ],

    'sidebar' => [
        'home' => 'Inicio',
        'users' => 'Usuarios',
        'categories' => 'Categorías',
        'products' => 'Productos',
    ],
];
