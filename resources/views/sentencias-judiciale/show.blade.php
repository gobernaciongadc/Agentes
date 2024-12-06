@extends('admin.layouts.master')

@section('template_title')
{{ $sentenciasJudiciale->name ?? __('Show') . " " . __('Sentencias Judiciale') }}
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
                        <a class="btn btn-info font-14" href="{{ route('sentencias-judiciales.index', ['id'=>$idInforme]) }}"><i class="fa fa-chevron-left"></i> Regresar a gestión de Informe Juzgados</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Secretario:</strong>
                        {{ $sentenciasJudiciale->nombre_secretario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Numero Juzgado:</strong>
                        {{ $sentenciasJudiciale->numero_juzgado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Municipio Jurisdiccion:</strong>
                        {{ $sentenciasJudiciale->municipio_jurisdiccion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Naturaleza Proceso:</strong>
                        {{ $sentenciasJudiciale->naturaleza_proceso }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Numero Resolucion:</strong>
                        {{ $sentenciasJudiciale->numero_resolucion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Fecha Resolucion:</strong>
                        {{ $sentenciasJudiciale->fecha_resolucion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Demandante:</strong>
                        {{ $sentenciasJudiciale->nombre_demandante }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Cedula Demandante:</strong>
                        {{ $sentenciasJudiciale->cedula_demandante }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Nombre Demandado:</strong>
                        {{ $sentenciasJudiciale->nombre_demandado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong style="color:black">Cedula Demandado:</strong>
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