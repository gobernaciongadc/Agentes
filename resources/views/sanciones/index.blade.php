@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">

    <div style="display: flex; justify-content: space-between; align-items: center;">

        <span id="card_title" class="text-info font-weight-bold">
            Lista de sanciones
        </span>

        <div class="float-right">
            <a href="{{ route('sanciones.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                <i class="fa fa-plus"></i> Crear Sanción
            </a>
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

    <table id="sancionesTable" class="table table-striped">
        <thead class="thead small">
            <tr>
                <th>ID</th>
                <th style="width: 35%;">Tipo Sanción</th>
                <th>Agente</th>
                <th style="width: 10%;">Monto (UFV)</th>
                <th>Fecha Creada</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sanciones as $sancion)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sancion->nombre }}</td>
                <td>{{ $sancion->agente->persona->nombres }} {{ $sancion->agente->persona->apellidos }}</td>
                <td>{{ $sancion->monto }}</td>
                <td>{{ $sancion->updated_at }}</td>
                <td>
                    @if ($sancion->estado == 'Pendiente')
                    <span class="badge badge-danger">Pendiente de Pago</span>
                    @else
                    <span class="badge badge-success">Pagado</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('sanciones.edit', $sancion->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Editar</a>
                    <form action="{{ route('sanciones.destroy', $sancion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                    </form>
                    <!-- <a href="{{ route('sanciones.pago', $sancion->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Ver Pago</a> -->
                    <a href="{{ route('sanciones-envio.enviarSancion', ['sancion' => $sancion->id, 'idAgente' => $sancion->agente_id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Consolidar Sanción</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection