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
            <a href="{{ route('sanciones.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                <i class="fa fa-plus"></i> Crear Sanción
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



                <td>
                    @if ($tipoAgente == 'Administrador')
                    @if ($sancion->estado_envio == 'No enviado')
                    <a href="{{ route('sanciones.edit', $sancion->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Editar</a>
                    <form action="{{ route('sanciones.destroy', $sancion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                    </form>
                    <!-- <a href="{{ route('sanciones.pago', $sancion->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Ver Pago</a> -->


                    <a href="{{ route('sanciones-envio.enviarSancion', ['sancion' => $sancion->id, 'idAgente' => $sancion->agente_id]) }}"
                        id="consolidar-sancion-{{ $sancion->id }}"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-check"></i> Consolidar Sanción
                    </a>
                    @else
                    <a href="{{ route('sanciones.edit', $sancion->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Editar</a>
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
                                        text: "Esta acción consolidará la sanción. No podrás revertirla.",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#0984e3",
                                        confirmButtonText: "Si, Enviar!",
                                        cancelButtonText: "No, cancelar",
                                        closeOnConfirm: false,
                                        closeOnCancel: false
                                    }, function(isConfirm) {
                                        if (isConfirm) {
                                            swal("Enviado", "La sanción ha sido consolidada.", "success");
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

                    @if ($tipoAgente == 'Agente')
                    <a class="btn btn-sm btn-primary " href="{{ route('sanciones.show',$sancion->id) }}"><i class="fa fa-fw fa-eye"></i> Ver Sanción</a>
                    @endif



                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection