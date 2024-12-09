@extends('admin.layouts.master')

@section('template_title')
Sancions
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

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

        <div class="table-responsive">
            <table id="bandejaTable" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th style="width: 20%">Descripción de Informe</th>
                        <th>Agente</th>
                        <th>Tipo Agente</th>
                        <th>Fecha Emitida</th>
                        <th>Estado Recibido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($informes as $informe)

                    <tr>
                        <td>{{$informe->id}}</td>
                        <td>{{$informe->descripcion}}</td>
                        <td>{{$informe->user->agente->persona->nombres}} {{$informe->user->agente->persona->apellidos}}</td>
                        <td>{{$informe->user->agente->tipo_agente}}</td>
                        <td>{{$informe->fecha_envio}}</td>
                        <td>
                            @switch($informe->estado)

                            @case('Pendiente')
                            <span class="badge badge-warning">{{ $informe->estado }}</span>
                            @break

                            @case('No verificado')
                            <span class="badge badge-danger">{{ $informe->estado }}</span>
                            @break
                            @case('Verificado')
                            <span class="badge badge-success">{{ $informe->estado }}</span>
                            @break
                            @case('Rechazado')
                            <span class="badge badge-purple">{{ $informe->estado }}</span>
                            @break
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('sancions-verificar.indexVerificar', ['id' => $informe->id, 'idUser' => $informe->usuario_id]) }}" class="btn btn-info btn-sm"><i class="fa fa-eye" title="Ver Informe"></i> Verificar</a>
                            <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-search" title="Observar Informe"></i> Observación</button>
                            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" title="Consolidar Informe"></i> Consolidar</button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-money" title="Sancionar Informe"></i> Sancionar</button>
                        </td>


                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

@vite('resources/css/sancion.css')
@vite('resources/js/sancion.js')
@endsection