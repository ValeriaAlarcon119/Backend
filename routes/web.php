<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-web', function () {
    return response()->json(['message' => 'Ruta en web.php funcionando']);
});

require base_path('routes/api.php');
