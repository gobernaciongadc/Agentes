@extends('admin.layouts.master')

@section('template_title')
{{ $sentenciasJudiciale->name ?? __('Show') . " " . __('Sentencias Judiciale') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Sentencias Judiciale</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('sentencias-judiciales.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Secretario:</strong>
                        {{ $sentenciasJudiciale->nombre_secretario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Juzgado:</strong>
                        {{ $sentenciasJudiciale->numero_juzgado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Municipio Jurisdiccion:</strong>
                        {{ $sentenciasJudiciale->municipio_jurisdiccion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Naturaleza Proceso:</strong>
                        {{ $sentenciasJudiciale->naturaleza_proceso }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Resolucion:</strong>
                        {{ $sentenciasJudiciale->numero_resolucion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Fecha Resolucion:</strong>
                        {{ $sentenciasJudiciale->fecha_resolucion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Demandante:</strong>
                        {{ $sentenciasJudiciale->nombre_demandante }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Cedula Demandante:</strong>
                        {{ $sentenciasJudiciale->cedula_demandante }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Demandado:</strong>
                        {{ $sentenciasJudiciale->nombre_demandado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Cedula Demandado:</strong>
                        {{ $sentenciasJudiciale->cedula_demandado }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/juzgado.css')
@vite('resources/js/juzgado.js')
@endsection