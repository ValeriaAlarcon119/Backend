<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\TipoEstudioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AuthController;

Route::middleware('api')->group(function () {
    // Rutas que requieren autenticación
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
});

Route::group([], function () {
    // Rutas para el recurso Candidatos
    Route::apiResource('candidatos', CandidatoController::class);

    // Rutas para el recurso TipoEstudio
    Route::apiResource('tipos-estudio', TipoEstudioController::class);

    // Rutas para el recurso Solicitud
    Route::apiResource('solicitudes', SolicitudController::class);
    Route::put('solicitudes/{id}/cambiar-estado', [SolicitudController::class, 'cambiarEstado']);

    // Rutas de prueba
    Route::get('/test', function () {
        return response()->json(['message' => 'API funcionando']);
    });

    Route::get('/debug', function () {
        return response()->json(['message' => 'Rutas API cargadas']);
    });

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/candidatos', [CandidatoController::class, 'index']);

    // Rutas que no requieren autenticación
    Route::post('/candidatos', [CandidatoController::class, 'store']);
    Route::put('/candidatos/{id}', [CandidatoController::class, 'update']);
    Route::delete('/candidatos/{id}', [CandidatoController::class, 'destroy']);
});
