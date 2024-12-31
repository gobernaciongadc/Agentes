<?php

use App\Http\Controllers\AgenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\DerechosRealeController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\InformeNotarialController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\NotaryRecordController;
use App\Http\Controllers\NotificacioneController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\SancionarController;
use App\Http\Controllers\SancionController;
use App\Http\Controllers\SentenciasJudicialeController;
use App\Http\Controllers\UserController;
use App\Models\Notificacione;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect('/admin/layouts/master') : redirect()->route('login');
});


// Elemplo chat
Route::get('/chat', [ChatController::class, 'chatView'])->name('chat');
Route::post('/send-message', [ChatController::class, 'sendMessage']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/layouts/master', [App\Http\Controllers\AdminController::class, 'master'])->name('admin.layaouts.master');
Route::get('notificacion-real', [App\Http\Controllers\AdminController::class, 'notificacionReal'])->name('notificacion-real.notificacionReal');

// Mostrar informe de notificación
Route::get('notificacion-informe/{id}', [App\Http\Controllers\AdminController::class, 'mostrarInformeNotificacion'])->name('notificacion-informe.mostrarInformeNotificacion');
Route::get('notificacion-comunicado/{id}', [App\Http\Controllers\AdminController::class, 'mostrarComunicadoNotificacion'])->name('notificacion-informe.mostrarComunicadoNotificacion');
Route::get('notificacion-pago/{id}', [App\Http\Controllers\AdminController::class, 'mostrarPagoNotificacion'])->name('notificacion-Pago.mostrarPagoNotificacion');




Route::group(
    ['middleware' => ['role:Agente']],
    function () {

        // RUTA PARA AGENTES DESIGNADOS QUE CREER SUS INFORMES
        Route::resource('informe-notarials', InformeNotarialController::class);
        Route::get('informe-index-seprec', [InformeNotarialController::class, 'indexSeprec'])->name('informe-index-seprec.indexSeprec');
        Route::get('informe-index-juzgado', [InformeNotarialController::class, 'indexJuzgado'])->name('informe-index-juzgado.indexJuzgado');
        Route::get('informe-index-derecho', [InformeNotarialController::class, 'indexDerecho'])->name('informe-index-derecho.indexDerecho');
        Route::get('enviar-informe', [InformeNotarialController::class, 'enviarInforme'])->name('enviar-informe.enviarInforme'); // Enviar informe

        Route::post('verificar-informe', [InformeNotarialController::class, 'verificarInforme'])->name('verificar-informe.verificarInforme'); // Enviar informe
        // Para Plantillas PDF
        Route::get('certificado-pdf/{id}', [InformeNotarialController::class, 'pdfCertificado'])->name('certificado.pdfCertificado');

        Route::post('observar-informe', [InformeNotarialController::class, 'observarInforme'])->name('observar-informe.observarInforme'); // Enviar informe

        // RUTA PARA INFORME A DETALLE DE NOTARIOS DE FE PUBLICA
        Route::get('notary-records', [NotaryRecordController::class, 'index'])->name('notary-records.index');

        // Mostrar formulario para crear un nuevo registro
        Route::get('notary-records/create', [NotaryRecordController::class, 'create'])->name('notary-records.create');

        // Guardar un nuevo registro
        Route::post('notary-records/store', [NotaryRecordController::class, 'store'])->name('notary-records.store');

        // Mostrar un registro específico
        Route::get('notary-records/show/{id}/{idInforme}', [NotaryRecordController::class, 'show'])->name('notary-records.show');

        // Mostrar formulario para editar un registro
        Route::get('notary-records/edit/{id}/{idInforme}', [NotaryRecordController::class, 'edit'])->name('notary-records.edit');

        // Actualizar un registro existente
        // Route::match(['put', 'patch'], 'notary-records/update/{id}/{idInforme}', [NotaryRecordController::class, 'update'])->name('notary-records.update');
        Route::match(['put', 'patch'], 'notary-records/{id}/{idInforme}', [NotaryRecordController::class, 'update'])->name('notary-records.update');


        Route::delete('notary-records/{id}/{idInforme}', [NotaryRecordController::class, 'destroy'])->name('notary-records.destroy');

        // RUTA PARA AGENTES DE DERECHOS REALES
        Route::get('derechos-reales', [DerechosRealeController::class, 'index'])->name('derechos-reales.index');
        Route::get('derechos-reales/create', [DerechosRealeController::class, 'create'])->name('derechos-reales.create');
        Route::post('derechos-reales/store', [DerechosRealeController::class, 'store'])->name('derechos-reales.store');
        Route::get('derechos-reales/show/{id}/{idInforme}', [DerechosRealeController::class, 'show'])->name('derechos-reales.show');
        Route::get('derechos-reales/edit/{id}/{idInforme}', [DerechosRealeController::class, 'edit'])->name('derechos-reales.edit');
        Route::match(['put', 'patch'], 'notary-records/update/{id}/{idInforme}', [DerechosRealeController::class, 'update'])->name('derechos-reales.update');
        Route::delete('derechos-reales/{id}/{idInforme}', [DerechosRealeController::class, 'destroy'])->name('derechos-reales.destroy');



        // RUTA PARA AGENTES DE SEPREC
        Route::get('empresas', [EmpresaController::class, 'index'])->name('empresas.index');
        Route::get('empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');
        Route::post('empresas/store', [EmpresaController::class, 'store'])->name('empresas.store');
        Route::get('empresas/show/{id}/{idInforme}', [EmpresaController::class, 'show'])->name('empresas.show');
        Route::get('empresas/edit/{id}/{idInforme}', [EmpresaController::class, 'edit'])->name('empresas.edit');
        Route::match(['put', 'patch'], 'empresas/update/{id}/{idInforme}', [EmpresaController::class, 'update'])->name('empresas.update');
        Route::delete('empresas/{id}/{idInforme}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');



        // RUTA PARA AGENTES PARA SETRETARIOAS O SECRETARIOS DE JUZGADOS
        Route::get('sentencias-judiciales', [SentenciasJudicialeController::class, 'index'])->name('sentencias-judiciales.index');
        Route::get('sentencias-judiciales/create', [SentenciasJudicialeController::class, 'create'])->name('sentencias-judiciales.create');
        Route::post('sentencias-judiciales/store', [SentenciasJudicialeController::class, 'store'])->name('sentencias-judiciales.store');
        Route::get('sentencias-judiciales/show/{id}/{idInforme}', [SentenciasJudicialeController::class, 'show'])->name('sentencias-judiciales.show');
        Route::get('sentencias-judiciales/edit/{id}/{idInforme}', [SentenciasJudicialeController::class, 'edit'])->name('sentencias-judiciales.edit');
        Route::match(['put', 'patch'], 'sentencias-judiciales/update/{id}/{idInforme}', [SentenciasJudicialeController::class, 'update'])->name('sentencias-judiciales.update');
        Route::delete('sentencias-judiciales/{id}/{idInforme}', [SentenciasJudicialeController::class, 'destroy'])->name('sentencias-judiciales.destroy');

        // ENVIO DE COMPROBANTE DE PAGO
        Route::post('envio-comprobante', [SancionarController::class, 'comprobantePago'])->name('envio-comprobante.comprobantePago');
    }
);

// RUTAS PARA TODOS
// PERFIL DE USUARIO
Route::get(
    'perfilusuario/{id}',
    [UserController::class, 'perfilUsuario']
)->name('admin.perfilusuario');
Route::get('viewpassword', [UserController::class, 'viewPassword'])->name('admin.viewpassword');
Route::post('changespassword', [UserController::class, 'changesPassword'])->name('admin.changespassword');
Route::post('sancions-index-observacion', [SancionController::class, 'indexObservacion'])->name('sancions-index-observacion.indexObservacion');


// Agrupamos las rutas que solo los administradores pueden ver
Route::group(['middleware' => ['role:Administrador']], function () {

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


    // PROCESO SANCION
    Route::get('sancions', [SancionController::class, 'index'])->name('sancions.index');
    Route::get('sancions/create', [SancionController::class, 'create'])->name('sancions.create');
    Route::post('sancions/store', [SancionController::class, 'store'])->name('sancions.store');
    Route::get('sancions/show/{id}', [SancionController::class, 'show'])->name('sancions.show');
    Route::get('sancions/edit/{id}', [SancionController::class, 'edit'])->name('sancions.edit');
    Route::put('sancions/update/{id}', [SancionController::class, 'update'])->name('sancions.update');
    Route::get('sancions-bandeja-entrada/{id}', [SancionController::class, 'indexBandejaEntrada'])->name('sancions-bandeja-entrada.indexBandejaEntrada');
    Route::get('sancions-verificar/{idInforme}/{idUser}/{tipo}', [SancionController::class, 'indexVerificar'])->name('sancions-verificar.indexVerificar');

    Route::post('sancions-store-verificar', [SancionController::class, 'storeVerificar'])->name('sancions-store-verificar.storeVerificar');
    Route::post('sancions-store-observacion', [SancionController::class, 'storeObservacion'])->name('sancions-store-observacion.storeObservacion');
    Route::post('sancions-get-informe', [SancionController::class, 'getInformeSanciones'])->name('sancions-get-informe.getInformeSanciones');

    // COMUNICADOS
    Route::get('comunicados/create', [ComunicadoController::class, 'create'])->name('comunicados.create');
    Route::post('comunicados/store', [ComunicadoController::class, 'store'])->name('comunicados.store');

    Route::get('comunicados/update/{id}', [ComunicadoController::class, 'edit'])->name('comunicados.edit');
    Route::delete('comunicados/{id}', [ComunicadoController::class, 'destroy'])->name('comunicados.destroy');

    // NOTIFICACIONES
    Route::get('notificaciones/create', [NotificacioneController::class, 'create'])->name('notificaciones.create');
    Route::post('notificaciones/store', [NotificacioneController::class, 'store'])->name('notificaciones.store');

    Route::get('notificaciones/update/{id}', [NotificacioneController::class, 'edit'])->name('notificaciones.edit');
    Route::delete('notificaciones/{id}', [NotificacioneController::class, 'destroy'])->name('notificaciones.destroy');

    // REPORTES
    Route::get('reportes-transmision', [ReportesController::class, 'reporteTransmision'])->name('reportes-transmision.reporteTransmision');
    Route::post('reportes-transmision', [ReportesController::class, 'reporteTransmisionPost'])->name('reportes-transmision.reporteTransmisionPost');

    Route::get('reportes-agentes', [ReportesController::class, 'reporteAgentes'])->name('reportes-agentes.reporteAgentes');
    Route::post('reportes-agentes', [ReportesController::class, 'reporteAgentesPost'])->name('reportes-agentes.reporteAgentesPost');

    Route::get('reportes-municipio', [ReportesController::class, 'reporteMunicipio'])->name('reportes-municipio.reporteMunicipio');
    Route::post('reportes-municipio', [ReportesController::class, 'reporteMunicipioPost'])->name('reportes-municipio.reporteMunicipioPost');

    Route::get('reportes-plazos', [ReportesController::class, 'reportePlazos'])->name('reportes-plazos.reportePlazos');
    Route::post('reportes-plazos', [ReportesController::class, 'reportePlazosPost'])->name('reportes-plazos.reportePlazosPost');

    Route::get('reportes-sanciones', [ReportesController::class, 'reporteSanciones'])->name('reportes-sanciones.reporteSanciones');
    Route::post('reportes-sanciones', [ReportesController::class, 'reporteSancionesPost'])->name('reportes-sanciones.reporteSancionesPost');

    // RUTAS PARA SANCIONES
    Route::prefix('sanciones')->name('sanciones.')->group(function () {
        Route::get('/crear', [SancionarController::class, 'createSancion'])->name('create'); // Formulario para crear sanción
        Route::post('/', [SancionarController::class, 'storeSancion'])->name('store'); // Guardar sanción
        Route::get('/{sancion}/editar', [SancionarController::class, 'editSancion'])->name('edit'); // Formulario para editar sanción
        Route::put('/{sancion}', [SancionarController::class, 'updateSancion'])->name('update'); // Actualizar sanción
        Route::delete('/{sancion}', [SancionarController::class, 'destroySancion'])->name('destroy'); // Eliminar sanción
    });

    Route::post('sanciones-get-informe', [SancionarController::class, 'getInformeSanciones'])->name('sancions-get-informe.getInformeSanciones');

    // Ruta para enviar sanción a Agentes de Información
    Route::get('sanciones-envio/{sancion}/{idAgente}', [SancionarController::class, 'enviarSancion'])->name('sanciones-envio.enviarSancion');

    Route::get('sanciones/{sancion}/pago', [PagoController::class, 'show'])->name('sanciones.pago');
    Route::post('pagos/{sancion}', [PagoController::class, 'store'])->name('pagos.store');
});

// RUTAS SIN RESTRICCIONES COMUNICADOS
Route::get('comunicados', [ComunicadoController::class, 'index'])->name('comunicados.index');
Route::get('comunicados/show/{id}', [ComunicadoController::class, 'show'])->name('comunicados.show');

// RUTAS SIN RESTRICCIONES NOTIFICACIONES
Route::get('notificaciones', [NotificacioneController::class, 'index'])->name('notificaciones.index');
Route::get('notificaciones/show/{id}', [NotificacioneController::class, 'show'])->name('notificaciones.show');

// RUTAS SIN RESTRICCIONES SANCIONES
Route::get('sanciones', [SancionarController::class, 'indexSancion'])->name('sanciones.index'); // Listar sanciones
Route::get('sanciones/show/{id}', [SancionarController::class, 'showSancion'])->name('sanciones.show');


/*
Si deseas redirigir solo a los usuarios no autenticados, puedes hacer algo como esto:
php
Copiar código
Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect()->route('login');
});
*/