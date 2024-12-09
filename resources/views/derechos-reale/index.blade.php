@extends('admin.layouts.master')

@section('template_title')
Derechos Reales
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div style="width: 45%;">
            <span class="font-weight-bold">INFORME NOTARIAL</span> <br> {{ $informe->descripcion }}
        </div>

        <br>
        <div class="d-flex justify-content-between">
            <a href="{{ route('informe-index-derecho.indexDerecho') }}" class="btn btn-danger font-14" data-placement="left">
                <i class="fa fa-chevron-left"></i> Regresar a Información de Derecho Reales
            </a>
            <a href="{{ route('derechos-reales.create',['idInforme'=>$id]) }}" class="btn btn-primary font-14" data-placement="left">
                <i class="fa fa-plus"></i> Crear Nuevo Registro
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
            <table id="derechosRealesTable" class="table table-striped table-hover">
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

                        <th style="width: 10%;">Acciones</th>
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
                        <!-- <td>{{ $derechosReale->informe_id }}</td>
                        <td>{{ $derechosReale->usuario_id }}</td> -->

                        <td>
                            <form action="{{ route('derechos-reales.destroy', ['id' => $derechosReale->id, 'idInforme' => $informe->id]) }}" method="POST">
                                <a class="btn btn-sm btn-primary " href="{{ route('derechos-reales.show', ['id' => $derechosReale->id, 'idInforme' => $informe->id]) }}"><i class="fa fa-fw fa-eye"></i></a>
                                <a class="btn btn-sm btn-success" href="{{ route('derechos-reales.edit', ['id' => $derechosReale->id, 'idInforme' => $informe->id]) }}"><i class="fa fa-fw fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Esta seguro de eliminar?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @vite('resources/css/derechos.css')
    @vite('resources/js/derechos.js')
    @endsection