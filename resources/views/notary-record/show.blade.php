@extends('admin.layouts.master')

@section('template_title')
{{ $notaryRecord->name ?? __('Show') . " " . __('Notary Record') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Notary Record</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('notary-records.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Municipio:</strong>
                        {{ $notaryRecord->municipio }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Notaria:</strong>
                        {{ $notaryRecord->numero_notaria }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Notaria:</strong>
                        {{ $notaryRecord->nombre_notaria }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Escritura:</strong>
                        {{ $notaryRecord->numero_escritura }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Fecha Escritura:</strong>
                        {{ $notaryRecord->fecha_escritura }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Naturaleza Escritura:</strong>
                        {{ $notaryRecord->naturaleza_escritura }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Cedente:</strong>
                        {{ $notaryRecord->nombre_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Ci Nit Cedente:</strong>
                        {{ $notaryRecord->ci_nit_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Beneficiario:</strong>
                        {{ $notaryRecord->nombre_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Ci Nit Beneficiario:</strong>
                        {{ $notaryRecord->ci_nit_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Tipo Bien:</strong>
                        {{ $notaryRecord->tipo_bien }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Registro Bien:</strong>
                        {{ $notaryRecord->registro_bien }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Tipo Formulario:</strong>
                        {{ $notaryRecord->tipo_formulario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Orden:</strong>
                        {{ $notaryRecord->numero_orden }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Monto Pagado:</strong>
                        {{ $notaryRecord->monto_pagado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Observaciones:</strong>
                        {{ $notaryRecord->observaciones }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Informe Id:</strong>
                        {{ $notaryRecord->informe_id }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/notarial.css')
@vite('resources/js/notarial.js')
@endsection