@extends('admin.layouts.master')

@section('template_title')
Users
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="titulo-card" class="titulo-card">
                            Gestión de Usuarios
                        </span>

                        <div class="float-right">
                            <a href="{{ route('users.create') }}" class="btn btn-info float-right font-14" data-placement="left">
                                <i class="fa fa-plus"></i> Crear nuevo usuario
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

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="usuariosTable" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Estado</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if($user->agente_id == null)
                                        {{$user->persona->nombres}} {{$user->persona->apellidos}}
                                        @endif

                                        @if($user->persona_id == null)
                                        {{$user->agente->persona->nombres}} {{$user->agente->persona->apellidos}}
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->rol }}</td>
                                    <td>{{ $user->estado == 1 ? 'Activo' : 'Inactivo' }}</td>

                                    <td style="width: 10%;">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('users.show', $user->id) }}"><i class="fa fa-fw fa-eye" title="Ver datos"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-fw fa-edit" title="Modificar datos"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;" title="Dar de baja a usuario"><i class="fa fa-fw fa-trash"></i></button>
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

@vite('resources/css/usuarios.css')
@vite('resources/js/usuarios.js')
@endsection