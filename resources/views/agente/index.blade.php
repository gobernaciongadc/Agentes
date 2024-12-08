@extends('admin.layouts.master')

@section('template_title')
Agentes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title" class="titulo-card">
                            Lista de Agentes
                        </span>

                        <div class="float-right">
                            <a href="{{ route('agentes.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                                <i class="fa fa-plus"></i> Crear Nuevo Agente
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
                        <table id="agentesTable" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>

                                    <th>Agente</th>
                                    <th>Municipio ó Jurisdicción</th>
                                    <th>Tipo Agente</th>
                                    <th>Respaldo</th>
                                    <th>Estado</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agentes as $agente)
                                <tr>
                                    <td>{{ $agente->id }}</td>

                                    <td>{{ $agente->persona->nombres }} {{$agente->persona->apellidos}}</td>
                                    <td>{{ $agente->municipio->nombre }} - {{ $agente->municipio->provincia }}</td>
                                    <td>{{ $agente->tipo_agente }}</td>
                                    <td>
                                        <a href="{{ asset('storage/respaldos/' . basename($agente->respaldo)) }}" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i> Ver PDF
                                        </a>
                                    </td>
                                    <td>{{ $agente->estado == 1 ? 'Activo' : 'Inactivo' }}</td>


                                    <td style="width: 10%;">
                                        <form action="{{ route('agentes.destroy', $agente->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('agentes.show', $agente->id) }}" title="Ver Datos"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('agentes.edit', $agente->id) }}" title="Modificar Datos"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;" title="Dar de baja agente"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
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
</div>

@vite('resources/css/agente.css')
@vite('resources/js/agente.js')
@endsection