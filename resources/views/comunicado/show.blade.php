@extends('admin.layouts.master')

@section('template_title')
{{ $comunicado->name ?? __('Show') . " " . __('Comunicado') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Comunicado</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('comunicados.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Titulo:</strong>
                        {{ $comunicado->titulo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Fecha Emision:</strong>
                        {{ $comunicado->fecha_emision }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Destinatario:</strong>
                        {{ $comunicado->destinatario }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Asunto:</strong>
                        {{ $comunicado->asunto }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Cuerpo Mensaje:</strong>
                        {{ $comunicado->cuerpo_mensaje }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Adjuntos:</strong>
                        {{ $comunicado->adjuntos }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Usuario Id:</strong>
                        {{ $comunicado->usuario_id }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/comunicados.css')
@vite('resources/js/comunicados.js')
@endsection