@extends('admin.layouts.master')

@section('template_title')
{{ $empresa->name ?? __('Show') . " " . __('Empresa') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Empresa</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('empresas.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Representante Seprec:</strong>
                        {{ $empresa->nombre_representante_seprec }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Razon Social:</strong>
                        {{ $empresa->nombre_razon_social }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Matricula Comercio:</strong>
                        {{ $empresa->numero_matricula_comercio }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Direccion:</strong>
                        {{ $empresa->direccion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Telefono:</strong>
                        {{ $empresa->telefono }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Actividad:</strong>
                        {{ $empresa->actividad }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Representante Legal:</strong>
                        {{ $empresa->nombre_representante_legal }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Cedula Identidad:</strong>
                        {{ $empresa->numero_cedula_identidad }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Base Empresarial Empresas Activas:</strong>
                        {{ $empresa->base_empresarial_empresas_activas }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Transferencia Cuotas Capital:</strong>
                        {{ $empresa->transferencia_cuotas_capital }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Transferencia Empresa Unipersonal:</strong>
                        {{ $empresa->transferencia_empresa_unipersonal }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Informe Id:</strong>
                        {{ $empresa->informe_id }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Usuario Id:</strong>
                        {{ $empresa->usuario_id }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/empresa.css')
@vite('resources/js/empresa.js')
@endsection