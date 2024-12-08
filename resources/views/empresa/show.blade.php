@extends('admin.layouts.master')

@section('template_title')
{{ $empresa->name ?? __('Show') . " " . __('Empresa') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border">

                <div class="card-header card-bg" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title titulo-card">Datos de Registro</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary font-14" href="{{ route('empresas.index', ['id'=>$idInforme]) }}"> Regresar a gestión de SEPREC</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Representante Seprec:</strong>
                        {{ $empresa->nombre_representante_seprec }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Razon Social:</strong>
                        {{ $empresa->nombre_razon_social }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Numero Matricula Comercio:</strong>
                        {{ $empresa->numero_matricula_comercio }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Direccion:</strong>
                        {{ $empresa->direccion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Telefono:</strong>
                        {{ $empresa->telefono }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Actividad:</strong>
                        {{ $empresa->actividad }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Representante Legal:</strong>
                        {{ $empresa->nombre_representante_legal }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Numero Cedula Identidad:</strong>
                        {{ $empresa->numero_cedula_identidad }}
                    </div>

                    <!-- Sector archivos -->
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Base Empresarial Empresas Activas:</strong>
                        <a href="{{ asset('storage/uploads/empresas/' . basename($empresa->base_empresarial_empresas_activas)) }}" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Ver PDF
                        </a>
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Transferencia Cuotas Capital:</strong>
                        <a href="{{ asset('storage/uploads/empresas/' . basename($empresa->transferencia_cuotas_capital)) }}" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Ver PDF
                        </a>
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Transferencia Empresa Unipersonal:</strong>
                        <a href="{{ asset('storage/uploads/empresas/' . basename($empresa->transferencia_empresa_unipersonal)) }}" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Ver PDF
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/empresa.css')
@vite('resources/js/empresa.js')
@endsection