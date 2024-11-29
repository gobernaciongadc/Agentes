<?php

use App\Http\Controllers\AgenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\InformeNotarialController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\NotaryRecordController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserController;
use App\Models\Agente;
use App\Models\InformeNotarial;
use App\Models\User;
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
Route::get('listpersonas', [PersonaController::class, 'listpersonas'])->name('admin.listpersonas');

// RUTA PARA ENTIDADES TERRITORIALES MUNICIPIOS
Route::resource('municipios', MunicipioController::class);

// RUTA PARA AGENTES DESIGNADOS
Route::resource('agentes', AgenteController::class);
Route::get('listagentes', [AgenteController::class, 'listagentes'])->name('admin.listagentes');

// RUTA PARA AGENTES USERS
Route::resource('users', UserController::class);
Route::get('perfilusuario/{id}', [UserController::class, 'perfilUsuario'])->name('admin.perfilusuario');
Route::get('viewpassword', [UserController::class, 'viewPassword'])->name('admin.viewpassword');
Route::post('changespassword', [UserController::class, 'changesPassword'])->name('admin.changespassword');

// RUTA PARA AGENTES DESIGNADOS
Route::resource('informe-notarials', InformeNotarialController::class);
Route::get('informe-index-seprec', [InformeNotarialController::class, 'indexSeprec'])->name('informe-index-seprec.indexSeprec');

// RUTA PARA INFORME A DETALLE DE NOTARIOS DE FE PUBLICA
Route::get('notary-records', [NotaryRecordController::class, 'index'])->name('notary-records.index');

// Mostrar formulario para crear un nuevo registro
Route::get('notary-records/create', [NotaryRecordController::class, 'create'])->name('notary-records.create');

// Guardar un nuevo registro
Route::post('notary-records/store', [NotaryRecordController::class, 'store'])->name('notary-records.store');

// Mostrar un registro específico
Route::get('notary-records/show/{id}', [NotaryRecordController::class, 'show'])->name('notary-records.show');

// Mostrar formulario para editar un registro
Route::get('notary-records/edit/{id}', [NotaryRecordController::class, 'edit'])->name('notary-records.edit');

// Actualizar un registro existente
Route::put('notary-records/update/{id}', [NotaryRecordController::class, 'update'])->name('notary-records.update');


// RUTA PARA AGENTES DE SEPREC
Route::get('empresas', [EmpresaController::class, 'index'])->name('empresas.index');
Route::get('empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');
Route::post('empresas/store', [EmpresaController::class, 'store'])->name('empresas.store');
Route::get('empresas/show/{id}', [EmpresaController::class, 'show'])->name('empresas.show');
Route::get('empresas/edit/{id}', [EmpresaController::class, 'edit'])->name('empresas.edit');
Route::put('empresas/update/{id}', [EmpresaController::class, 'update'])->name('empresas.update');



















/*
Si deseas redirigir solo a los usuarios no autenticados, puedes hacer algo como esto:
php
Copiar código
Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect()->route('login');
});
*/