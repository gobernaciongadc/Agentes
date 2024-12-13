@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row padding-1 p-1 texto-form">

    <div class="col-md-6 form-group mb-2 mb20">
        <label for="titulo" class="form-label">{{ __('Titulo') }}<span class="text-danger">*</span></label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $comunicado?->titulo) }}" id="titulo">
        {!! $errors->first('titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>

    <!-- Campo Tipo Agente -->
    <div class="col-md-6 form-group mb-2 mb20">
        <label for="destinatario" class="form-label">Destinatario<span class="text-danger">*</span></label>
        <select name="destinatario" class="form-control @error('destinatario') is-invalid @enderror mb-2 mb20" id="destinatario">
            <option value="" disabled selected>Selecciona un tipo de agente</option>
            @foreach($tipoAgentes as $tipo)
            <option value="{{ $tipo }}" {{ old('destinatario', $comunicado?->destinatario) == $tipo ? 'selected' : '' }}>
                {{ $tipo }}
            </option>
            @endforeach
        </select>
        @error('tipoAgente')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group mb-2 mb20">
        <label for="asunto" class="form-label">{{ __('Asunto') }}<span class="text-danger">*</span></label>
        <input type="text" name="asunto" class="form-control @error('asunto') is-invalid @enderror" value="{{ old('asunto', $comunicado?->asunto) }}" id="asunto">
        {!! $errors->first('asunto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="adjuntos" class="form-label">Archivo adjunto<span class="text-danger font-10">(Opcional)</span></label><br>
        <label class="custom-file-upload">
            <span>📄 Seleccionar Archivo</span>
            <input type="file" name="adjuntos" id="respaldo-1" onchange="updateFileName(this)">
        </label>
        <br>
        <span id="file-name-1">Ningún archivo seleccionado</span>
        <script>
            function updateFileName(input) {
                const fileNameSpan = document.getElementById('file-name-1');
                fileNameSpan.textContent = input.files.length > 0 ? input.files[0].name : 'Ningún archivo seleccionado';
            }
        </script>
    </div>
    <div class="col-md-8 form-group mb-2 mb20">
        <label for="cuerpo_mensaje" class="form-label">Mensaje<span class="text-danger">*</span></label>
        <textarea name="cuerpo_mensaje"
            class="form-control @error('cuerpo_mensaje') is-invalid @enderror"
            id="cuerpo_mensaje"
            rows="6">{{ old('cuerpo_mensaje', $comunicado?->cuerpo_mensaje) }}</textarea>
        {!! $errors->first('cuerpo_mensaje', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary font-14"> <i class="fa fa-save"></i> Enviar Comunicado</button>
    </div>
</div>