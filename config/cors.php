<?php
return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // Permitir todos los métodos

    'allowed_origins' => ['http://localhost:4200'], // Origen del frontend

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permitir todos los headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Necesario para Sanctum

];
