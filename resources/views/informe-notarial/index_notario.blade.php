@extends('admin.layouts.master')

@section('template_title')
Informe Notarials
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card border">
            <div class="card-header card-bg">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title" class="titulo-card">
                        Informe de SEPREC
                    </span>

                    <div class="float-right">
                        <button type="button" id="crearInformeBtn" class="btn btn-info float-right font-14" onclick="openModal()" data-placement="left"><i class="fa fa-plus"></i> Crear Nuevo Informe</button>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success("{{ $message }}", "Agentes de Información", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 5000,
                        positionClass: 'toast-top-right'
                    });
                });
            </script>
            @endif

            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table id="informesTable" class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th style="width: 10%;">ID</th>

                                <th style="width: 30%;">Descripcion</th>
                                <th style="width: 10%;">Estado</th>
                                <th style="width: 20%;">Fecha Envio</th>

                                <th style="width: 30%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($informeNotarials as $informeNotarial)
                            <tr>
                                <td>{{ $informeNotarial->id }}</td>

                                <td>{{ $informeNotarial->descripcion }}</td>
                                <td>

                                    @switch($informeNotarial->estado)

                                    @case('Pendiente')
                                    <span class="badge badge-warning">{{ $informeNotarial->estado }}</span>
                                    @break
                                    @case('No verificado')
                                    <span class="badge badge-danger">{{ $informeNotarial->estado }}</span>
                                    @break
                                    @case('Verificado')
                                    <span class="badge badge-success">{{ $informeNotarial->estado }}</span>
                                    @break
                                    @case('Rechazado')
                                    <span class="badge badge-dark">{{ $informeNotarial->estado }}</span>
                                    @break
                                    @case('Corregido')
                                    <span class="badge badge-primary">{{ $informeNotarial->estado }}</span>
                                    @break

                                    @endswitch

                                </td>
                                <td>
                                    @if ($informeNotarial->fecha_envio)
                                    {{ $informeNotarial->fecha_envio }}
                                    @else
                                    Sin fecha de envío
                                    @endif
                                </td>

                                <td>
                                    @switch($informeNotarial->estado)

                                    @case('Pendiente')
                                    <a class="btn btn-sm btn-primary" href="{{ route('empresas.index', ['id'=>$informeNotarial->id]) }}"><i class="fa fa-file"></i> Realizar Informe</a>
                                    <!-- Mostrar botón "Sin movimiento" si no hay notarios -->

                                    @if(count($informeNotarial->notarios ?? []) == 0)
                                    <a class="btn btn-sm btn-danger text-white"
                                        onclick="confirmarEnvio(event, '/enviar-informe?id={{ $informeNotarial->id }}')">
                                        <i class="fa fa-chevron-right"></i> Sin movimiento
                                    </a>
                                    @else
                                    <a class="btn btn-sm btn-success text-white" onclick="confirmarEnvio(event, '/enviar-informe?id={{ $informeNotarial->id }}' )">
                                        <i class="fa fa-upload"></i> Enviar informe
                                    </a>
                                    @endif

                                    <script>
                                        function confirmarEnvio(event, url) {

                                            event.preventDefault(); // Evita que el enlace se ejecute automáticamente.

                                            swal({
                                                title: "¿Estás seguro?",
                                                text: "Esta acción enviará el informe. ¿Deseas continuar?",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#398bf7", // Color del botón de confirmación
                                                confirmButtonText: "Sí, enviar informe", // Texto del botón de confirmación
                                                cancelButtonText: "Cancelar", // Texto del botón cancelar                              
                                                closeOnConfirm: false
                                            }, function() {
                                                // Redirige al enlace si el usuario confirma.
                                                window.location.href = url;
                                            });

                                        }
                                    </script>
                                    @break

                                    @case('No verificado')
                                    <span class="badge badge-success">Enviado</span>
                                    @break

                                    @case('Verificado')
                                    <a class="btn btn-twitter btn-sm text-white" href="{{ route('certificado.pdfCertificado', ['id'=>$informeNotarial->id]) }}" target="_blank"><i class="fa fa-certificate"></i> Certificado de Informe</a>
                                    @break

                                    @case('Rechazado')

                                    <a class="btn btn-sm btn-dark" href="{{ route('empresas.index', ['id'=>$informeNotarial->id]) }}"><i class="fa fa-file"></i> Corregir Informe</a>
                                    <a class="btn btn-warning btn-sm text-white" onclick="openModalObservar('{{$informeNotarial->id}}','{{$informeNotarial->usuario_id}}','{{$informeNotarial->tipo_informe}}')"><i class="fa fa-eye"></i> Ver Observaciones</a>
                                    <a class="btn btn-sm btn-success text-white" onclick="confirmarEnvio(event, '/enviar-informe?id={{ $informeNotarial->id }}' )">
                                        <i class="fa fa-upload"></i> Enviar informe
                                    </a>
                                    <script>
                                        function confirmarEnvio(event, url) {

                                            event.preventDefault(); // Evita que el enlace se ejecute automáticamente.

                                            swal({
                                                title: "¿Estás seguro?",
                                                text: "Esta acción enviará el informe. ¿Deseas continuar?",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#398bf7", // Color del botón de confirmación
                                                confirmButtonText: "Sí, enviar informe", // Texto del botón de confirmación
                                                cancelButtonText: "Cancelar", // Texto del botón cancelar                              
                                                closeOnConfirm: false
                                            }, function() {
                                                // Redirige al enlace si el usuario confirma.
                                                window.location.href = url;
                                            });

                                        }
                                    </script>
                                    @break

                                    @case('Corregido')
                                    <span class="badge badge-success">Corrección Realizada y Enviada</span>
                                    @break

                                    @endswitch
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Lista de observaciones por informe -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="observacion-informe-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1200px !important;">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <span class="text-dark">Lista de Observaciones a Informe</span>
                        <button type="button" class="close" onclick="closeModalObservar()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped table-bordered">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th style="width: 40%;">Observación</th>
                                    <th>Fecha Observación</th>
                                    <!-- <th>Ver Archivo</th> -->
                                </tr>

                            </thead>
                            <tbody id="tbody-observacion-informe">

                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" onclick="closeModalObservar()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Fin Modal -->

<script>
    // Abrir modal
    function openModal() {
        $('#informe-modal').modal('show');
    }

    // Cerrar modal
    function closeModal() {
        $('#informe-modal').modal('hide');
    }
    // Cerrar modal
    function closeModalVerificar() {
        $('#mostrar-certificado').modal('hide');
    }

    function guardarInformeEjemplo() {

        const baseUrl = "{{ url('/') }}"; // Base de la URL
        // Capturamos los datos del formulario
        const datos = {
            descripcion: $('#descripcion-informe').val(),
            _token: '{{ csrf_token() }}'
        };

        // Realizamos la petición AJAX
        $.ajax({

            url: '{{ route("informe-notarials.store") }}',
            method: 'POST',
            data: datos,
            success: function(response) {

                const {
                    informe,
                    agente
                } = response;

                // Siempre sera un agente el que crea el informe

                switch (agente.tipo_agente) {
                    case 'Notarios de Fe Pública':

                        // Limpiar el formulario
                        $('#descripcion-informe').val('');

                        // Actualizar la tabla con el nuevo dato
                        const nuevoRegistroNotario = `
                            <tr>
                            <td>${informe.id}</td>
                            <td>${informe.descripcion}</td>
                            <td>${informe.estado}</td>
                            <td>${informe.fecha_envio}</td>
                            <td>
                            <a class="btn btn-sm btn-primary" href="${baseUrl}/notary-records/${informe.id}"><i class="fa fa-file"></i> Realizar Informe</a>
                            </td>
                            </tr>
                            `;

                        // Agregar el nuevo registro al inicio de la tabla
                        $('#informesTable tbody').prepend(nuevoRegistroNotario);

                        // Mostrar mensaje de éxito (opcional)
                        toastr.success('Informe creado exitosamente', 'Información correcta');

                        $('#informe-modal').modal('hide');

                        break;

                    case 'SEPREC':

                        // Limpiar el formulario
                        $('#descripcion-informe').val('');

                        // Actualizar la tabla con el nuevo dato
                        const nuevoRegistroDerechos = `
                            <tr>
                                <td style="width: 10%;">${informe.id}</td>
                                <td style="width: 30%;">${informe.descripcion}</td>
                                <td style="width: 10%;">
                                
                                 ${(() => {
                                        switch (informe.estado) {
                                            case 'Pendiente':
                                                return '<span class="badge badge-warning">' + informe.estado + '</span>';
                                            case 'No verificado':
                                                return '<span class="badge badge-danger">' + informe.estado + '</span>';
                                            case 'Verificado':
                                                return '<span class="badge badge-success">' + informe.estado + '</span>';
                                            default:
                                                return '<span class="badge badge-secondary">Desconocido</span>';
                                        }
                                   })()}
                                
                                </td>
                                <td style="width: 20%;">
                                
                                ${informe.fecha_envio || 'Sin fecha de envío'}
                                
                                </td>
                                <td style="width: 30%;">

                                ${(() => {
                                    switch (informe.estado) {
                                        case 'Pendiente':
                                           return `
                                             <a class="btn btn-sm btn-primary" href="${baseUrl}/empresas?id=${informe.id}">
                                                <i class="fa fa-file"></i> Realizar Informe
                                             </a>
                                             <a class="btn btn-sm btn-danger enviar-informe" data-id="${informe.id}" href="#">
                                                <i class="fa fa-chevron-right"></i> Sin movimiento
                                             </a>`;
                                             
                                            case 'No verificado':
                                                return  '<span class="badge badge-success">Enviado</span>';  
                                            case 'Verificado':
                                                return '<span class="badge badge-info">Consolidado</span>';
                                            default:
                                                return '<span class="badge badge-secondary">Desconocido</span>';
                                        }
                                   })()}
                                
                                </td>
                            </tr>
                            `;

                        $(document).on('click', '.enviar-informe', function(e) {
                            e.preventDefault(); // Prevenir la redirección predeterminada
                            const informeId = $(this).data('id'); // Obtener el ID del informe

                            swal({
                                title: "¿Estás seguro?",
                                text: "Esta acción enviará el informe. ¿Deseas continuar?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#398bf7", // Color del botón de confirmación
                                confirmButtonText: "Sí, enviar informe", // Texto del botón de confirmación
                                cancelButtonText: "Cancelar", // Texto del botón cancelar 
                                cancelButtonColor: "#f46a6a",
                                closeOnConfirm: false

                            }, function() {
                                // Aquí puedes redirigir o hacer una solicitud AJAX
                                $.ajax({
                                    url: `${baseUrl}/enviar-informe?id=${informeId}`, // Ruta de tu servidor
                                    type: 'GET',
                                    success: function(response) {
                                        window.location.href = `${baseUrl}/informe-index-seprec`;
                                    },
                                    error: function() {
                                        swal("Error", "Ocurrió un error al enviar el informe. Inténtalo nuevamente.", "error");
                                    }
                                });
                            });
                        });

                        // Agregar el nuevo registro al inicio de la tabla
                        $('#informesTable tbody').prepend(nuevoRegistroDerechos);

                        // Mostrar mensaje de éxito (opcional)
                        toastr.success('Informe creado exitosamente', 'Información correcta');

                        $('#informe-modal').modal('hide');

                        break;

                    case 'Derechos Reales':

                        break;
                    case 'Jueces y Secretarios del Tribunal Departamental de Justicia':

                        break;

                    case 'proceso sancionador administrativo':

                        break;

                    default:
                        break;
                }

            },
            error: function(error) {
                console.error('Error:', error);
                toastr.error(`${error.responseJSON.message}`, 'Error!');
            }
        });
    }

    function mostrarVerificacion(idInforme) {

        const baseUrl = "{{ url('/') }}"; // Base de la URL
        $('#mostrar-certificado').modal('show');

        const descripcion = document.getElementById('parrafo-verificar');
        const certificado = document.getElementById('file-certificado');


        const datos = {
            id: idInforme,
            _token: '{{ csrf_token() }}'
        };

        console.log(datos);


        // Una consulta ajax jquery
        $.ajax({
            url: '{{ route("verificar-informe.verificarInforme") }}',
            method: 'POST',
            data: datos,
            success: function(response) {

                console.log(response);

                const {
                    verificar
                } = response;


                descripcion.innerHTML = verificar.descripcion;

                certificado.innerHTML = ` 
                            <a class="btn btn-twitter font-14" href="{{ asset('verificaciones/') }}/${verificar.certificado}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Descargar certificado
                            </a>`;

            },
            error: function(response) {
                console.error('Error:', response);
            }
        })
    }

    // Abrir modal
    function openModalObservar(IdInforme, IdUser, TipoInforme) {
        $('#observacion-informe-modal').modal('show');
        // console.log(IdInforme, IdUser, TipoInforme);

        const tbody = document.getElementById('tbody-observacion-informe');
        tbody.innerHTML = '';
        const data = {
            informe_id: IdInforme,
            user_id: IdUser,
            tipo_informacion: TipoInforme,
            _token: '{{ csrf_token() }}'
        };

        console.log(data);


        // Extraer la lista de observaciones del informe en especifico
        $.ajax({
            url: '{{ route("sancions-index-observacion.indexObservacion") }}',
            method: 'POST',
            data: data,
            success: function(response) {

                // console.log(response);
                const {
                    observacion
                } = response

                observacion.forEach(element => {
                    // Convertir la fecha al formato deseado
                    const createdAt = new Date(element.created_at);
                    const formattedDate = createdAt.toLocaleDateString('es-ES', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    tbody.innerHTML += `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.descripcion}</td>
                            <td>${formattedDate}</td>
                        </tr>
                    `;
                });

            },
            error: function(response) {

                toastr.error('Ocurrio un error al obtener la lista de observaciones', 'Agentes de Información');
            }
        });
    }

    // Cerrar modal
    function closeModalObservar() {
        $('#observacion-informe-modal').modal('hide');
    }
</script>


<!-- Modal crear informe -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="informe-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1300px !important;">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <span class="titulo-card">Crear Informe</span>
                        <button type="button" class="close" onclick="closeModal()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="periodoTable" class="table">
                                <thead class="thead small">
                                    <tr>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                        <th class="text-white font-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periodos as $periodo)
                                    <tr>
                                        <td class="text-dark font-bold">{{ $periodo->year }}</td>

                                        <td>
                                            @if ($periodo->enero == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-enero"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Enero">
                                            <label for="{{ $periodo->year }}-enero"><span class="badge badge-danger">Enero</span></label>
                                            @else
                                            <span class="badge badge-success">Enero</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($periodo->febrero == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-febrero"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Febrero">
                                            <label for="{{ $periodo->year }}-febrero"><span class="badge badge-danger">Febrero</span></label>
                                            @else
                                            <span class="badge badge-success">Febrero</span>
                                            @endif
                                        </td>


                                        <td>
                                            @if ($periodo->marzo == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-marzo"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Marzo">
                                            <label for="{{ $periodo->year }}-marzo"><span class="badge badge-danger">Marzo</span></label>
                                            @else
                                            <span class="badge badge-success">Marzo</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->abril == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-abril"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Abril">
                                            <label for="{{ $periodo->year }}-abril"><span class="badge badge-danger">Abril</span></label>
                                            @else
                                            <span class="badge badge-success">Abril</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->mayo == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-mayo"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Mayo">
                                            <label for="{{ $periodo->year }}-mayo"><span class="badge badge-danger">Mayo</span></label>
                                            @else
                                            <span class="badge badge-success">Mayo</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->junio == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-junio"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Junio">
                                            <label for="{{ $periodo->year }}-junio"><span class="badge badge-danger">Junio</span></label>
                                            @else
                                            <span class="badge badge-success">Junio</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->julio == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-julio"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Julio">
                                            <label for="{{ $periodo->year }}-julio"><span class="badge badge-danger">Julio</span></label>
                                            @else
                                            <span class="badge badge-success">Julio</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->agosto == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-agosto"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Agosto">
                                            <label for="{{ $periodo->year }}-agosto"><span class="badge badge-danger">Agosto</span></label>
                                            @else
                                            <span class="badge badge-success">Agosto</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->septiembre == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-septiembre"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Septiembre">
                                            <label for="{{ $periodo->year }}-septiembre"><span class="badge badge-danger">Septiembre</span></label>
                                            @else
                                            <span class="badge badge-success">Septiembre</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->octubre == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-octubre"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Octubre">
                                            <label for="{{ $periodo->year }}-octubre"><span class="badge badge-danger">Octubre</span></label>
                                            @else
                                            <span class="badge badge-success">Octubre</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->noviembre == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-noviembre"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Noviembre">
                                            <label for="{{ $periodo->year }}-noviembre"><span class="badge badge-danger">Noviembre</span></label>
                                            @else
                                            <span class="badge badge-success">Noviembre</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($periodo->diciembre == 'disponible')
                                            <input type="checkbox"
                                                id="{{ $periodo->year }}-diciembre"
                                                class="chk-col-cyan"
                                                data-year="{{ $periodo->year }}"
                                                data-periodo="Diciembre">
                                            <label for="{{ $periodo->year }}-diciembre"><span class="badge badge-danger">Diciembre</span></label>
                                            @else
                                            <span class="badge badge-success">Diciembre</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" onclick="closeModal()">Cerrar</button>
                        <button type="button" id="btn-guardar" onclick="guardarInforme()" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> Crear</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Fin Modal -->
<script>
    // OJO NO BORRAR
    function guardarInforme() {

        const baseUrl = "{{ url('/') }}"; // Base de la URL
        const btnGuardar = document.getElementById('btn-guardar');

        // Capturar todos los checkboxes seleccionados
        const selectedCheckboxes = document.querySelectorAll('#periodoTable input[type="checkbox"]:checked');

        // Crear un array para almacenar la información
        const selectedPeriods = [];

        selectedCheckboxes.forEach(checkbox => {
            const year = checkbox.dataset.year;
            const periodo = checkbox.dataset.periodo;
            selectedPeriods.push({
                year,
                periodo
            });
        });

        // Solo puede selecionar uno validar
        if (selectedPeriods.length > 1) {
            toastr.error('Solo puede seleccionar un periodo', 'Error!');
            return;
        }
        // Solo puede selecionar uno validar
        if (selectedPeriods.length <= 0) {
            toastr.error('Seleccione al menos un periodo', 'Error!');
            return;
        }

        // Mostrar los datos seleccionados
        console.log('Periodos seleccionados:', selectedPeriods);
        const datos = {
            year: selectedPeriods[0].year,
            periodo: selectedPeriods[0].periodo,
            descripcion: `Informe del periodo ${selectedPeriods[0].periodo} del año ${selectedPeriods[0].year}`,
            _token: '{{ csrf_token() }}'
        };
        // Realizamos la petición AJAX
        $.ajax({
            url: '{{ route("informe-notarials.store") }}',
            method: 'POST',
            data: datos,
            beforeSend: function() {
                btnGuardar.disabled = true;
            },
            success: function(response) {
                btnGuardar.disabled = true;
                const {
                    informe,
                    agente
                } = response;

                // Actualizar la pagina 
                location.reload();
                // Siempre sera un agente el que crea el informe

            },
            error: function(error) {
                console.error('Error:', error);
                toastr.error(`${error.responseJSON.message}`, 'Error!');
            }
        });
    }
</script>

<!-- Modal Mostrar certificado -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="mostrar-certificado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #55acee;">
                        <span class="titulo-card">Certificación de Informe</span>
                        <button type="button" class="close" onclick="closeModalVerificar()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p id="parrafo-verificar"></p>
                            <br>
                            <div id="file-certificado">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" onclick="closeModalVerificar()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal mostrar certificado -->
    </div>
</div>
<!-- Fin Modal -->

@vite('resources/css/informe.css')
@vite('resources/js/informe.js')
@endsection