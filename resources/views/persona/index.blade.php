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
                            <a href="{{ route('personas.create') }}" class="btn btn-info font-14 float-right" data-placement="left">
                                <i class="fa fa-plus"></i> Crear Persona
                            </a>
                        </div>
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
                                    <th>ID</th>

                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Carnet</th>
                                    <th>Correo Electronico</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
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

                                    <td>{{ $persona->estado }}</td>

                                    <td style="width: 10%;">
                                        <form id="delete-form-{{ $persona->id }}" action="{{ route('personas.destroy', $persona->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('personas.show', $persona->id) }}" title="Ver Datos"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('personas.edit', $persona->id) }}" title="Modificar Datos"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $persona->id }}')" title="Eliminar Datos">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
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
    function confirmDelete(id) {
        swal({
            title: "Esta seguro?",
            text: "No podrás revertir esto!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminar esto!",
            closeOnConfirm: false
        }, function() {
            // Enviar el formulario para eliminar
            document.getElementById('delete-form-' + id).submit();
            swal("Eliminado!", "El registro ha sido eliminado.", "success");
        });
    }
</script>
@endsection