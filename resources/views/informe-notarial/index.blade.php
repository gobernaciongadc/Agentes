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
                        Informe Notarial
                    </span>

                    <div class="float-right">
                        <button type="button" id="crearInformeBtn" class="btn btn-info float-right font-14" onclick="openModal()" data-placement="left"><i class="fa fa-plus"></i> Crear Nuevo Informe</button>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success m-4">
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table id="informesTable" class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>Id</th>

                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Fecha Envio</th>

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($informeNotarials as $informeNotarial)
                            <tr>
                                <td>{{ $informeNotarial->id }}</td>

                                <td>{{ $informeNotarial->descripcion }}</td>
                                <td>{{ $informeNotarial->estado }}</td>
                                <td>{{ $informeNotarial->fecha_envio }}</td>

                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('notary-records.index', $informeNotarial->id) }}"><i class="fa fa-file"></i> Realizar Informe</a>
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

<script>
    // Abrir modal
    function openModal() {
        $('#informe-modal').modal('show');
    }

    // Cerrar modal
    function closeModal() {
        $('#informe-modal').modal('hide');
    }

    function guardarInforme() {

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
                        const nuevoRegistroSeprec = `
                            <tr>
                            <td>${informe.id}</td>
                            <td>${informe.descripcion}</td>
                            <td>${informe.estado}</td>
                            <td>${informe.fecha_envio}</td>
                            <td>
                            <a class="btn btn-sm btn-primary" href="${baseUrl}/empresas/${informe.id}"><i class="fa fa-file"></i> Realizar Informe</a>
                            </td>
                            </tr>
                            `;

                        // Agregar el nuevo registro al inicio de la tabla
                        $('#informesTable tbody').prepend(nuevoRegistroSeprec);

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
</script>


<!-- Modal -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="informe-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <span class="titulo-card">Crear Informe Notarial</span>
                        <button type="button" class="close" onclick="closeModal()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripción de Informe:</label>
                                <textarea class="form-control" id="descripcion-informe"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" onclick="closeModal()">Cerrar</button>
                        <button type="button" onclick="guardarInforme()" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> Crear</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Fin Modal -->

@vite('resources/css/informe.css')
@vite('resources/js/informe.js')
@endsection