@extends('admin.layouts.master')

@section('template_title')
Verificar Derechos Reales
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <div class="border" style="width: 45%; border-radius: 8px; padding: 10px;">
            <span class="font-weight-bold">INFORME DERECHOS REALES</span> <br> {{ $informe->descripcion }}
        </div>

        <br>
        <div class="d-flex justify-content-between">
            <a href="{{ route('sancions-bandeja-entrada.indexBandejaEntrada',['id'=> $tipo]) }}" class="btn btn-danger font-14" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Verificación de Derechos Reales
            </a>
            @if ($informe->estado == 'No verificado')
            <div>
                <button id="btn-verificar" type="button" class="btn btn-success font-14" data-placement="left" onclick="openModalVerificar()">
                    <i class="fa fa-check"></i> Verificar
                </button>
                <button id="btn-observar" type="button" href="#" class="btn btn-warning font-14 text-dark" data-placement="left" onclick="openModalObservar()">
                    <i class="fa fa-eye"></i> Observar Informe
                </button type="button">
            </div>
            @endif
            @if ($informe->estado == 'Corregido')
            <div>
                <button id="btn-verificar" type="button" class="btn btn-success font-14" data-placement="left" onclick="openModalVerificar()">
                    <i class="fa fa-check"></i> Verificar
                </button>
                <button id="btn-observar" type="button" href="#" class="btn btn-warning font-14 text-dark" data-placement="left" onclick="openModalObservar()">
                    <i class="fa fa-eye"></i> Observar Informe
                </button type="button">
            </div>
            @endif
        </div>


        @if ($message = Session::get('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success("{{ $message }}", "Agentes de Información", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000,
                    positionClass: 'toast-top-right'
                });
            });
        </script>
        @endif

        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover" id="verificarEmpresasTable">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>ID</th>

                        <th>Nombre Registrador</th>
                        <th>Municipio Jurisdicción</th>
                        <th>Naturaleza Titulo</th>
                        <th>Número Titulo</th>
                        <th>Nombre Razón Social Cedente</th>
                        <th>Cédula O Nit Cedente</th>
                        <th>Nombre Razón Social Beneficiario</th>
                        <th>Cédula O Nit Beneficiario</th>
                        <th>Superficie Del Inmueble</th>
                        <th>Porcentaje De Acciones</th>
                        <th>Tipo De Formulario</th>
                        <th>Número De Orden</th>
                        <th>Monto Pagado</th>
                        <!-- <th>Informe Id</th>
                        <th>Usuario Id</th> -->

                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($derechosReales as $derechosReale)
                    <tr>

                        <td>{{ $derechosReale->id }}</td>
                        <td>{{ $derechosReale->nombre_registrador }}</td>
                        <td>{{ $derechosReale->municipio_jurisdiccion }}</td>
                        <td>{{ $derechosReale->naturaleza_titulo }}</td>
                        <td>{{ $derechosReale->numero_titulo }}</td>
                        <td>{{ $derechosReale->nombre_razon_social_cedente }}</td>
                        <td>{{ $derechosReale->cedula_o_nit_cedente }}</td>
                        <td>{{ $derechosReale->nombre_razon_social_beneficiario }}</td>
                        <td>{{ $derechosReale->cedula_o_nit_beneficiario }}</td>
                        <td>{{ $derechosReale->superficie_del_inmueble }}</td>
                        <td>{{ $derechosReale->porcentaje_de_acciones }}</td>
                        <td>{{ $derechosReale->tipo_de_formulario }}</td>
                        <td>{{ $derechosReale->numero_de_orden }}</td>
                        <td>{{ $derechosReale->monto_pagado }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Verificación -->
<div class="modal fade" id="verificacion-seprec-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="titulo-card">Verificación de Informe</h5>
                <button type="button" class="close" onclick="closeModalVerificar()" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <form id="verificar-informe-form">
                    <div class="form-group">
                        <label for="descripcion-informe-verificar" class="control-label">Descripción de Verificación de Informe:</label>
                        <textarea class="form-control" id="descripcion-informe-verificar" name="descripcion" rows="6"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="respaldo" class="form-label">Archivo de Verificación <span class="text-danger">*</span></label><br>

                        <label class="custom-file-upload">
                            <span>📄 Seleccionar Archivo</span>
                            <input type="file" name="verificacion-seprec" id="respaldo-1" accept="application/pdf" class="form-control">
                        </label>
                        <br>
                        <span id="file-name-1">
                            Ningún archivo seleccionado
                        </span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModalVerificar()">Cerrar</button>
                <button type="button" id="btn-guardar-verificar" class="btn btn-info" onclick="guardarInformeVerificar()">
                    <i class="fa fa-save"></i> Verificar
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Observacion -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="observacion-seprec-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <span class="text-dark">Observación de Informe</span>
                        <button type="button" class="close" onclick="closeModalObservar()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="observar-informe-form">
                            <div class="form-group">
                                <label for="descripcion-informe-observar" class="control-label">Descripción de Observación de Informe:</label>
                                <textarea class="form-control" name="descripcion-informe-observar" id="descripcion-informe-observar" rows="6"></textarea>
                            </div>
                            <!-- Tercera fila - sector archivos -->

                            <div class="form-group mb-2 mb20">
                                <label for="respaldo-2" class="form-label">Archivo de Observación<span class="text-danger">*</span></label><br>
                                <label class="custom-file-upload">
                                    <span>📄 Seleccionar Archivo</span>
                                    <input type="file" name="observacion-seprec" id="respaldo-2">
                                </label>
                                <br>
                                <span id="file-name-2">
                                    Ningún archivo seleccionado
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" onclick="closeModalObservar()">Cerrar</button>
                        <button type="button" id="btn-guardar-observar" onclick="guardarInformeObservar()" class="btn btn-info waves-effect waves-light"><i class="fa fa-eye"></i> Observar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Fin Modal -->

<script>
    // Abrir modal
    function openModalVerificar() {
        $('#verificacion-seprec-modal').modal('show');
    }

    // Cerrar modal
    function closeModalVerificar() {
        $('#verificacion-seprec-modal').modal('hide');
    }

    // Abrir modal
    function openModalObservar() {
        $('#observacion-seprec-modal').modal('show');
    }

    // Cerrar modal
    function closeModalObservar() {
        $('#observacion-seprec-modal').modal('hide');
    }

    function guardarInformeVerificar() {
        const formData = new FormData(document.getElementById('verificar-informe-form'));
        const btnGuardar = document.getElementById('btn-guardar-verificar');

        const btnVerificar = document.getElementById('btn-verificar');
        const btnObservar = document.getElementById('btn-observar');

        if (!formData.get('descripcion') || !formData.get('verificacion-seprec')) {
            alert('Por favor complete todos los campos obligatorios');
            return;
        }

        formData.append('informe_id', '{{$idInforme}}');
        formData.append('tipo_informacion', '{{$tipo}}');
        formData.append('_token', '{{ csrf_token() }}');

        btnGuardar.disabled = true;

        $.ajax({
            url: '{{ route("sancions-store-verificar.storeVerificar") }}',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                btnGuardar.disabled = false;
                console.log(response);

                if (response.status === 'success') {
                    btnVerificar.classList.add('d-none');
                    btnObservar.classList.add('d-none');
                    toastr.success('Informe verificado exitosamente', 'Agentes de Información');
                    closeModalVerificar();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(response) {
                btnGuardar.disabled = false;
                alert('Ocurrió un error al guardar el informe');
            }
        });
    }


    function guardarInformeObservar() {
        const formData = new FormData(document.getElementById('observar-informe-form'));
        const btnGuardar = document.getElementById('btn-guardar-observar');

        // Botones superiores
        const btnVerificar = document.getElementById('btn-verificar');
        const btnObservar = document.getElementById('btn-observar');

        if (!formData.get('descripcion-informe-observar') || !formData.get('observacion-seprec')) {
            toastr.error('Por favor complete todos los campos obligatorios', 'Agentes de Información');
            return;
        }

        formData.append('informe_id', '{{$idInforme}}');
        formData.append('tipo_informacion', '{{$tipo}}');
        formData.append('_token', '{{ csrf_token() }}');

        btnGuardar.disabled = true;

        $.ajax({
            url: '{{ route("sancions-store-observacion.storeObservacion") }}',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                btnGuardar.disabled = false;
                console.log(response);

                if (response.status === 'success') {
                    btnVerificar.classList.add('d-none');
                    btnObservar.classList.add('d-none');
                    toastr.success('Informe verificado exitosamente', 'Agentes de Información');
                    closeModalObservar();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(response) {
                btnGuardar.disabled = false;
                alert('Ocurrió un error al guardar el informe');
            }
        });
    }
</script>

@vite('resources/css/empresa.css')
@vite('resources/js/empresa.js')
@endsection