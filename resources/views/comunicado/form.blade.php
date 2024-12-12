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

    <div class="col-md-6 form-group mb-2 mb20">
        <label for="titulo" class="form-label">{{ __('Titulo') }}</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $comunicado?->titulo) }}" id="titulo">
        {!! $errors->first('titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>

    <div class="col-md-6 form-group mb-2 mb20">
        <label for="destinatario" class="form-label">{{ __('Destinatario') }}</label>
        <input type="text" name="destinatario" class="form-control @error('destinatario') is-invalid @enderror" value="{{ old('destinatario', $comunicado?->destinatario) }}" id="destinatario">
        {!! $errors->first('destinatario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="col-md-6 form-group mb-2 mb20">
        <label for="asunto" class="form-label">{{ __('Asunto') }}</label>
        <input type="text" name="asunto" class="form-control @error('asunto') is-invalid @enderror" value="{{ old('asunto', $comunicado?->asunto) }}" id="asunto">
        {!! $errors->first('asunto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="col-8 form-group mb-2 mb20">
        <label for="cuerpo_mensaje" class="form-label">{{ __('Mensaje') }}</label>
        <textarea name="cuerpo_mensaje"
            class="form-control @error('cuerpo_mensaje') is-invalid @enderror"
            id="cuerpo_mensaje"
            rows="7">{{ old('cuerpo_mensaje', $comunicado?->cuerpo_mensaje) }}</textarea>

        {!! $errors->first('cuerpo_mensaje', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="col-12 form-group mb-2 mb20">
        <label for="adjuntos" class="form-label">{{ __('Adjuntos') }}</label>
        <input type="text" name="adjuntos" class="form-control @error('adjuntos') is-invalid @enderror" value="{{ old('adjuntos', $comunicado?->adjuntos) }}" id="adjuntos" placeholder="Adjuntos">
        {!! $errors->first('adjuntos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>


</div>
<div class="row mt-2">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Enviar Comunicado</button>
    </div>
</div>