@extends('admin.layouts.master')

@section('template_title')
Sentencias Judiciales
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <div style="width: 45%;">
            <span class="font-weight-bold">INFORME DE JUEZES O SECRETARIOS</span> <br> {{ $informe->descripcion }}
        </div>
        <br>

        <div class="d-flex justify-content-between">
            <a href="{{ route('informe-index-juzgado.indexJuzgado') }}" class="btn btn-danger font-14" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Información de Jueces o Secretarios
            </a>
            <a href="{{ route('sentencias-judiciales.create',['idInforme'=>$id]) }}" class="btn btn-info font-14" data-placement="left">
                <i class="fa fa-plus"></i> Crear Nuevo Registro
            </a>
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
            <table id="sentenciasJudicialesTable" class="table table-striped table-hover">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Secretario</th>
                        <th>Número Juzgado</th>
                        <th>Municipio Jurisdicción</th>
                        <th>Naturaleza Proceso</th>
                        <th>Número Resolución</th>
                        <th>Fecha Resolución</th>
                        <th>Nombre Demandante</th>
                        <th>Cédula Demandante</th>
                        <th>Nombre Demandado</th>
                        <th>Cédula Demandado</th>

                        <th style="width: 10%;">Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($sentenciasJudiciales as $sentenciasJudiciale)
                    <tr>
                        <td>{{ $sentenciasJudiciale->id }}</td>

                        <td>{{ $sentenciasJudiciale->nombre_secretario }}</td>
                        <td>{{ $sentenciasJudiciale->numero_juzgado }}</td>
                        <td>{{ $sentenciasJudiciale->municipio_jurisdiccion }}</td>
                        <td>{{ $sentenciasJudiciale->naturaleza_proceso }}</td>
                        <td>{{ $sentenciasJudiciale->numero_resolucion }}</td>
                        <td>{{ $sentenciasJudiciale->fecha_resolucion }}</td>
                        <td>{{ $sentenciasJudiciale->nombre_demandante }}</td>
                        <td>{{ $sentenciasJudiciale->cedula_demandante }}</td>
                        <td>{{ $sentenciasJudiciale->nombre_demandado }}</td>
                        <td>{{ $sentenciasJudiciale->cedula_demandado }}</td>

                        <td>
                            <form action="{{ route('sentencias-judiciales.destroy', ['id' => $sentenciasJudiciale->id, 'idInforme' => $informe->id]) }}" method="POST">
                                <a class="btn btn-sm btn-primary " href="{{ route('sentencias-judiciales.show', ['id' => $sentenciasJudiciale->id, 'idInforme' => $informe->id]) }}" title="Ver datos"><i class="fa fa-fw fa-eye"></i></a>
                                <a class="btn btn-sm btn-success" href="{{ route('sentencias-judiciales.edit', ['id' => $sentenciasJudiciale->id, 'idInforme' => $informe->id]) }}" title="Modificar datos"><i class="fa fa-fw fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" title="Eliminar datos">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
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
@vite('resources/css/juzgado.css')
@vite('resources/js/juzgado.js')
@endsection