@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <span class="text-info font-weight-bold">Plantilla de Sanciones</span>
    </div>

    <!-- Formulario para todo -->
    <form action="{{ route('sanciones.store') }}" method="POST" class="mt-4 border p-4" style="border-radius: 5px;" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <label for="tipo-sancion" class="form-label text">Tipo Agente<span class="text-danger">*</span></label>
        <p>{{ $tipo }}</p>

        <label for="dias-retrazo" class="form-label text">Dias con retraso<span class="text-danger">*</span></label>
        <p class="text-danger">{{ $dataSancion['dias'] }}</p>

        <!-- Titulo Informe -->
        <div class="mb-3">
            <label for="informe" class="form-label">Informe</label>
            <input type="text" class="form-control" id="informe" name="informe" value="{{ $dataSancion['tituloInforme'] }}" required readonly>
        </div>

        <!-- Nombre de la sanción -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Tipo de la Sanción</label>
            <textarea name="nombre" class="form-control" id="nombre" readonly>{{ $dataSancion['descripcion'] }}</textarea>
        </div>

        <!-- Monto de la sanción -->
        <div class="mb-3">
            <label for="monto" class="form-label">Monto (UFV)</label>
            <input type="text" class="form-control" id="monto" name="monto" value="{{ $dataSancion['monto'] }}" required readonly>
        </div>

        <!-- Id Agente de información -->
        <input type="hidden" name="agente_id" id="agente_id" value="{{ $dataSancion['idUsuarioAgente'] }}">
        <input type="hidden" name="informe_id" id="informe_id" value="{{ $dataSancion['idInforme'] }}">

        <!-- Nombre del agente -->
        <div class="mb-3">
            <label for="agenteName" class="form-label">Agente</label>
            <input type="text" class="form-control" id="agenteName" name="agenteName" value="{{ $dataSancion['nameAgenteInforme'] }}" required readonly>
        </div>

        <!-- Cite auto inicial -->
        <div class="mb-3">
            <label for="cite_auto_inicial" class="form-label">Cite Auto Inicial<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cite_auto_inicial" name="cite_auto_inicial" required>
        </div>

        <!-- Archivo Auto Inicial -->
        <div class="form-group mb-2 mb20">
            <label for="archivo_auto_inicial" class="form-label">Archivo Auto Inicial<span class="text-danger">*</span></label>
            <div class="custom-file-container">
                <label class="custom-file-label">
                    📄 Seleccionar Archivo PDF
                    <input type="file" name="archivo_auto_inicial" id="archivo_auto_inicial" accept="application/pdf">
                </label>
                <span id="name-file">Ningún archivo seleccionado</span>
            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>
@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection