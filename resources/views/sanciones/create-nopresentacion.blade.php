@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="mb-3" style="display: flex; justify-content: space-between; align-items: center;">
        <span class="text-info font-weight-bold">Plantilla de Sanciones</span>
    </div>

    <label for="agente">Seleccionar un agente<span class="text-danger">*</span></label>
    <div class="form-group">
        <select class="listAgentes" name="agente" id="agente" style="width: 100%;">
            <option value="" disabled selected>Seleccione un agente</option>
            @foreach ($userAgentes as $userAgente)
            <option value="{{ $userAgente->id }}">
                {{ $userAgente->agente->persona->nombres }} {{ $userAgente->agente->persona->apellidos }} - {{ $userAgente->agente->tipo_agente }}
            </option>
            @endforeach
        </select>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Campos para la sancion
            const tipoSancion = document.querySelector('#tipo-sancion');
            const monto = document.querySelector('#monto');
            const agenteId = document.querySelector('#agente_id');
            const informeId = document.querySelector('#informe_id');
            const nameAgente = document.querySelector('#agenteName');



            // Inicializar Select2
            $('#agente').select2();

            // Manejar el evento 'select2:select'
            $('#agente').on('select2:select', function(e) {
                // Obtener el texto de la opción seleccionada
                const selectedOptionText = e.params.data.text;

                // Obtener el valor (id) de la opción seleccionada
                const selectedOptionValue = e.params.data.id;

                // Dividir el texto en antes y después del guion
                const parts = selectedOptionText.split('-');

                // Obtener lo que está antes y después del guion
                const textBeforeDash = parts[0]?.trim(); // Antes del guion
                const textAfterDash = parts[1]?.trim(); // Después del guion

                // Mostrar en la consola
                // console.log('Antes del guion:', textBeforeDash);
                // console.log('Después del guion:', textAfterDash);

                if (textAfterDash === 'SEPREC') {
                    monto.value = '3000,00 UFV';
                } else {
                    monto.value = '1500,00 UFV';
                }

                tipoSancion.textContent = textAfterDash;
                nameAgente.value = textBeforeDash;
                agenteId.value = selectedOptionValue;
                informeId.value = null;

            });
        });
    </script>


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
        <p id="tipo-sancion">-</p>

        <label for="dias-retrazo" class="form-label text">Dias con retraso<span class="text-danger">*</span></label>
        <p class="text-danger">Sin Presentación de Informe</p>

        <!-- Titulo Informe -->
        <div class="mb-3 mt-4">
            <label for="informe" class="form-label">Periodo de Informe<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="informe" name="informe" value="" required>
        </div>

        <!-- Nombre de la sanción -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Tipo de la Sanción</label>
            <textarea name="nombre" class="form-control" id="nombre" readonly>{{ $dataSancion['descripcion'] }}</textarea>
        </div>

        <!-- Monto de la sanción -->
        <div class="mb-3">
            <label for="monto" class="form-label">Monto (UFV)</label>
            <input type="text" class="form-control" id="monto" name="monto" value="" required readonly>
        </div>

        <!-- Id Agente de información -->
        <input type="hidden" name="agente_id" id="agente_id" value="1">
        <input type="hidden" name="informe_id" id="informe_id" value="2">

        <!-- Nombre del agente -->
        <div class="mb-3">
            <label for="agenteName" class="form-label">Agente</label>
            <input type="text" class="form-control" id="agenteName" name="agenteName" value="" required readonly>
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