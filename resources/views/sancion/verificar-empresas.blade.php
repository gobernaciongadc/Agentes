@extends('admin.layouts.master')

@section('template_title')
Verificar Empresas
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <div class="border" style="width: 45%; border-radius: 8px; padding: 10px;">
            <span class="font-weight-bold">INFORME SEPREC</span> <br> {{ $informe->descripcion }}
        </div>

        <br>

        <div class="d-flex justify-content-between">
            <a href="{{ route('sancions-bandeja-entrada.indexBandejaEntrada',['id'=> $tipo]) }}" class="btn btn-danger font-14" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Verificación de SEPREC
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
                        <th style="width: 5%">ID</th>

                        <th>Nombre Representante SEPREC</th>
                        <th>Nombre Razón Social</th>
                        <th>Número Matricula Comercio</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Actividad</th>
                        <th>Nombre Representante Legal</th>
                        <th>Número Cedula Identidad</th>
                        <th>Base Empresarial Empresas Activas</th>
                        <th>Transferencia Cuotas Capital</th>
                        <th>Transferencia Empresa Unipersonal</th>
                        <!-- <th>Informe Id</th>
                        <th>Usuario Id</th> -->

                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->id }}</td>

                        <td>{{ $empresa->nombre_representante_seprec }}</td>
                        <td>{{ $empresa->nombre_razon_social }}</td>
                        <td>{{ $empresa->numero_matricula_comercio }}</td>
                        <td>{{ $empresa->direccion }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->actividad }}</td>
                        <td>{{ $empresa->nombre_representante_legal }}</td>
                        <td>{{ $empresa->numero_cedula_identidad }}</td>

                        <!-- Archivos PDF-->
                        <td>

                            @php
                            $rutaArchivo = 'uploads/empresas/' . basename($empresa->base_empresarial_empresas_activas);
                            @endphp

                            @if ($empresa->base_empresarial_empresas_activas && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Ver PDF
                            </a>
                            @else
                            <span>Sin Archivo</span>
                            @endif

                        </td>
                        <td>

                            @php
                            $rutaArchivo_2 = 'uploads/empresas/' . basename($empresa->transferencia_cuotas_capital);
                            @endphp

                            @if ($empresa->transferencia_cuotas_capital && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo_2) }}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Ver PDF
                            </a>
                            @else
                            <span>Sin Archivo</span>
                            @endif


                        </td>
                        <td>

                            @php
                            $rutaArchivo_3 = 'uploads/empresas/' . basename($empresa->transferencia_empresa_unipersonal);
                            @endphp

                            @if ($empresa->transferencia_empresa_unipersonal && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo_3) }}" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Ver PDF
                            </a>
                            @else
                            <span>Sin Archivo</span>
                            @endif

                        </td>
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