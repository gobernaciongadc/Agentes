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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-3">

            <label for="tipo-sancion" class="form-label text">Elegir Tipo de Sanción<span class="text-danger">*</span></label>

            <table class="table">
                <thead class="thead bg-faded border">
                    <tr>
                        <th style="width: 20%;">SELECCIONAR</th>
                        <th style="width: 50%;">DESCRIPCIÓN</th>
                        <th>SANCIÓN POR INCUMPLIMIENTO AL DEBER FORMAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" id="basic_checkbox_1" class="filled-in">
                            <label for="basic_checkbox_1"></label>
                        </td>
                        <td id="sancion-1">No presentar información veraz en la forma, lugares y plazos establecidos en la normativa específica, para los agentes de información</td>
                        <td>
                            <div class="demo-radio-button">
                                <input name="group1" type="radio" id="radio_1_1" disabled>
                                <label for="radio_1_1">1.500,00 UFV</label>
                                <input name="group1" type="radio" id="radio_2_1" disabled>
                                <label for="radio_2_1">3.000,00 UFV</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="basic_checkbox_2" class="filled-in">
                            <label for="basic_checkbox_2"></label>
                        </td>
                        <td id="sancion-2">Presentación de información fuera del plazo establecido, hasta treinta (30) días de vencido el mismo, hasta antes de ser notificados con el acto administrativo de inicio del Sumario Contravencional </td>
                        <td>
                            <div class="demo-radio-button">
                                <input name="group2" type="radio" id="radio_1_2" disabled>
                                <label for="radio_1_2">150,00 UFV</label>
                                <input name="group2" type="radio" id="radio_2_2" disabled>
                                <label for="radio_2_2">300,00 UFV</label>
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <input type="checkbox" id="basic_checkbox_3" class="filled-in">
                            <label for="basic_checkbox_3"></label>
                        </td>

                        <td id="sancion-3">Presentación de la infomación fuera de plazo establecido, en los puntos 3.1 y 3.2, hasta antes de ser notificados con el acto administrativo de inicio del Sumario Contravencional</td>
                        <td>
                            <div class="demo-radio-button">
                                <input name="group3" type="radio" id="radio_1_3" disabled>
                                <label for="radio_1_3">750,00 UFV</label>
                                <input name="group3" type="radio" id="radio_2_3" disabled>
                                <label for="radio_2_3">1.500,00 UFV</label>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Obtener todos los checkboxes
                const checkboxes = document.querySelectorAll("input[type='checkbox']");

                // Obtener los elementos de nombre y monto
                const nombre = document.getElementById('nombre');
                const monto = document.getElementById('monto');

                // Obtener los elementos de tipos de sanción
                const sancion_1 = document.getElementById('sancion-1').innerText;
                const sancion_2 = document.getElementById('sancion-2').innerText;
                const sancion_3 = document.getElementById('sancion-3').innerText;

                // Seleccionar todos los botones de radio
                const radioButtons = document.querySelectorAll("input[type='radio']");

                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener("change", () => {
                        // Verificar si el checkbox actual está marcado
                        if (checkbox.checked) {
                            // Obtener el id del checkbox seleccionado
                            const checkboxId = checkbox.id;

                            switch (checkboxId) {
                                case "basic_checkbox_1":
                                    nombre.value = sancion_1;
                                    break;
                                case "basic_checkbox_2":
                                    nombre.value = sancion_2;
                                    break;
                                case "basic_checkbox_3":
                                    nombre.value = sancion_3;
                                    break;
                            }

                            // Deshabilitar todos los checkboxes y radios
                            checkboxes.forEach((cb) => {
                                if (cb !== checkbox) {
                                    cb.checked = false;
                                    cb.disabled = true;
                                    toggleRadioButtons(cb, false);
                                }
                            });
                            // Habilitar los radios correspondientes al checkbox actual
                            toggleRadioButtons(checkbox, true);
                        } else {
                            // Limpiar los campos de nombre y monto
                            nombre.value = '';
                            monto.value = '';

                            // Si se desmarca, reactivar todos los checkboxes y deshabilitar radios
                            checkboxes.forEach((cb) => {
                                cb.disabled = false;
                            });
                            toggleRadioButtons(checkbox, false);
                        }
                    });
                });

                // Evento para los radio buttons
                radioButtons.forEach((radio) => {
                    radio.addEventListener("change", () => {
                        if (radio.checked) {
                            // Actualizar el campo monto con el valor del label correspondiente
                            const label = document.querySelector(`label[for="${radio.id}"]`);

                            if (label) {
                                console.log(label.innerText.trim());
                                monto.value = label.innerText.trim(); // Extraer el texto del label
                            }
                        }
                    });
                });

                function toggleRadioButtons(checkbox, enable) {
                    // Obtener el grupo de radios asociados al checkbox
                    const row = checkbox.closest("tr");
                    if (row) {
                        const radios = row.querySelectorAll("input[type='radio']");
                        radios.forEach((radio) => {
                            radio.disabled = !enable;
                            if (!enable) {
                                radio.checked = false; // Limpiar selección al deshabilitar
                            }
                        });
                    }
                }
            });
        </script>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Sanción</label>
            <textarea name="nombre" class="form-control" id="nombre" readonly></textarea>
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto (UFV)</label>
            <input type="text" class="form-control" id="monto" name="monto" required readonly>
        </div>

        <div class="mb-3">
            <div class="form-group mb-2 mb20">
                <label for="agente_id" class="form-label text-dark">Agente de Información<span class="text-danger">*</span></label>
                <select name="agente_id" class="form-control mb-2 mb20" id="agente_id">
                    <option value="" disabled selected>Selecciona un Agente</option>
                    @foreach($agentes as $agente)
                    <option value="{{ $agente->id }}">
                        {{ $agente->agente->persona->nombres }} {{ $agente->agente->persona->apellidos }}
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

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('sanciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection