@extends('admin.layouts.master')

@section('template_title')
Sancions
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        @if ($message = Session::get('success'))
        <div class="alert alert-success m-4">
            <p>{{ $message }}</p>
        </div>
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
                        <td>Pendiente</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-chevron-down" title="Recibir Informe"></i> Recibir</button>
                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye" title="Ver Informe"></i> Verificar</button>
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