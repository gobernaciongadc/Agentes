@extends('admin.layouts.master')

@section('template_title')
Comunicados
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card border">
            <div class="card-header card-bg">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title" class="titulo-card">
                        Lista de Comunicados
                    </span>

                    @if ($tipoAgente == 'Administrador')
                    <div class="float-right">
                        <a href="{{ route('comunicados.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                            <i class="fa fa-plus"></i> Crear Comunicado
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
                    <table id="comunicadosTable" class="table table-striped table-hover">
                        <thead class="thead small">
                            <tr>
                                <th>ID</th>

                                <th style="width: 15%;">Titulo</th>
                                <th style="width: 10%;">Fecha Emision</th>
                                <th>Destinatario</th>
                                <th>Asunto</th>
                                <th style="width: 25%;">Mensaje</th>
                                <th style="width: 10%;">Adjuntos</th>

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
                            @foreach ($comunicados as $comunicado)
                            <tr>
                                <td>{{ $comunicado->id }}</td>

                                <td>{{ $comunicado->titulo }}</td>
                                <td>{{ $comunicado->fecha_emision }}</td>
                                <td>{{ $comunicado->destinatario }}</td>
                                <td>{{ $comunicado->asunto }}</td>
                                <td>{{ $comunicado->cuerpo_mensaje }}</td>
                                <td>
                                    @php
                                    $rutaArchivo = 'comunicados/' . basename($comunicado->adjuntos);
                                    @endphp

                                    @if ($comunicado->adjuntos && Storage::disk('public')->exists($rutaArchivo))
                                    <a href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank">
                                        <i class="fa fa-file"></i> Ver Archivo
                                    </a>
                                    @else
                                    <span>Sin archivo</span>
                                    @endif
                                </td>

                                @if ($tipoAgente == 'Administrador')
                                <td>
                                    <span class="badge badge-success">Comunicado enviado</span>
                                </td>
                                @endif

                                @if ($tipoAgente == 'Agente')

                                @if ($comunicado->estado_vista == 'Revizado')
                                <td>
                                    <span class="badge badge-success">Revizado</span>
                                </td>
                                @else
                                <td>
                                    <span class="badge badge-danger">No Revizado</span>
                                </td>
                                @endif

                                <td>
                                    <a class="btn btn-sm btn-primary " href="{{ route('comunicados.show',$comunicado->id) }}"><i class="fa fa-fw fa-eye"></i> Ver Comunicado</a>
                                </td>
                                @endif



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@vite('resources/css/comunicados.css')
@vite('resources/js/comunicados.js')
@endsection