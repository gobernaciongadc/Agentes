@extends('admin.layouts.master')

@section('template_title')
{{ $derechosReale->name ?? __('Show') . " " . __('Derechos Reale') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Derechos Reale</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('derechos-reales.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Registrador:</strong>
                        {{ $derechosReale->nombre_registrador }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Municipio Jurisdiccion:</strong>
                        {{ $derechosReale->municipio_jurisdiccion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Naturaleza Titulo:</strong>
                        {{ $derechosReale->naturaleza_titulo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Titulo:</strong>
                        {{ $derechosReale->numero_titulo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Razon Social Cedente:</strong>
                        {{ $derechosReale->nombre_razon_social_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Cedula O Nit Cedente:</strong>
                        {{ $derechosReale->cedula_o_nit_cedente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Razon Social Beneficiario:</strong>
                        {{ $derechosReale->nombre_razon_social_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Cedula O Nit Beneficiario:</strong>
                        {{ $derechosReale->cedula_o_nit_beneficiario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Superficie Del Inmueble:</strong>
                        {{ $derechosReale->superficie_del_inmueble }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Porcentaje De Acciones:</strong>
                        {{ $derechosReale->porcentaje_de_acciones }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Tipo De Formulario:</strong>
                        {{ $derechosReale->tipo_de_formulario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero De Orden:</strong>
                        {{ $derechosReale->numero_de_orden }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Monto Pagado:</strong>
                        {{ $derechosReale->monto_pagado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Informe Id:</strong>
                        {{ $derechosReale->informe_id }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Usuario Id:</strong>
                        {{ $derechosReale->usuario_id }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/derechos.css')
@vite('resources/js/derechos.js')
@endsection