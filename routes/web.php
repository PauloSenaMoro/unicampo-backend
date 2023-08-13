<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;

Route::get('/clientes/cadastrar', [ClientesController::class, 'create'])->name('cliente.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');


Route::get('/', function () {
    return view('welcome');
});
