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

    <div class="col-md-6" class="form-group">
        <label for="asunto" class="form-label">{{ __('Asunto') }}</label>
        <input type="text" name="asunto" class="form-control @error('asunto') is-invalid @enderror" value="{{ old('asunto', $notificacione?->asunto) }}" id="asunto" placeholder="Asunto">
        {!! $errors->first('asunto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>


    <div class="col-md-6 form-group">
        <label for="destinatario" class="form-label">Destinatario<span class="text-danger">*</span></label>
        <select name="destinatario" class="form-control @error('destinatario') is-invalid @enderror mb-2 mb20 notificacion-select" id="destinatario">
            <option value="" disabled selected>Selecciona un Agente</option>
            @foreach($usuarios as $usuario)
            <option value='@json(["idUsuario" => $usuario->id, "nombre_agente" => $usuario->agente->persona->nombres . " " . $usuario->agente->persona->apellidos])' {{ old('destinatario', $notificacione?->destinatario) == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->agente->persona->nombres }} {{ $usuario->agente->persona->apellidos }}
            </option>
            @endforeach
        </select>
        @error('tipoAgente')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-6" class="form-group">
        <label for="mensaje" class="form-label">{{ __('Mensaje') }}</label>
        <textarea name="mensaje"
            class="form-control @error('mensaje') is-invalid @enderror"
            id="cuerpo_mensaje"
            rows="6">{{ old('mensaje', $notificacione?->mensaje) }}</textarea>
        {!! $errors->first('mensaje', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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



</div>
<div class="row mt-2">
    <div class="col-12">
        <button type="submit" class="btn btn-primary font-14"> <i class="fa fa-save"></i> Enviar Notificación</button>
    </div>
</div>