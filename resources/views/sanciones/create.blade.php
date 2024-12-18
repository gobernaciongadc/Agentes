@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <span class="text-info font-weight-bold">Plantilla de Sanciones</span>
        <div class="float-right">
            <a href="{{ route('sanciones.index') }}" class="btn btn-info font-14 float-right" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar
            </a>
        </div>
    </div>
    <form action="{{ route('sanciones.store') }}" method="POST" class="mt-4 border p-4" style="border-radius: 5px;">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Sanción</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="tipo_sancion_id" class="form-label">Tipo de Sanción</label>
            <select class="form-control mb-2 mb20" id="tipo_sancion_id" name="tipo_sancion_id" required>
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
@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection