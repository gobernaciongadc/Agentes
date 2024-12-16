@extends('admin.layouts.master')

@section('template_title')
Notificaciones
@endsection

@section('content')

<div class="card border">
    <div class="card-header card-bg">
        <div style="display: flex; justify-content: space-between; align-items: center;">

            <span id="card_title" class="titulo-card">
                Lista de Notificaciones
            </span>

            @if ($tipoAgente == 'Administrador')
            <div class="float-right">
                <a href="{{ route('notificaciones.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                    <i class="fa fa-plus"></i> Crear Notificación
                </a>
            </div>
            @endif

        </div>
    </div>

    @if ($message = Session::get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ $message }}", "Agentes de Información", {
                closeButton: true,
                progressBar: true,
                timeOut: 5000,
                positionClass: 'toast-top-right'
            });
        });
    </script>
    @endif

    <div class="card-body bg-white">
        <div class="table-responsive">
            <table id="notificaciones-table" class="table table-striped table-hover">
                <thead class="thead small">
                    <tr>
                        <th>ID</th>
                        <th>Asunto</th>
                        <th>Destinatario</th>
                        <th>Mensaje</th>
                        <th>Fecha Emision</th>
                        <th>Adjuntos</th>
                        @if ($tipoAgente == 'Administrador')

                        <th>Estado</th>

                        @endif
                        @if ($tipoAgente == 'Agente')

                        <th>Estado</th>
                        <th>Acciones</th>

                        @endif
                    </tr>
                </thead>
                <tbody>

                    @if ($tipoAgente == 'Agente')
                    @foreach ($agentesNotificados as $notificacione)
                    <tr>
                        <td>{{ $notificacione->id }}</td>
                        <td>{{ $notificacione->asunto }}</td>

                        <td>{{ json_decode($notificacione->destinatario)->nombre_agente }}</td>

                        <td>{{ $notificacione->mensaje }}</td>
                        <td>{{ $notificacione->fecha_emision }}</td>
                        <td>
                            @php
                            $rutaArchivo = 'notificaciones/' . basename($notificacione->adjuntos);
                            @endphp

                            @if ($notificacione->adjuntos && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                                <i class="fa fa-file"></i> Ver Archivo
                            </a>
                            @else
                            <span>Sin archivo</span>
                            @endif
                        </td>

                        @if ($tipoAgente == 'Administrador')
                        <td>
                            <span class="badge badge-success">Notificación enviada</span>
                        </td>
                        @endif

                        @if ($tipoAgente == 'Agente')
                        <td>
                            @if($notificacione->estado == 'Revizado')
                            <span class="badge badge-success">{{ $notificacione->estado }}</span>
                            @else
                            <span class="badge badge-danger">{{ $notificacione->estado }}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary " href="{{ route('notificaciones.show',$notificacione->id) }}"><i class="fa fa-fw fa-eye"></i> Ver Notificacion</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif

                    @if ($tipoAgente == 'Administrador')
                    @foreach ($notificaciones as $notificacione)
                    <tr>
                        <td>{{ $notificacione->id }}</td>
                        <td>{{ $notificacione->asunto }}</td>

                        <td>{{ json_decode($notificacione->destinatario)->nombre_agente }}</td>

                        <td>{{ $notificacione->mensaje }}</td>
                        <td>{{ $notificacione->fecha_emision }}</td>
                        <td>
                            @php
                            $rutaArchivo = 'notificaciones/' . basename($notificacione->adjuntos);
                            @endphp

                            @if ($notificacione->adjuntos && Storage::disk('public')->exists($rutaArchivo))
                            <a href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                                <i class="fa fa-file"></i> Ver Archivo
                            </a>
                            @else
                            <span>Sin archivo</span>
                            @endif
                        </td>

                        @if ($tipoAgente == 'Administrador')
                        <td>
                            <span class="badge badge-success">Notificación enviada</span>
                        </td>
                        @endif

                        @if ($tipoAgente == 'Agente')
                        <td>
                            <a class="btn btn-sm btn-primary " href="{{ route('notificaciones.show',$notificacione->id) }}"><i class="fa fa-fw fa-eye"></i> Ver Notificacion</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@vite('resources/css/notificaciones.css')
@vite('resources/js/notificaciones.js')
@endsection