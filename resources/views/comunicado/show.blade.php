@extends('admin.layouts.master')

@section('template_title')
{{ $comunicado->name ?? __('Show') . " " . __('Comunicado') }}
@endsection

@section('content')

<div class="card border">
    <div class="card-header card-bg" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="float-left">
            <span class="card-title titulo-card">Comunicado</span>
        </div>
        <div class="float-right">
            <a class="btn btn-info font-14" href="{{ route('comunicados.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
        </div>
    </div>

    <div class="card-body bg-white">

        <div class="form-group mb-3 mb20" style="max-width: 40%;">
            <strong class="text-uppercase font-14" style="color: black;">Titulo:</strong><br>
            {{ $comunicado->titulo }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong class="text-uppercase font-14" style="color: black;">Fecha Emision:</strong><br>
            {{ $comunicado->fecha_emision }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong class="text-uppercase font-14" style="color: black;">Destinatario:</strong><br>
            {{ $comunicado->destinatario }}
        </div>
        <div class="form-group mb-3 mb20" style="max-width: 40%;">
            <strong class="text-uppercase font-14" style="color: black;">Asunto:</strong><br>
            {{ $comunicado->asunto }}
        </div>
        <div class="form-group mb-4 mb20" style="max-width: 45%;">
            <strong class="text-uppercase font-14" style="color: black;">Mensaje:</strong><br>
            {{ $comunicado->cuerpo_mensaje }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong class="text-uppercase font-14" style="color: black;">Adjuntos:</strong><br>

            @php
            $rutaArchivo = 'comunicados/' . basename($comunicado->adjuntos);
            @endphp

            @if ($comunicado->adjuntos && Storage::disk('public')->exists($rutaArchivo))
            <a class="btn btn-link" href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                <i class="fa fa-file"></i> Ver Archivo
            </a>
            @else
            <span>Sin archivo</span>
            @endif
        </div>

    </div>
</div>

@vite('resources/css/comunicados.css')
@vite('resources/js/comunicados.js')
@endsection