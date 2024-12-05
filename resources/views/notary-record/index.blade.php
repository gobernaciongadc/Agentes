@extends('admin.layouts.master')

@section('template_title')
Notary Records
@endsection

@section('content')


<div class="row">
    <div class="col-sm-12">

        <div style="width: 45%;">
            <span class="font-weight-bold">INFORME NOTARIAL</span> <br> {{ $informe->descripcion }}
        </div>

        <br>

        <div class="d-flex justify-content-between">
            <a href="{{ route('notary-records.create', ['idInforme'=>$id]) }}" class="btn btn-primary font-14 float-right" data-placement="left">
                <i class="fa fa-plus"></i> Crear Nuevo Registro
            </a>
            <a href="{{ route('informe-notarials.index') }}" class="btn btn-info font-14 float-left" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Información Notarios
            </a>
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


        <div class="table-responsive">
            <table id="notarialesTable" class="table table-striped table-hover">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>#</th>
                        <th>Municipio</th>
                        <th>Número Notaria</th>
                        <th>Nombre Notario(a)</th>
                        <th>Número Escritura</th>
                        <th>Fecha Escritura</th>
                        <th>Naturaleza Escritura</th>
                        <th>Nombre Cedente</th>
                        <th>Ci Nit Cedente</th>
                        <th>Nombre Beneficiario</th>
                        <th>Ci Nit Beneficiario</th>
                        <th>Tipo Bien</th>
                        <th>Registro Bien</th>
                        <th>Tipo Formulario</th>
                        <th>Número Orden</th>
                        <th>Monto Pagado</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($notaryRecords as $notaryRecord)
                    <tr>
                        <td>{{ $notaryRecord->id }}</td>

                        <td>{{ $notaryRecord->municipio }}</td>
                        <td>{{ $notaryRecord->numero_notaria }}</td>
                        <td>{{ $notaryRecord->nombre_notaria }}</td>
                        <td>{{ $notaryRecord->numero_escritura }}</td>
                        <td>{{ $notaryRecord->fecha_escritura }}</td>
                        <td>{{ $notaryRecord->naturaleza_escritura }}</td>
                        <td>{{ $notaryRecord->nombre_cedente }}</td>
                        <td>{{ $notaryRecord->ci_nit_cedente }}</td>
                        <td>{{ $notaryRecord->nombre_beneficiario }}</td>
                        <td>{{ $notaryRecord->ci_nit_beneficiario }}</td>
                        <td>{{ $notaryRecord->tipo_bien }}</td>
                        <td>{{ $notaryRecord->registro_bien }}</td>
                        <td>{{ $notaryRecord->tipo_formulario }}</td>
                        <td>{{ $notaryRecord->numero_orden }}</td>
                        <td>{{ $notaryRecord->monto_pagado }}</td>
                        <td>{{ $notaryRecord->observaciones }}</td>

                        <td>
                            <form action="{{ route('notary-records.destroy', ['id' => $notaryRecord->id, 'idInforme' => $informe->id]) }}" method="POST">
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('notary-records.show', ['id' => $notaryRecord->id, 'idInforme' => $informe->id]) }}"
                                    title="Ver Datos">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-success" href="{{ route('notary-records.edit', ['id' => $notaryRecord->id, 'idInforme' => $informe->id]) }}" title="Modificar Datos"><i class="fa fa-fw fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Esta seguro de eliminar?') ? this.closest('form').submit() : false;" title="Eliminar datos"><i class="fa fa-fw fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@vite('resources/css/notarial.css')
@vite('resources/js/notarial.js')
@endsection