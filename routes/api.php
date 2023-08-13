<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;

Route::middleware('api')->group(function () {
    Route::post('/clientes', [ClientesController::class, 'store']);
    Route::get('/clientes', [ClientesController::class, 'index']);
    Route::get('/autocomplete', [ClientesController::class, 'autocomplete']);
});

