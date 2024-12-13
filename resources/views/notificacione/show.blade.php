@extends('admin.layouts.master')

@section('template_title')
{{ $notificacione->name ?? __('Show') . " " . __('Notificacione') }}
@endsection

@section('content')

<div class="card border">
    <div class="card-header card-bg" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="float-left">
            <span class="card-title titulo-card">Notificaciones</span>
        </div>
        <div class="float-right">
            <a class="btn btn-info font-14" href="{{ route('notificaciones.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
        </div>
    </div>

    <div class="card-body bg-white">

        <div class="form-group mb-2 mb20" style="max-width: 40%;">
            <strong class="text-uppercase font-14" style="color: black;">Asunto:</strong><br>
            {{ $notificacione->asunto }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong class="text-uppercase font-14" style="color: black;">Destinatario:</strong><br>
            {{ json_decode($notificacione->destinatario)->nombre_agente }}
        </div>
        <div class="form-group mb-4 mb20" style="max-width: 45%;">
            <strong class="text-uppercase font-14" style="color: black;">Mensaje:</strong><br>
            {{ $notificacione->mensaje }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong class="text-uppercase font-14" style="color: black;">Fecha Emision:</strong><br>
            {{ $notificacione->fecha_emision }}
        </div>

        <div class="form-group mb-2 mb20">
            <strong class="text-uppercase font-14" style="color: black;">Adjuntos:</strong><br>

            @php
            $rutaArchivo = 'notificaciones/' . basename($notificacione->adjuntos );
            @endphp

            @if ($notificacione->adjuntos && Storage::disk('public')->exists($rutaArchivo))
            <a class="btn btn-link" href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                <i class="fa fa-file"></i> Ver Archivo
            </a>
            @else
            <span>Sin archivo</span>
            @endif
        </div>


    </div>
</div>
@vite('resources/css/notificaciones.css')
@vite('resources/js/notificaciones.js')
@endsection