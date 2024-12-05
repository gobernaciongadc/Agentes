@extends('admin.layouts.master')

@section('template_title')
{{ $derechosReale->name ?? __('Show') . " " . __('Derechos Reale') }}
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
                        <a class="btn btn-info font-14" href="{{ route('derechos-reales.index', ['id'=>$idInforme]) }}"><i class="fa fa-chevron-left"></i> Regresar a gestión de Derechos Reales</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Registrador:</strong>
                        {{ $derechosReale->nombre_registrador }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Municipio Jurisdiccion:</strong>
                        {{ $derechosReale->municipio_jurisdiccion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Naturaleza Titulo:</strong>
                        {{ $derechosReale->naturaleza_titulo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Numero Titulo:</strong>
                        {{ $derechosReale->numero_titulo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Razon Social Cedente:</strong>
                        {{ $derechosReale->nombre_razon_social_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Cedula O Nit Cedente:</strong>
                        {{ $derechosReale->cedula_o_nit_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Razon Social Beneficiario:</strong>
                        {{ $derechosReale->nombre_razon_social_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Cedula O Nit Beneficiario:</strong>
                        {{ $derechosReale->cedula_o_nit_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Superficie Del Inmueble:</strong>
                        {{ $derechosReale->superficie_del_inmueble }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Porcentaje De Acciones:</strong>
                        {{ $derechosReale->porcentaje_de_acciones }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Tipo De Formulario:</strong>
                        {{ $derechosReale->tipo_de_formulario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Numero De Orden:</strong>
                        {{ $derechosReale->numero_de_orden }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Monto Pagado:</strong>
                        {{ $derechosReale->monto_pagado }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/derechos.css')
@vite('resources/js/derechos.js')
@endsection