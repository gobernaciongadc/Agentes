@extends('admin.layouts.master')

@section('content')
<div class="container">

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
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Monto (Bs)</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sanciones as $sancion)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sancion->nombre }}</td>
                <td>{{ $sancion->tipoSancion->nombre }}</td>
                <td>{{ number_format($sancion->monto, 2) }}</td>
                <td>{{ $sancion->estado ? 'Pagado' : 'Pendiente' }}</td>
                <td>
                    <a href="{{ route('sanciones.edit', $sancion->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('sanciones.destroy', $sancion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                    <a href="{{ route('sanciones.pago', $sancion->id) }}" class="btn btn-sm btn-info">Ver Pago</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection