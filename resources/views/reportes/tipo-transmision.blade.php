@extends('admin.layouts.master')

@section('template_title')
Reportes
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

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

        <div class="row">

            <div class=" col-12 mb-3">
                <!-- Campo Tipo Agente -->
                <div class="form-group mb-2 mb20">
                    <label for="tipo_transmisión" class="form-label text-info">Tipo de Transmisión<span class="text-danger">*</span></label>
                    <select name="tipo_transmisión" class="form-control mb-2 mb20" id="tipo_transmisión">
                        <option value="" disabled selected>Selecciona un tipo de Transmisión</option>
                        @foreach($tipoTransmision as $tipo)
                        <option value="{{ $tipo }}">
                            {{ $tipo }}
                        </option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="transmisionTable" class="table table-striped table-hover">
                <thead class="thead small">
                    <tr>
                        <th>ID</th>
                        <th style="width: 20%">Descripción de Informe</th>
                        <th>Agentes</th>
                        <th>Tipo Agente</th>
                        <th>Fecha Emitida</th>
                        <th>Estado Recibido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody-transmision">

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Obtener el elemento select
    const tipoTransmisionSelect = document.getElementById('tipo_transmisión');

    // Agregar un evento "change" para detectar cambios en el valor seleccionado
    tipoTransmisionSelect.addEventListener('change', function() {
        const selectedValue = this.value; // Obtener el valor seleccionado
        console.log(`Tipo de transmisión seleccionada: ${selectedValue}`);

        // Aquí puedes agregar la lógica que necesitas al cambiar el valor
        // Por ejemplo, puedes llamar a una función o disparar una solicitud AJAX
        // ejemplo:
        handleTipoTransmisionChange(selectedValue);
    });

    // Función para manejar el cambio en el valor del select    

    function handleTipoTransmisionChange(value) {

        // Limpiar la tabla DataTable antes de agregar nuevos datos
        const table = $('#transmisionTable').DataTable(); // Inicializar la tabla si no lo está
        table.clear().draw(); // Limpia los datos actuales y redibuja la tabla

        let datosHtml = '';

        $.ajax({
            url: "{{ route('reportes-transmision.reporteTransmisionPost') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                tipo_transmision: value
            },
            success: function(response) {
                console.log(response); // Verifica el contenido de la respuesta
                const {
                    informes
                } = response;

                if (!informes || informes.length === 0) {
                    console.log('No hay informes disponibles.');
                    return;
                }

                // Determina el valor del estado con un switch
                let datosHtml = '';
                informes.forEach(element => {
                    let estadoTexto = '';
                    switch (element.estado) {
                        case 'Pendiente':
                            estadoTexto = '<span class="badge badge-warning">Pendiente</span>';
                            break;
                        case 'No verificado':
                            estadoTexto = '<span class="badge badge-danger">No verificado</span>';
                            break;
                        case 'Verificado':
                            estadoTexto = '<span class="badge badge-success">Verificado</span>';
                            break;
                        case 'Rechazado':
                            estadoTexto = '<span class="badge badge-dark">Rechazado</span>';
                            break;
                        case 'Corregido':
                            estadoTexto = '<span class="badge badge-primary">Corregido</span>';
                            break;
                        default:
                            estadoTexto = '<span class="badge badge-secondary">Desconocido</span>';
                            break;
                    }

                    // formateando la fecha
                    const fechaOriginal = element.created_at
                    const fecha = new Date(fechaOriginal);

                    const anio = fecha.getUTCFullYear();
                    const mes = ("0" + (fecha.getUTCMonth() + 1)).slice(-2); // Los meses empiezan en 0
                    const dia = ("0" + fecha.getUTCDate()).slice(-2);
                    const hora = ("0" + fecha.getUTCHours()).slice(-2);
                    const minutos = ("0" + fecha.getUTCMinutes()).slice(-2);

                    // Formatear como quieras
                    const fechaFormateada = `${dia}/${mes}/${anio} ${hora}:${minutos}`;

                    const btnVerificar = `<a href="/sancions-verificar/${element.id}/${element.user.id}/${element.tipo_informe}" class="btn btn-info btn-sm" title="Ver Informe"><i class="fa fa-eye"></i> Verificar</a>`;


                    datosHtml += '<tr>';
                    datosHtml += '<td>' + element.id + '</td>';
                    datosHtml += '<td>' + element.descripcion + '</td>';
                    datosHtml += '<td>' + element.user.agente.persona.nombres + ' ' + element.user.agente.persona.apellidos + '</td>';
                    datosHtml += '<td>' + element.tipo_informe + '</td>';
                    datosHtml += '<td>' + fechaFormateada + '</td>';
                    datosHtml += '<td>' + estadoTexto + '</td>';
                    datosHtml += '<td>' + btnVerificar + '</td>';
                    datosHtml += '</tr>';
                });
                $('#tbody-transmision').html(datosHtml);
            },
            error: function(xhr, status, error) {

            }
        })


    }
</script>


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
                                    <th>Ver Archivo</th>
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
    function openModalObservar(IdInforme, IdUser, TipoInforme) {
        $('#observacion-informe-modal').modal('show');
        console.log(IdInforme, IdUser, TipoInforme);

        const tbody = document.getElementById('tbody-observacion-informe');
        tbody.innerHTML = '';
        const data = {
            informe_id: IdInforme,
            user_id: IdUser,
            tipo_informacion: TipoInforme,
            _token: '{{ csrf_token() }}'
        };

        // Extraer la lista de observaciones del informe en especifico
        $.ajax({
            url: '{{ route("sancions-index-observacion.indexObservacion") }}',
            method: 'POST',
            data: data,
            success: function(response) {

                console.log(response);
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
                            <td><a href="{{ url('/observaciones') }}/${element.archivo_observacion}" target="_blank" class="btn btn-twitter btn-sm"><i class="fa fa-file"></i> Ver Archivo</a></td>
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

@vite('resources/css/reportes.css')
@vite('resources/js/reportes.js')
@endsection