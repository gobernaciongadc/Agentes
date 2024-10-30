<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect('/admin/layouts/master') : redirect()->route('login');
});


Route::get('/chat', [ChatController::class, 'chatView'])->name('chat');
Route::post('/send-message', [ChatController::class, 'sendMessage']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/layouts/master', [App\Http\Controllers\AdminController::class, 'master'])->name('admin.layaouts.master');


// RUTA PARA PERSONAS
Route::resource('personas', PersonaController::class);


/*
Si deseas redirigir solo a los usuarios no autenticados, puedes hacer algo como esto:
php
Copiar código
Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect()->route('login');
});
*/