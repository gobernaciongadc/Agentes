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

    <!-- Primera fila -->
    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="nombre_representante_seprec" class="form-label">{{ __('Nombre Representante Seprec') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_representante_seprec" class="form-control @error('nombre_representante_seprec') is-invalid @enderror" value="{{ old('nombre_representante_seprec', $empresa?->nombre_representante_seprec?: $notario->nombres .' '.$notario->apellidos) }}" id="nombre_representante_seprec">
            {!! $errors->first('nombre_representante_seprec', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="nombre_razon_social" class="form-label">{{ __('Nombre Razon Social') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_razon_social" class="form-control @error('nombre_razon_social') is-invalid @enderror" value="{{ old('nombre_razon_social', $empresa?->nombre_razon_social) }}" id="nombre_razon_social">
            {!! $errors->first('nombre_razon_social', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group mb-2 mb20">
            <label for="numero_matricula_comercio" class="form-label">{{ __('Número Matricula Comercio') }}<span class="text-danger">*</span></label>
            <input type="text" name="numero_matricula_comercio" class="form-control @error('numero_matricula_comercio') is-invalid @enderror" value="{{ old('numero_matricula_comercio', $empresa?->numero_matricula_comercio) }}" id="numero_matricula_comercio">
            {!! $errors->first('numero_matricula_comercio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="direccion" class="form-label">{{ __('Dirección') }}<span class="text-danger">*</span></label>
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $empresa?->direccion) }}" id="direccion">
            {!! $errors->first('direccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <!-- Segunda fila -->
    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="telefono" class="form-label">{{ __('Teléfono') }}<span class="text-danger">*</span></label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $empresa?->telefono) }}" id="telefono">
            {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mb-2 mb20">
            <label for="actividad" class="form-label">{{ __('Actividad') }}<span class="text-danger">*</span></label>
            <input type="text" name="actividad" class="form-control @error('actividad') is-invalid @enderror" value="{{ old('actividad', $empresa?->actividad) }}" id="actividad">
            {!! $errors->first('actividad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="nombre_representante_legal" class="form-label">{{ __('Nombre Representante Legal') }}<span class="text-danger">*</span></label>
            <input type="text" name="nombre_representante_legal" class="form-control @error('nombre_representante_legal') is-invalid @enderror" value="{{ old('nombre_representante_legal', $empresa?->nombre_representante_legal) }}" id="nombre_representante_legal">
            {!! $errors->first('nombre_representante_legal', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group mb-2 mb20">
            <label for="numero_cedula_identidad" class="form-label">{{ __('Número Cédula Identidad') }}<span class="text-danger">*</span></label>
            <input type="text" name="numero_cedula_identidad" class="form-control @error('numero_cedula_identidad') is-invalid @enderror" value="{{ old('numero_cedula_identidad', $empresa?->numero_cedula_identidad) }}" id="numero_cedula_identidad">
            {!! $errors->first('numero_cedula_identidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>


    <!-- Tercera fila - sector archivos -->
    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="respaldo" class="form-label">Base Empresarial de Empresas Activas<span class="text-danger">*</span></label><br>
            <label class="custom-file-upload">
                <span>📄 Seleccionar Archivo PDF</span>
                <input type="file" name="base_empresarial_empresas_activas" id="respaldo-1" accept="application/pdf">
            </label>
            <br>
            <span id="file-name-1">
                @if (old('base_empresarial_empresas_activas') || $empresa?->base_empresarial_empresas_activas)
                <span>
                    {{ basename(old('base_empresarial_empresas_activas') ?? $empresa?->base_empresarial_empresas_activas) }}
                </span>
                @else
                Ningún archivo seleccionado
                @endif
            </span>

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
    </div>


    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="respaldo" class="form-label">Transferencia de Cuotas Capital<span class="text-danger">*</span></label><br>
            <label class="custom-file-upload">
                <span>📄 Seleccionar Archivo PDF</span>
                <input type="file" name="transferencia_cuotas_capital" id="respaldo-2" accept="application/pdf">
            </label>
            <br>
            <span id="file-name-2">
                @if (old('transferencia_cuotas_capital') || $empresa?->transferencia_cuotas_capital)
                <span>
                    {{ basename(old('transferencia_cuotas_capital') ?? $empresa?->transferencia_cuotas_capital) }}
                </span>
                @else
                Ningún archivo seleccionado
                @endif
            </span>

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
    </div>

    <div class="col-md-4">
        <div class="form-group mb-2 mb20">
            <label for="respaldo" class="form-label">Transferencia de Empresa Unipersonal<span class="text-danger">*</span></label><br>
            <label class="custom-file-upload">
                <span>📄 Seleccionar Archivo PDF</span>
                <input type="file" name="transferencia_empresa_unipersonal" id="respaldo-3" accept="application/pdf">
            </label>
            <br>

            <span id="file-name-3">
                @if (old('transferencia_empresa_unipersonal') || $empresa?->transferencia_empresa_unipersonal)
                <span>
                    {{ basename(old('transferencia_empresa_unipersonal') ?? $empresa?->transferencia_empresa_unipersonal) }}
                </span>
                @else
                Ningún archivo seleccionado
                @endif
            </span>

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
    </div>

    <!-- Id informe -->
    <input type="hidden" name="informe_id" class="form-control @error('informe_id') is-invalid @enderror" value="{{ old('informe_id', $empresa?->informe_id?: $idInforme) }}" id="informe_id" placeholder="Informe Id">

    <!-- Id user -->
    <input type="hidden" name="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror" value="{{ old('usuario_id', $empresa?->usuario_id?: $idUser) }}" id="usuario_id" placeholder="Usuario Id">

</div>

<div class="row mt-2">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
    </div>
</div>