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

        <label for="provincia" class="form-label">Provincia<span class="text-danger">*</span></label>
        <select name="provincia" class="form-control @error('provincia') is-invalid @enderror mb-2 mb20" id="provincia">
            <option value="" disabled selected>Selecciona una provincia</option>
            @foreach($provincias as $provincia)
            <option value="{{ $provincia }}" {{ old('provincia', $municipio?->provincia) == $provincia ? 'selected' : '' }}>
                {{ $provincia }}
            </option>
            @endforeach
        </select>

        <div class="form-group ">
            <label for="nombre" class="form-label">Nombre de municipio<span class="text-danger">*</span></label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $municipio?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <label for="nombre" class="form-label">Municipio<span class="text-danger">*</span></label>
        <select name="nombre" class="form-control @error('nombre') is-invalid @enderror mb-2 mb20" id="nombre">

            <option value="" disabled selected>Selecciona una provincia</option>
            @foreach($provincias as $provincia)
            <option value="{{ $provincia }}" {{ old('provincia', $municipio?->provincia) == $provincia ? 'selected' : '' }}>
                {{ $provincia }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Guardar </button>
    </div>
</div>