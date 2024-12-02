<div class="row padding-1 p-1 texto-form">

    <!-- primera fila -->
    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="nombre_secretario" class="form-label">{{ __('Nombre Secretario') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_secretario" class="form-control @error('nombre_secretario') is-invalid @enderror" value="{{ old('nombre_secretario', $sentenciasJudiciale?->nombre_secretario) }}" id="nombre_secretario">
            {!! $errors->first('nombre_secretario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group mb-2 mb20">
            <label for="numero_juzgado" class="form-label">{{ __('Número Juzgado') }}<span class="text-danger">*</span></label>
            <input type="text" name="numero_juzgado" class="form-control @error('numero_juzgado') is-invalid @enderror" value="{{ old('numero_juzgado', $sentenciasJudiciale?->numero_juzgado) }}" id="numero_juzgado">
            {!! $errors->first('numero_juzgado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="municipio_jurisdiccion" class="form-label">{{ __('Municipio Jurisdicción') }}<span class="text-danger">*</span></label>
            <input type="text" name="municipio_jurisdiccion" class="form-control @error('municipio_jurisdiccion') is-invalid @enderror" value="{{ old('municipio_jurisdiccion', $sentenciasJudiciale?->municipio_jurisdiccion) }}" id="municipio_jurisdiccion">
            {!! $errors->first('municipio_jurisdiccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="naturaleza_proceso" class="form-label">{{ __('Naturaleza Proceso') }}<span class="text-danger">*</span></label>
            <input type="text" name="naturaleza_proceso" class="form-control @error('naturaleza_proceso') is-invalid @enderror" value="{{ old('naturaleza_proceso', $sentenciasJudiciale?->naturaleza_proceso) }}" id="naturaleza_proceso">
            {!! $errors->first('naturaleza_proceso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <!-- Segunda fila -->
    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="numero_resolucion" class="form-label">{{ __('Número Resolucion') }}<span class="text-danger">*</span></label>
            <input type="text" name="numero_resolucion" class="form-control @error('numero_resolucion') is-invalid @enderror" value="{{ old('numero_resolucion', $sentenciasJudiciale?->numero_resolucion) }}" id="numero_resolucion">
            {!! $errors->first('numero_resolucion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="fecha_resolucion" class="form-label">{{ __('Fecha Resolucion') }}<span class="text-danger">*</span></label>
            <input type="text" name="fecha_resolucion" class="form-control @error('fecha_resolucion') is-invalid @enderror" value="{{ old('fecha_resolucion', $sentenciasJudiciale?->fecha_resolucion) }}" id="fecha_resolucion">
            {!! $errors->first('fecha_resolucion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="nombre_demandante" class="form-label">{{ __('Nombre Demandante') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_demandante" class="form-control @error('nombre_demandante') is-invalid @enderror" value="{{ old('nombre_demandante', $sentenciasJudiciale?->nombre_demandante) }}" id="nombre_demandante">
            {!! $errors->first('nombre_demandante', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="cedula_demandante" class="form-label">{{ __('Cédula Demandante') }}<span class="text-danger">*</span></label>
            <input type="text" name="cedula_demandante" class="form-control @error('cedula_demandante') is-invalid @enderror" value="{{ old('cedula_demandante', $sentenciasJudiciale?->cedula_demandante) }}" id="cedula_demandante">
            {!! $errors->first('cedula_demandante', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="nombre_demandado" class="form-label">{{ __('Nombre Demandado') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_demandado" class="form-control @error('nombre_demandado') is-invalid @enderror" value="{{ old('nombre_demandado', $sentenciasJudiciale?->nombre_demandado) }}" id="nombre_demandado">
            {!! $errors->first('nombre_demandado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="cedula_demandado" class="form-label">{{ __('Cédula Demandado') }}<span class="text-danger">*</span></label>
            <input type="text" name="cedula_demandado" class="form-control @error('cedula_demandado') is-invalid @enderror" value="{{ old('cedula_demandado', $sentenciasJudiciale?->cedula_demandado) }}" id="cedula_demandado">
            {!! $errors->first('cedula_demandado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

</div>

<div class="row mt-2">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
    </div>
</div>