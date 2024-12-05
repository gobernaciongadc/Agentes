@extends('admin.layouts.master')

@section('template_title')
{{ $notaryRecord->name ?? __('Show') . " " . __('Notary Record') }}
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
                        <a class="btn btn-info font-14" href="{{ route('notary-records.index', ['id'=>$idInforme]) }}"><i class="fa fa-chevron-left"></i> Regresar a gestión de Informe Notarios</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black">Municipio:</strong>
                        {{ $notaryRecord->municipio }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Numero Notaria:</strong>
                        {{ $notaryRecord->numero_notaria }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Nombre Notaria:</strong>
                        {{ $notaryRecord->nombre_notaria }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Numero Escritura:</strong>
                        {{ $notaryRecord->numero_escritura }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Fecha Escritura:</strong>
                        {{ $notaryRecord->fecha_escritura }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Naturaleza Escritura:</strong>
                        {{ $notaryRecord->naturaleza_escritura }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Nombre Cedente:</strong>
                        {{ $notaryRecord->nombre_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Ci Nit Cedente:</strong>
                        {{ $notaryRecord->ci_nit_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Nombre Beneficiario:</strong>
                        {{ $notaryRecord->nombre_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Ci Nit Beneficiario:</strong>
                        {{ $notaryRecord->ci_nit_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Tipo Bien:</strong>
                        {{ $notaryRecord->tipo_bien }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Registro Bien:</strong>
                        {{ $notaryRecord->registro_bien }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Tipo Formulario:</strong>
                        {{ $notaryRecord->tipo_formulario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Numero Orden:</strong>
                        {{ $notaryRecord->numero_orden }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Monto Pagado:</strong>
                        {{ $notaryRecord->monto_pagado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong class="font-weight-normal" style="color:black"> Observaciones:</strong>
                        {{ $notaryRecord->observaciones }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/notarial.css')
@vite('resources/js/notarial.js')
@endsection