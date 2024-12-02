<div class="row padding-1 p-1 texto-form">

    <!-- Primera Fila -->
    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="nombre_registrador" class="form-label">{{ __('Nombre Registrador') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_registrador" class="form-control @error('nombre_registrador') is-invalid @enderror" value="{{ old('nombre_registrador', $derechosReale?->nombre_registrador) }}" id="nombre_registrador">
            {!! $errors->first('nombre_registrador', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="municipio_jurisdiccion" class="form-label">{{ __('Municipio Jurisdicción') }}<span class="text-danger">*</span></label>
            <input type="text" name="municipio_jurisdiccion" class="form-control @error('municipio_jurisdiccion') is-invalid @enderror" value="{{ old('municipio_jurisdiccion', $derechosReale?->municipio_jurisdiccion) }}" id="municipio_jurisdiccion">
            {!! $errors->first('municipio_jurisdiccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="naturaleza_titulo" class="form-label">{{ __('Naturaleza Titulo') }}<span class="text-danger">*</span></label>
            <input type="text" name="naturaleza_titulo" class="form-control @error('naturaleza_titulo') is-invalid @enderror" value="{{ old('naturaleza_titulo', $derechosReale?->naturaleza_titulo) }}" id="naturaleza_titulo">
            {!! $errors->first('naturaleza_titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group mb-2 mb20">
            <label for="numero_titulo" class="form-label">{{ __('Nmero Titulo') }}<span class="text-danger">*</span></label>
            <input type="text" name="numero_titulo" class="form-control @error('numero_titulo') is-invalid @enderror" value="{{ old('numero_titulo', $derechosReale?->numero_titulo) }}" id="numero_titulo">
            {!! $errors->first('numero_titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <!-- Segunda Fila -->
    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="nombre_razon_social_cedente" class="form-label">{{ __('Nombre Razon Social Cedente') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_razon_social_cedente" class="form-control @error('nombre_razon_social_cedente') is-invalid @enderror" value="{{ old('nombre_razon_social_cedente', $derechosReale?->nombre_razon_social_cedente) }}" id="nombre_razon_social_cedente">
            {!! $errors->first('nombre_razon_social_cedente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="cedula_o_nit_cedente" class="form-label">{{ __('Cedula O Nit Cedente') }}<span class="text-danger">*</span></label>
            <input type="text" name="cedula_o_nit_cedente" class="form-control @error('cedula_o_nit_cedente') is-invalid @enderror" value="{{ old('cedula_o_nit_cedente', $derechosReale?->cedula_o_nit_cedente) }}" id="cedula_o_nit_cedente">
            {!! $errors->first('cedula_o_nit_cedente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="nombre_razon_social_beneficiario" class="form-label">{{ __('Nombre Razon Social Beneficiario') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_razon_social_beneficiario" class="form-control @error('nombre_razon_social_beneficiario') is-invalid @enderror" value="{{ old('nombre_razon_social_beneficiario', $derechosReale?->nombre_razon_social_beneficiario) }}" id="nombre_razon_social_beneficiario">
            {!! $errors->first('nombre_razon_social_beneficiario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group mb-2 mb20">
            <label for="cedula_o_nit_beneficiario" class="form-label">{{ __('Cedula O Nit Beneficiario') }}<span class="text-danger">*</span></label>
            <input type="text" name="cedula_o_nit_beneficiario" class="form-control @error('cedula_o_nit_beneficiario') is-invalid @enderror" value="{{ old('cedula_o_nit_beneficiario', $derechosReale?->cedula_o_nit_beneficiario) }}" id="cedula_o_nit_beneficiario">
            {!! $errors->first('cedula_o_nit_beneficiario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <!-- Tercera Fila -->
    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="superficie_del_inmueble" class="form-label">{{ __('Superficie Del Inmueble') }}<span class="text-danger">*</span></label>
            <input type="text" name="superficie_del_inmueble" class="form-control @error('superficie_del_inmueble') is-invalid @enderror" value="{{ old('superficie_del_inmueble', $derechosReale?->superficie_del_inmueble) }}" id="superficie_del_inmueble">
            {!! $errors->first('superficie_del_inmueble', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="porcentaje_de_acciones" class="form-label">{{ __('Porcentaje De Acciones') }}<span class="text-danger">*</span></label>
            <input type="text" name="porcentaje_de_acciones" class="form-control @error('porcentaje_de_acciones') is-invalid @enderror" value="{{ old('porcentaje_de_acciones', $derechosReale?->porcentaje_de_acciones) }}" id="porcentaje_de_acciones">
            {!! $errors->first('porcentaje_de_acciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="tipo_de_formulario" class="form-label">{{ __('Tipo De Formulario') }}<span class="text-danger">*</span></label>
            <input type="text" name="tipo_de_formulario" class="form-control @error('tipo_de_formulario') is-invalid @enderror" value="{{ old('tipo_de_formulario', $derechosReale?->tipo_de_formulario) }}" id="tipo_de_formulario">
            {!! $errors->first('tipo_de_formulario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="numero_de_orden" class="form-label">{{ __('Numero De Orden') }}<span class="text-danger">*</span></label>
            <input type="text" name="numero_de_orden" class="form-control @error('numero_de_orden') is-invalid @enderror" value="{{ old('numero_de_orden', $derechosReale?->numero_de_orden) }}" id="numero_de_orden">
            {!! $errors->first('numero_de_orden', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="monto_pagado" class="form-label">{{ __('Monto Pagado') }}<span class="text-danger">*</span></label>
            <input type="text" name="monto_pagado" class="form-control @error('monto_pagado') is-invalid @enderror" value="{{ old('monto_pagado', $derechosReale?->monto_pagado) }}" id="monto_pagado">
            {!! $errors->first('monto_pagado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="form-group mb-2 mb20 d-none">
        <label for="informe_id" class="form-label">{{ __('Informe Id') }}<span class="text-danger">*</span></label>
        <input type="text" name="informe_id" class="form-control @error('informe_id') is-invalid @enderror" value="{{ old('informe_id', $derechosReale?->informe_id) }}" id="informe_id">
        {!! $errors->first('informe_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20 d-none">
        <label for="usuario_id" class="form-label">{{ __('Usuario Id') }}<span class="text-danger">*</span></label>
        <input type="text" name="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror" value="{{ old('usuario_id', $derechosReale?->usuario_id) }}" id="usuario_id">
        {!! $errors->first('usuario_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>

</div>

<div class="row mt-2">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
    </div>
</div>