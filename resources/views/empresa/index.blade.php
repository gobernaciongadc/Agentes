@extends('admin.layouts.master')

@section('template_title')
Empresas
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <div class="border" style="width: 45%; border-radius: 8px; padding: 10px;">
            <span class="font-weight-bold">INFORME SEPREC</span> <br> {{ $informe->descripcion }}
        </div>




        <br>
        <div class="d-flex justify-content-between">
            <a href="{{ route('informe-index-seprec.indexSeprec') }}" class="btn btn-danger font-14" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Información de SEPREC
            </a>
            <a href="{{ route('empresas.create',['idInforme'=>$id]) }}" class="btn btn-primary font-14" data-placement="left">
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
            <table class="table table-striped table-hover" id="empresasTable">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>ID</th>

                        <th>Nombre Representante SEPREC</th>
                        <th>Nombre Razón Social</th>
                        <th>Número Matricula Comercio</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Actividad</th>
                        <th>Nombre Representante Legal</th>
                        <th>Número Cedula Identidad</th>
                        <th>Base Empresarial Empresas Activas</th>
                        <th>Transferencia Cuotas Capital</th>
                        <th>Transferencia Empresa Unipersonal</th>
                        <!-- <th>Informe Id</th>
                        <th>Usuario Id</th> -->

                        <th style="width: 10%;">Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->id }}</td>

                        <td>{{ $empresa->nombre_representante_seprec }}</td>
                        <td>{{ $empresa->nombre_razon_social }}</td>
                        <td>{{ $empresa->numero_matricula_comercio }}</td>
                        <td>{{ $empresa->direccion }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->actividad }}</td>
                        <td>{{ $empresa->nombre_representante_legal }}</td>
                        <td>{{ $empresa->numero_cedula_identidad }}</td>

                        <!-- Archivos PDF-->
                        <td>

                            @php
                            $rutaArchivo = 'uploads/empresas/' . basename($empresa->base_empresarial_empresas_activas);
                            @endphp

                            @if ($empresa->base_empresarial_empresas_activas && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Ver PDF
                            </a>
                            @else
                            <span>Sin Archivo</span>
                            @endif

                        </td>
                        <td>

                            @php
                            $rutaArchivo_2 = 'uploads/empresas/' . basename($empresa->transferencia_cuotas_capital);
                            @endphp

                            @if ($empresa->transferencia_cuotas_capital && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo_2) }}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Ver PDF
                            </a>
                            @else
                            <span>Sin Archivo</span>
                            @endif


                        </td>
                        <td>

                            @php
                            $rutaArchivo_3 = 'uploads/empresas/' . basename($empresa->transferencia_empresa_unipersonal);
                            @endphp

                            @if ($empresa->transferencia_empresa_unipersonal && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo_3) }}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Ver PDF
                            </a>
                            @else
                            <span>Sin Archivo</span>
                            @endif

                        </td>

                        <td>
                            <form action="{{ route('empresas.destroy', ['id' => $empresa->id, 'idInforme' => $informe->id]) }}" method="POST">
                                <a class="btn btn-sm btn-primary " href="{{ route('empresas.show', ['id' => $empresa->id, 'idInforme' => $informe->id]) }}"><i class="fa fa-fw fa-eye"></i></a>
                                <a class="btn btn-sm btn-success" href="{{ route('empresas.edit', ['id' => $empresa->id, 'idInforme' => $informe->id]) }}"><i class="fa fa-fw fa-edit"></i></a>
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

@vite('resources/css/empresa.css')
@vite('resources/js/empresa.js')
@endsection