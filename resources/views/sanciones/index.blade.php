@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-3">Gestión de Sanciones</h1>
    <a href="{{ route('sanciones.create') }}" class="btn btn-primary mb-3">Nueva Sanción</a>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
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
@endsection