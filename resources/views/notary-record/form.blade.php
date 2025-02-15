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

     <!-- Primera Fila -->
     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="municipio" class="form-label">{{ __('Municipio') }} <span class="text-danger">*</span></label>
             <input type="text" name="municipio" class="form-control @error('municipio') is-invalid @enderror" value="{{ old('municipio', $notaryRecord?->municipio?: $municipio->nombre.' - '.$municipio->provincia ) }}" id="municipio" readonly>
             {!! $errors->first('municipio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="numero_notaria" class="form-label">{{ __('Número Notaria') }} <span class="text-danger">*</span></label>
             <input type="text" name="numero_notaria" class="form-control @error('numero_notaria') is-invalid @enderror" value="{{ old('numero_notaria', $notaryRecord?->numero_notaria) }}" id="numero_notaria">
             {!! $errors->first('numero_notaria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group mb-2 mb20">
             <label for="nombre_notaria" class="form-label">{{ __('Nombre Notaria(o)') }} <span class="text-danger">*</span></label>
             <input type="text" name="nombre_notaria" class="form-control @error('nombre_notaria') is-invalid @enderror" value="{{ old('nombre_notaria', $notaryRecord?->nombre_notaria?: $notario->nombres .' '.$notario->apellidos ) }}" id="nombre_notaria" readonly>
             {!! $errors->first('nombre_notaria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-2">
         <div class="form-group mb-2 mb20">
             <label for="numero_escritura" class="form-label">{{ __('Número Escritura') }} <span class="text-danger">*</span></label>
             <input type="text" name="numero_escritura" class="form-control @error('numero_escritura') is-invalid @enderror" value="{{ old('numero_escritura', $notaryRecord?->numero_escritura) }}" id="numero_escritura">
             {!! $errors->first('numero_escritura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>


     <!-- Segunda Fila -->
     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="fecha_escritura" class="form-label">{{ __('Fecha Escritura') }} <span class="text-danger">*</span></label>
             <input type="date" name="fecha_escritura" class="form-control @error('fecha_escritura') is-invalid @enderror" value="{{ old('fecha_escritura', $notaryRecord?->fecha_escritura) }}" id="fecha_escritura">
             {!! $errors->first('fecha_escritura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="naturaleza_escritura" class="form-label">{{ __('Naturaleza Escritura') }} <span class="text-danger">*</span></label>
             <input type="text" name="naturaleza_escritura" class="form-control @error('naturaleza_escritura') is-invalid @enderror" value="{{ old('naturaleza_escritura', $notaryRecord?->naturaleza_escritura) }}" id="naturaleza_escritura">
             {!! $errors->first('naturaleza_escritura', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group mb-2 mb20">
             <label for="nombre_cedente" class="form-label">{{ __('Nombre Cedente') }} <span class="text-danger">*</span></label>
             <input type="text" name="nombre_cedente" class="form-control @error('nombre_cedente') is-invalid @enderror" value="{{ old('nombre_cedente', $notaryRecord?->nombre_cedente) }}" id="nombre_cedente">
             {!! $errors->first('nombre_cedente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-2">
         <div class="form-group mb-2 mb20">
             <label for="ci_nit_cedente" class="form-label">{{ __('Ci Nit Cedente') }} <span class="text-danger">*</span></label>
             <input type="text" name="ci_nit_cedente" class="form-control @error('ci_nit_cedente') is-invalid @enderror" value="{{ old('ci_nit_cedente', $notaryRecord?->ci_nit_cedente) }}" id="ci_nit_cedente">
             {!! $errors->first('ci_nit_cedente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>


     <!-- Tercera Fila -->
     <div class="col-md-5">
         <div class="form-group mb-2 mb20">
             <label for="nombre_beneficiario" class="form-label">{{ __('Nombre Beneficiario') }} <span class="text-danger">*</span></label>
             <input type="text" name="nombre_beneficiario" class="form-control @error('nombre_beneficiario') is-invalid @enderror" value="{{ old('nombre_beneficiario', $notaryRecord?->nombre_beneficiario) }}" id="nombre_beneficiario">
             {!! $errors->first('nombre_beneficiario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group mb-2 mb20">
             <label for="ci_nit_beneficiario" class="form-label">{{ __('Ci Nit Beneficiario') }} <span class="text-danger">*</span></label>
             <input type="text" name="ci_nit_beneficiario" class="form-control @error('ci_nit_beneficiario') is-invalid @enderror" value="{{ old('ci_nit_beneficiario', $notaryRecord?->ci_nit_beneficiario) }}" id="ci_nit_beneficiario">
             {!! $errors->first('ci_nit_beneficiario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <!-- Campo Tipo Bien -->
     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="tipo_bien" class="form-label">Tipo Bien<span class="text-danger">*</span></label>
             <select name="tipo_bien" class="form-control @error('tipo_bien') is-invalid @enderror mb-2 mb20" id="tipo_bien">
                 <option value="" disabled selected>Selecciona un tipo</option>
                 @foreach($tipoBien as $tipo)
                 <option value="{{ $tipo }}" {{ old('tipo_bien', $notaryRecord?->tipo_bien) == $tipo ? 'selected' : '' }}>
                     {{ $tipo }}
                 </option>
                 @endforeach
             </select>
             @error('tipoBien')
             <div class="invalid-feedback">{{ $message }}</div>
             @enderror
         </div>
     </div>


     <!-- Cuarta Fila -->
     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="registro_bien" class="form-label">{{ __('Registro Bien') }} <span class="text-danger">*</span></label>
             <input type="text" name="registro_bien" class="form-control @error('registro_bien') is-invalid @enderror" value="{{ old('registro_bien', $notaryRecord?->registro_bien) }}" id="registro_bien">
             {!! $errors->first('registro_bien', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-3">
         <div class="form-group mb-2 mb20">
             <label for="tipo_formulario" class="form-label">{{ __('Tipo Formulario') }} <span class="text-danger">*</span></label>
             <input type="text" name="tipo_formulario" class="form-control @error('tipo_formulario') is-invalid @enderror" value="{{ old('tipo_formulario', $notaryRecord?->tipo_formulario) }}" id="tipo_formulario" readonly>
             {!! $errors->first('tipo_formulario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const tipoBienSelect = document.getElementById('tipo_bien');
             const tipoFormularioInput = document.getElementById('tipo_formulario');

             // Escucha el cambio en el campo tipo_bien
             tipoBienSelect.addEventListener('change', function() {
                 // Actualiza el campo tipo_formulario con el valor seleccionado
                 if (tipoBienSelect.value === 'Inmueble') {
                     tipoFormularioInput.value = 'A-1';
                 } else {
                     tipoFormularioInput.value = 'A-2';
                 }
             });
         });
     </script>

     <div class="col-md-4">
         <div class="form-group mb-2 mb20">
             <label for="numero_orden" class="form-label">{{ __('Número Orden') }} <span class="text-danger">*</span></label>
             <input type="text" name="numero_orden" class="form-control @error('numero_orden') is-invalid @enderror" value="{{ old('numero_orden', $notaryRecord?->numero_orden) }}" id="numero_orden">
             {!! $errors->first('numero_orden', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <div class="col-md-2">
         <div class="form-group mb-2 mb20">
             <label for="monto_pagado" class="form-label">{{ __('Monto Pagado') }} <span class="text-danger">*</span></label>
             <input type="text" name="monto_pagado" class="form-control @error('monto_pagado') is-invalid @enderror" value="{{ old('monto_pagado', $notaryRecord?->monto_pagado) }}" id="monto_pagado">
             {!! $errors->first('monto_pagado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>

     <!-- Quinta Fila -->
     <div class="col-md-6">
         <div class="form-group mb-2 mb20">
             <label for="observaciones" class="form-label">{{ __('Observaciones') }} <span class="text-danger">*</span></label>
             <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" value="{{ old('observaciones', $notaryRecord?->observaciones) }}" id="observaciones">
             {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
         </div>
     </div>


     <!-- Id informe -->
     <input type="hidden" name="informe_id" class="form-control @error('informe_id') is-invalid @enderror" value="{{ old('informe_id', $notaryRecord?->informe_id?: $idInforme) }}" id="informe_id" placeholder="Informe Id">

     <!-- Id user -->
     <input type="hidden" name="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror" value="{{ old('usuario_id', $notaryRecord?->usuario_id?: $idUser) }}" id="usuario_id" placeholder="Usuario Id">


 </div>
 <div class="row mt-2">
     <div class="col-md-12">
         <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
     </div>
 </div>