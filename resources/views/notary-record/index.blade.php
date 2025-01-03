@extends('admin.layouts.master')

@section('template_title')
Notarios de fe publica
@endsection

@section('content')


<div class="row">
    <div class="col-sm-12">

        <div style="width: 45%;">
            <span class="font-weight-bold">INFORME NOTARIO DE FÉ PUBLICA</span> <br> {{ $informe->descripcion }}
        </div>

        <br>

        <div class="d-flex justify-content-between">
            <a href="{{ route('informe-notarials.index') }}" class="btn btn-danger font-14" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Información Notarios
            </a>

            @if($informe->estado != 'Rechazado')
            <a href="{{ route('notary-records.create', ['idInforme'=>$id]) }}" class="btn btn-primary font-14" data-placement="left">
                <i class="fa fa-plus"></i> Crear Nuevo Registro
            </a>
            @endif

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


        <div class="table-responsive">
            <table id="notarialesTable" class="table table-striped table-hover">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>ID</th>
                        <th>Municipio</th>
                        <th>Número Notaria</th>
                        <th>Nombre Notaria(o)</th>
                        <th>Número Escritura</th>
                        <th>Fecha Escritura</th>
                        <th>Naturaleza Escritura</th>
                        <th>Nombre Cedente</th>
                        <th>Ci Nit Cedente</th>
                        <th>Nombre Beneficiario</th>
                        <th>Ci Nit Beneficiario</th>
                        <th>Tipo Bien</th>
                        <th>Registro Bien</th>
                        <th>Tipo Formulario</th>
                        <th>Número Orden</th>
                        <th>Monto Pagado</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($notaryRecords as $notaryRecord)
                    <tr>
                        <td>{{ $notaryRecord->id }}</td>
                        <td>{{ $notaryRecord->municipio }}</td>
                        <td>{{ $notaryRecord->numero_notaria }}</td>
                        <td>{{ $notaryRecord->nombre_notaria }}</td>
                        <td>{{ $notaryRecord->numero_escritura }}</td>
                        <td>{{ $notaryRecord->fecha_escritura }}</td>
                        <td>{{ $notaryRecord->naturaleza_escritura }}</td>
                        <td>{{ $notaryRecord->nombre_cedente }}</td>
                        <td>{{ $notaryRecord->ci_nit_cedente }}</td>
                        <td>{{ $notaryRecord->nombre_beneficiario }}</td>
                        <td>{{ $notaryRecord->ci_nit_beneficiario }}</td>
                        <td>{{ $notaryRecord->tipo_bien }}</td>
                        <td>{{ $notaryRecord->registro_bien }}</td>
                        <td>{{ $notaryRecord->tipo_formulario }}</td>
                        <td>{{ $notaryRecord->numero_orden }}</td>
                        <td>{{ $notaryRecord->monto_pagado }}</td>
                        <td>{{ $notaryRecord->observaciones }}</td>

                        <td>
                            <form action="{{ route('notary-records.destroy', ['id' => $notaryRecord->id, 'idInforme' => $informe->id]) }}" method="POST">
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('notary-records.show', ['id' => $notaryRecord->id, 'idInforme' => $informe->id]) }}"
                                    title="Ver Datos">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-success" href="{{ route('notary-records.edit', ['id' => $notaryRecord->id, 'idInforme' => $informe->id]) }}" title="Modificar Datos"><i class="fa fa-fw fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                @if($informe->estado != 'Rechazado')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" title="Eliminar datos">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    <!-- Sweetalert -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const deleteButtons = document.querySelectorAll('.delete-btn');

                            deleteButtons.forEach(button => {
                                button.addEventListener('click', function(event) {
                                    event.preventDefault(); // Prevenir envío directo del formulario
                                    const form = this.closest('form'); // Buscar el formulario más cercano al botón

                                    // Verificar si se encontró el formulario
                                    if (!form) {
                                        console.error('Formulario no encontrado para el botón:', this);
                                        return;
                                    }

                                    swal({
                                        title: "¿Estas seguro?",
                                        text: "No podras revertir esta acción!",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#0984e3",
                                        confirmButtonText: "Si, eliminar esto!",
                                        closeOnConfirm: false
                                    }, function() {
                                        // swal("Eliminado!", "El registro ha sido eliminado.", "Agentes de información");
                                        form.submit(); // Enviar formulario si se confirma
                                    });





                                });
                            });
                        });
                    </script>
                </tbody>
            </table>
        </div>
    </div>
</div>


@vite('resources/css/notarial.css')
@vite('resources/js/notarial.js')
@endsection