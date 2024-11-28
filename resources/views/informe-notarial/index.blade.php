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
                        <a href="#" id="crearInformeBtn" class="btn btn-info float-right font-14" data-toggle="modal" data-target="#responsive-modal">
                            <i class="fa fa-plus"></i> Crear Nuevo Informe
                        </a>
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
                                    <form action="{{ route('informe-notarials.destroy', $informeNotarial->id) }}" method="POST">
                                        <a class="btn btn-sm btn-primary " href="{{ route('informe-notarials.show', $informeNotarial->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                        <a class="btn btn-sm btn-success" href="{{ route('informe-notarials.edit', $informeNotarial->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        <button type="button" id="guardarInformeBtn" class="btn btn-primary">Guardar</button>
                                    </form>
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
    document.addEventListener('DOMContentLoaded', function() {

        $('#guardarInformeBtn').on('click', function() {
            // Capturamos los datos del formulario
            const datos = {
                descripcion: $('#descripcion').val(),
                estado: $('#estado').val(),
                _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF
            };

            // Realizamos la petición AJAX
            $.ajax({
                url: "{{ route('informe-notarials.store') }}", // Cambia a tu ruta de almacenamiento
                method: 'POST',
                data: datos,
                success: function(response) {
                    // Cerrar el modal
                    $('#responsive-modal').modal('hide');

                    // Limpiar el formulario
                    $('#crearInformeForm')[0].reset();

                    // Actualizar la tabla con el nuevo dato
                    const nuevoRegistro = `
                    <tr>
                        <td>${response.id}</td>
                        <td>${response.descripcion}</td>
                        <td>${response.estado}</td>
                        <td>${response.fecha_envio}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/informe-notarials/${response.id}">
                                <i class="fa fa-fw fa-eye"></i> Mostrar
                            </a>
                            <a class="btn btn-sm btn-success" href="/informe-notarials/${response.id}/edit">
                                <i class="fa fa-fw fa-edit"></i> Editar
                            </a>
                            <form action="/informe-notarials/${response.id}" method="POST" style="display: inline;">
                                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Estás seguro de eliminar?') ? this.closest('form').submit() : false;">
                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                `;

                    // Agregar el nuevo registro al inicio de la tabla
                    $('#informesTable tbody').prepend(nuevoRegistro);

                    // Mostrar mensaje de éxito (opcional)
                    alert('Informe creado exitosamente');
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Ocurrió un error al guardar el informe');
                }
            });
        });
    });
</script>


<!-- Modal -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <span class="titulo-card">Crear Informe Notarial</span>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripción de Informe:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> Crear</button>
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