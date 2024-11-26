@extends('admin.layouts.master')

@section('template_title')
Personas
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title" class="titulo-card">
                            Lista de Personas
                        </span>

                        <div class="float-right">
                            <a href="{{ route('personas.create') }}" class="btn btn-info float-right" data-placement="left">
                                <i class="fa fa-plus"></i> Crear Persona
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="personasTable">
                            <thead class="thead">
                                <tr>
                                    <th>Identificador</th>

                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Carnet</th>
                                    <th>Correo Electronico</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personas as $persona)
                                <tr>
                                    <td>{{ $persona->id }}</td>
                                    <td>{{ $persona->nombres }}</td>
                                    <td>{{ $persona->apellidos }}</td>
                                    <td>{{ $persona->carnet }}</td>
                                    <td>{{ $persona->correo_electronico }}</td>
                                    <td>{{ $persona->telefono }}</td>
                                    <td>{{ $persona->direccion }}</td>

                                    <td>
                                        <form action="{{ route('personas.destroy', $persona->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('personas.show', $persona->id) }}" title="Ver Datos"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('personas.edit', $persona->id) }}" title="Modificar Datos"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Esta seguro de eliminar?') ? this.closest('form').submit() : false;" title="Eliminar Datos"><i class="fa fa-fw fa-trash"></i></button>
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


@vite('resources/css/persona.css')
@vite('resources/js/persona.js')

@endsection

@section('scripts')
<script>
    $('#personasTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
        }
    });
</script>
@endsection