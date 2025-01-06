@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">

    <div style="display: flex; justify-content: space-between; align-items: center;">

        <span id="card_title" class="text-info font-weight-bold">
            Lista de sanciones
        </span>

        @php
        $user = Auth::user();
        @endphp

        @if ($user->rol == 'Administrador')
        <div class="float-right">
            <a href="{{ route('sanciones-crear-nopresentacion.createSancionNoPresentacion') }}" class="btn btn-info font-14 float-right" data-placement="left">
                <i class="fa fa-plus"></i> Crear sanción por no envio de informe
            </a>
        </div>
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
        <table id="sancionesTable" class="table table-striped">
            <thead class="thead small">
                <tr>
                    <th>ID</th>
                    <th style="width: 28%;">Tipo Sanción</th>
                    <th>Agente</th>
                    <th style="width: 10%;">Monto (UFV)</th>
                    <th>Fecha Creada</th>
                    <th>Estado Pago</th>

                    @if ($tipoAgente == 'Administrador')
                    <th>Estado Envio</th>
                    @endif

                    @if ($tipoAgente == 'Agente')
                    <th>Estado Revisión</th>
                    @endif

                    <th>Cite Auto Inicial</th>
                    <th>Archivo Auto Inicial</th>
                    <th>Acciones</th>


                </tr>
            </thead>
            <?php

            use App\Models\User;
            ?>
            <tbody>
                @foreach ($sanciones as $sancion)
                <tr>
                    <td>{{ $sancion->id }}</td>
                    <td>{{ $sancion->nombre }}</td>
                    <td>
                        @php
                        $usuario = User::with('agente.persona')->where('id', $sancion->agente_id)->first();
                        echo $usuario->agente->persona->nombres . ' ' . $usuario->agente->persona->apellidos;
                        @endphp
                    </td>
                    <td>{{ $sancion->monto }}</td>
                    <td>{{ $sancion->updated_at }}</td>
                    <td>
                        @if ($sancion->estado == 'Pendiente')
                        <span class="badge badge-danger">Pendiente de Pago</span>
                        @else
                        <span class="badge badge-primary">Pagado</span>
                        @endif
                    </td>

                    @if ($tipoAgente == 'Administrador')
                    <td>
                        @if ($sancion->estado_envio == 'No enviado')
                        <span class="badge badge-warning">No Enviado</span>
                        @else
                        <span class="badge badge-success">Enviado</span>
                        @endif
                    </td>
                    @endif

                    @if ($tipoAgente == 'Agente')
                    <td>
                        @if ($sancion->estado_vista == 'No revizado')
                        <span class="badge badge-danger">No Revizado</span>
                        @else
                        <span class="badge badge-primary">Revizado</span>
                        @endif
                    </td>
                    @endif


                    <td>{{ $sancion->cite_auto_inicial }}</td>
                    <td>
                        <a href="{{ asset('storage/sanciones/' . basename($sancion->archivo_auto_inicial)) }}" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Ver PDF
                        </a>
                    </td>
                    <td>
                        @if ($tipoAgente == 'Administrador')
                        @if ($sancion->estado_envio == 'No enviado')
                        <!-- <a href="{{ route('sanciones.edit', $sancion->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Editar</a> -->
                        <form action="{{ route('sanciones.destroy', $sancion->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                        </form>
                        <!-- <a href="{{ route('sanciones.pago', $sancion->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Ver Pago</a> -->


                        <a href="{{ route('sanciones-envio.enviarSancion', ['sancion' => $sancion->id, 'idAgente' => $sancion->agente_id]) }}"
                            id="consolidar-sancion-{{ $sancion->id }}"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-check"></i> Enviar Sanción
                        </a>
                        @else

                        @if ($sancion->envio_pago == 'Enviado' && $sancion->estado == 'Pendiente')
                        <!-- Ver archivo -->
                        <a href="{{ route('sanciones.edit', $sancion->id) }}" class="btn btn-sm btn-primary font-14"><i class="fa fa-check"></i> Confirmar Pago</a>
                        <a href="{{ asset('storage/uploads/comprobantes/' . $sancion->documento_pago) }}" target="_blank" class="btn btn-sm btn-info font-14 ">
                            <i class="fa fa-file"></i> Ver Comprobante
                        </a>
                        @else
                        <a href="{{ asset('storage/uploads/comprobantes/' . $sancion->documento_pago) }}"
                            target="_blank"
                            class="btn btn-sm btn-info font-14 verificar-archivo"
                            data-archivo="{{ asset('storage/uploads/comprobantes/' . $sancion->documento_pago) }}">
                            <i class="fa fa-file"></i> Ver A-03
                        </a>
                        <script>
                            if (!window.toastrInitialized) {
                                window.toastrInitialized = true;

                                document.addEventListener('DOMContentLoaded', () => {
                                    document.body.addEventListener('click', async (event) => {
                                        const link = event.target.closest('.verificar-archivo'); // Verifica si el click fue en un enlace válido
                                        if (link) {
                                            event.preventDefault();

                                            const archivo = link.getAttribute('data-archivo');

                                            try {
                                                const response = await fetch(archivo, {
                                                    method: 'HEAD'
                                                });

                                                if (response.ok) {
                                                    window.open(archivo, '_blank');
                                                } else {
                                                    toastr.error('Todavia no envio el formulario A-03', 'Agentes de Informacíon');
                                                }
                                            } catch (error) {
                                                alert('Hubo un problema al verificar el archivo. Intente más tarde.');
                                                console.error(error);
                                            }
                                        }
                                    });
                                });
                            }
                        </script>
                        @endif


                        @endif

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Selecciona todos los enlaces con la clase consolidar-sancion
                                document.querySelectorAll('[id^="consolidar-sancion-"]').forEach(function(link) {
                                    link.addEventListener('click', function(event) {
                                        event.preventDefault(); // Previene la redirección inmediata

                                        const url = this.getAttribute('href'); // Obtiene la URL del enlace

                                        swal({
                                            title: '¿Estás seguro?',
                                            text: "Esta acción creara y enviara la sanción. No podrás revertirla.",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#0984e3",
                                            confirmButtonText: "Si, Enviar!",
                                            cancelButtonText: "No, cancelar",
                                            closeOnConfirm: false,
                                            closeOnCancel: false
                                        }, function(isConfirm) {
                                            if (isConfirm) {
                                                swal("Enviado", "La sanción ha sido enviada.", "success");
                                                // Redirige a la URL si se confirma
                                                window.location.href = url;
                                            } else {
                                                swal("Cancelado", "El envio ha sido cancelado :)", "error");
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
                        @endif
                        <!-- Cuando es agente -->
                        @if ($tipoAgente == 'Agente')

                        <a class="btn btn-sm btn-primary " href="{{ route('sanciones.show',$sancion->id) }}"><i class="fa fa-fw fa-eye"></i> Ver Sanción</a>

                        @if ($sancion->envio_pago == 'Enviado')
                        <span class="badge badge-success small">Comprobante de Pago Enviado</span>
                        @else
                        <button type="button" class="btn btn-sm btn-danger" onclick='openModal("{{$sancion->id}}")'><i class="fa fa-upload"></i> Subir formulario A-03</button>
                        @endif
                        @endif



                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- Modal Mostrar certificado -->
<div class="row">
    <div class="col-md-4">
        <!-- Modal para subir comprobante -->
        <div id="subir-pago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <span class="titulo-card">Subir formulario A-03</span>
                        <button type="button" class="close" onclick="closeModal()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="form-comprobante" action="{{ route('envio-comprobante.comprobantePago') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="idSancion">
                            <div class="form-group">
                                <div class="col-md-8 form-group mb-3">
                                    <label for="documento_pago" class="form-label">
                                        Adjuntar formulario A-03
                                        <span class="text-danger font-10">(El archivo PDF o Imagen debe ser Legible)</span>
                                    </label>
                                    <br>
                                    <label class="custom-file-upload">
                                        <span>📄 Seleccionar Archivo</span>
                                        <input type="file" name="documento_pago" id="documento_pago" onchange="updateFileName(this)">
                                    </label>
                                    <br>
                                    <span id="file-name-1">Ningún archivo seleccionado</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger font-14" onclick="closeModal()">Cerrar</button>
                                <button type="submit" class="btn btn-info font-14">Enviar Comprobante</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileNameSpan = document.getElementById('file-name-1');
        fileNameSpan.textContent = input.files.length > 0 ? input.files[0].name : 'Ningún archivo seleccionado';
    }

    function openModal(id) {
        document.getElementById('idSancion').value = id; // Asignar el ID al campo oculto
        $('#subir-pago').modal('show');
    }

    function closeModal() {
        $('#subir-pago').modal('hide');
    }
</script>

<!-- Fin Modal -->

@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection