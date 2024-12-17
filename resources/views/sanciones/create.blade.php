@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Crear Sanción</h1>
    <form action="{{ route('sanciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Sanción</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="tipo_sancion_id" class="form-label">Tipo de Sanción</label>
            <select class="form-select" id="tipo_sancion_id" name="tipo_sancion_id" required>
                @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto (Bs)</label>
            <input type="number" class="form-control" id="monto" name="monto" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('sanciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection