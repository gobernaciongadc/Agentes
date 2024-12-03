<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="tipo_sancion" class="form-label">{{ __('Tipo Sancion') }}</label>
            <input type="text" name="tipo_sancion" class="form-control @error('tipo_sancion') is-invalid @enderror" value="{{ old('tipo_sancion', $sancion?->tipo_sancion) }}" id="tipo_sancion" placeholder="Tipo Sancion">
            {!! $errors->first('tipo_sancion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="motivo" class="form-label">{{ __('Motivo') }}</label>
            <input type="text" name="motivo" class="form-control @error('motivo') is-invalid @enderror" value="{{ old('motivo', $sancion?->motivo) }}" id="motivo" placeholder="Motivo">
            {!! $errors->first('motivo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="feha_inposicion" class="form-label">{{ __('Feha Inposicion') }}</label>
            <input type="text" name="feha_inposicion" class="form-control @error('feha_inposicion') is-invalid @enderror" value="{{ old('feha_inposicion', $sancion?->feha_inposicion) }}" id="feha_inposicion" placeholder="Feha Inposicion">
            {!! $errors->first('feha_inposicion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="monto" class="form-label">{{ __('Monto') }}</label>
            <input type="text" name="monto" class="form-control @error('monto') is-invalid @enderror" value="{{ old('monto', $sancion?->monto) }}" id="monto" placeholder="Monto">
            {!! $errors->first('monto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado_recibido" class="form-label">{{ __('Estado Recibido') }}</label>
            <input type="text" name="estado_recibido" class="form-control @error('estado_recibido') is-invalid @enderror" value="{{ old('estado_recibido', $sancion?->estado_recibido) }}" id="estado_recibido" placeholder="Estado Recibido">
            {!! $errors->first('estado_recibido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="informe_id" class="form-label">{{ __('Informe Id') }}</label>
            <input type="text" name="informe_id" class="form-control @error('informe_id') is-invalid @enderror" value="{{ old('informe_id', $sancion?->informe_id) }}" id="informe_id" placeholder="Informe Id">
            {!! $errors->first('informe_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="usuario_id" class="form-label">{{ __('Usuario Id') }}</label>
            <input type="text" name="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror" value="{{ old('usuario_id', $sancion?->usuario_id) }}" id="usuario_id" placeholder="Usuario Id">
            {!! $errors->first('usuario_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>