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

                    <div class="float-right">
                        <a href="{{ route('comunicados.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                            <i class="fa fa-plus"></i> Crear Comunicado
                        </a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
            <div class="alert alert-success m-4">
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table id="comunicadosTable" class="table table-striped table-hover">
                        <thead class="thead small">
                            <tr>
                                <th>ID</th>

                                <th>Titulo</th>
                                <th>Fecha Emision</th>
                                <th>Destinatario</th>
                                <th>Asunto</th>
                                <th>Cuerpo Mensaje</th>
                                <th>Adjuntos</th>

                                <th>Estado</th>
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
                                <td>{{ $comunicado->adjuntos }}</td>

                                <td>
                                    <span class="badge badge-success">Comunicado enviado</span>
                                </td>
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