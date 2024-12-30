@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row padding-1 p-1">
    <div class="col-12 col-md-8 col-lg-4">
        <!-- Campo Agente -->
        <div class="form-group mb-2 mb20">
            <label for="persona" class="form-label">Agente<span class="text-danger">*</span></label>
            <select name="persona_id" class="form-control @error('persona_id') is-invalid @enderror mb-2 mb20" id="persona"
                @if (Route::currentRouteName()==='agentes.edit' ) disabled @endif>
                <option value="" disabled selected>Selecciona un agente</option>
                @foreach($personas as $persona)
                <option value="{{ $persona->id }}" {{ old('persona_id', $agente?->persona_id) == $persona->id ? 'selected' : '' }}>
                    {{ $persona->nombres }} {{ $persona->apellidos }}
                </option>
                @endforeach
            </select>
            @if (Route::currentRouteName() === 'agentes.edit')
            <!-- Campo oculto para enviar el valor de persona_id si está deshabilitado -->
            <input type="hidden" name="persona_id" value="{{ $agente->persona_id }}">
            @endif
            @error('persona_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Municipio -->
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
            @error('municipio_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Tipo Agente -->
        <div class="form-group mb-2 mb20">
            <label for="tipo_agente" class="form-label">Tipo de Agente<span class="text-danger">*</span></label>
            <select name="tipo_agente" class="form-control @error('tipo_agente') is-invalid @enderror mb-2 mb20" id="tipo_agente">
                <option value="" disabled selected>Selecciona un tipo de agente</option>
                @foreach($tipoAgentes as $tipo)
                <option value="{{ $tipo }}" {{ old('tipo_agente', $agente?->tipo_agente) == $tipo ? 'selected' : '' }}>
                    {{ $tipo }}
                </option>
                @endforeach
            </select>
            @error('tipoAgente')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">Descripción<span class="text-danger">*</span></label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $agente?->descripcion) }}" id="descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Campo Respaldo -->
        <div class="form-group mb-2 mb20">
            <label for="respaldo" class="form-label">Respaldo en PDF<span class="text-danger">*</span></label>
            <label class="custom-file-upload">
                📄 Seleccionar Archivo PDF
                <input type="file" name="respaldo" id="respaldo" accept="application/pdf">
            </label>

            <span id="file-name">Ningún archivo seleccionado</span>

            <!-- Mostrar el archivo actual si existe -->
            @if ($respaldoUrl)
            <div class="mt-2">
                <a href="{{ $respaldoUrl }}" target="_blank"> <i class="fa fa-file-pdf-o"></i> Ver archivo actual</a>
            </div>
            @endif

            @if ($errors->has('respaldo'))
            <div class="text-danger text-sm" style="font-size: 14.4px;">{{ $errors->first('respaldo') }}</div>
            @endif
        </div>

        <!-- Estados -->
        @if ($respaldoUrl)
        <div class="form-group mt-5 mb-2 mb20">
            <label for="estado" class="form-label">Estado<span class="text-danger">*</span></label>
            <select name="estado" class="form-control @error('estado') is-invalid @enderror mb-2 mb20" id="estado">
                <option value="" disabled selected>Selecciona un estado</option>
                @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ old('estado', $agente?->estado) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
                @endforeach
            </select>
            @error('estado')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif
    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Guardar </button>
    </div>
</div>