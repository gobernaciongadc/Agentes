@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h4 class="text-info font-weight-bold">Editar Sanción</h4>
        <a href="{{ route('sanciones.index') }}" class="btn btn-info font-14 float-right" data-placement="left">
            <i class="fa fa-chevron-left"></i> Regresar
        </a>
    </div>

    <form action="{{ route('sanciones.update', $sancion->id) }}" method="POST" class="mt-4 border p-4" style="border-radius: 5px;">
        @csrf
        @method('PUT')

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Campo Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Tipo de la Sanción</label>
            <textarea name="nombre" id="nombre" class="form-control" rows="3" required>{{ old('nombre', $sancion->nombre) }}</textarea>
        </div>


        <!-- Campo Monto -->
        <div class="mb-3">
            <label for="monto" class="form-label">Monto (UFV)</label>
            <input type="text" id="monto" name="monto" class="form-control" min="0" step="0.01" value="{{ old('monto', $sancion->monto) }}" required>
        </div>

        <!-- Agentes de información -->
        <div class="mb-3 d-none">
            <div class="form-group mb-2 mb20">
                <label for="agente_id" class="form-label text-dark">Agente de Información<span class="text-danger">*</span></label>
                <select name="agente_id" class="form-control mb-2 mb20" id="agente_id">
                    <option value="" disabled selected>Selecciona un Agente</option>
                    @foreach($agentes as $agente)
                    <option value="{{ $agente->id }}" {{ old('agente_id', $sancion->agente_id) == $agente->id ? 'selected' : '' }}>
                        {{ $agente->agente->persona->nombres }} {{ $agente->agente->persona->apellidos }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <div class="form-group mb-2 mb20">
                <label for="estado" class="form-label text-dark">Estado Pago<span class="text-danger">*</span></label>
                <select name="estado" class="form-control mb-2 mb20" id="estado">
                    <option value="" disabled selected>Selecciona un Agente</option>
                    @foreach($estadoPago as $estado)
                    <option value="{{ $estado }}" {{ old('estado', $sancion->estado) == $estado ? 'selected' : '' }}>
                        {{ $estado }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Carga de jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- JavaScript -->
        <script>
            $(document).ready(function() {
                // Inicializa Select2 para los selects
                $('#agente_id').select2({
                    placeholder: "Selecciona un Agente",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>


        <!-- Botones -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('sanciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection