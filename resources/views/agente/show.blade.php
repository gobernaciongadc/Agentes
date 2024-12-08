@extends('admin.layouts.master')

@section('template_title')
{{ $agente->name ?? __('Show') . " " . __('Agente') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-bg border">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="titulo-card">Datos de Agente</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info font-14" href="{{ route('agentes.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Agente:</strong>
                        {{ $agente->persona->nombres }} {{ $agente->persona->apellidos }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Municipio:</strong>
                        {{ $agente->municipio->nombre }} - {{ $agente->municipio->provincia }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Tipo Agente:</strong>
                        {{ $agente->tipo_agente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Respaldo:</strong>
                        <a href="{{ asset('storage/respaldos/' . basename($agente->respaldo)) }}" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Ver PDF
                        </a>
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        <td>{{ $agente->estado == 1 ? 'Activo' : 'Inactivo' }}</td>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/agente.css')
@vite('resources/js/agente.js')
@endsection