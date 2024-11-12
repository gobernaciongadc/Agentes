<div class="row padding-1 p-1">

    <div class="col-12 col-md-8 col-lg-4">


        <div class="form-group mb-2 mb20">
            <label for="persona" class="form-label">Agente<span class="text-danger">*</span></label>
            <select name="persona_id" class="form-control @error('persona_id') is-invalid @enderror mb-2 mb20" id="persona">
                <option value="" disabled selected>Selecciona un agente</option>
                @foreach($personas as $persona)
                <option value="{{ $persona->id }}" {{ old('persona_id', $agente?->persona_id) == $persona->id ? 'selected' : '' }}>
                    {{ $persona->nombres }} {{ $persona->apellidos }}
                </option>
                @endforeach
            </select>

        </div>

        <!-- Municipio -->
        <div class="form-group mb-2 mb20">
            <label for="municipio" class="form-label">Municipio ó Jurisdicción<span class="text-danger">*</span></label>
            <select name="municipio_id" class="form-control @error('municipio_id') is-invalid @enderror mb-2 mb20" id="municipio">
                <option value="" disabled selected>Selecciona un municipio</option>
                @foreach($municipios as $municipio)
                <option value="{{ $municipio->id }}" {{ old('municipio_id', $agente?->municipio_id) == $municipio->id ? 'selected' : '' }}>
                    {{ $municipio->nombre }}
                </option>
                @endforeach
            </select>

        </div>

        <!-- Tipo Agente -->
        <div class="form-group mb-2 mb20">

            <label for="tipoAgente" class="form-label">Tipo de Agente<span class="text-danger">*</span></label>
            <select name="tipoAgente" class="form-control @error('tipoAgente') is-invalid @enderror mb-2 mb20" id="tipoAgente">
                <option value="" disabled selected>Selecciona un tipo de agente</option>
                @foreach($tipoAgentes as $tipo)
                <option value="{{ $tipo }}" {{ old('tipoAgente', $agente?->tipoAgente) == $tipo ? 'selected' : '' }}>
                    {{ $tipo }}
                </option>
                @endforeach
            </select>

        </div>

        <!-- Respaldo -->
        <div class="form-group mb-2 mb20">
            <label for="respaldo" class="form-label">Respaldo en PDF<span class="text-danger">*</span></label>

            <!-- Botón personalizado para subir archivo -->
            <label class="custom-file-upload">
                📄 Seleccionar Archivo PDF
                <input type="file" name="respaldo" id="respaldo" accept="application/pdf">
            </label>

            <!-- Nombre del archivo seleccionado -->
            <span id="file-name">Ningún archivo seleccionado</span>

            <!-- Mensaje de error -->
            {!! $errors->first('respaldo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Guardar </button>
    </div>

</div>