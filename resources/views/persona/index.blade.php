@extends('admin.layouts.master')

@section('template_title')
Personas
@endsection

@section('content')
<div class="">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Lista de Personas') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('personas.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear persona') }}
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
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Carnet</th>
                                    <th>Correo Electronico</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personas as $persona)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $persona->nombres }}</td>
                                    <td>{{ $persona->apellidos }}</td>
                                    <td>{{ $persona->carnet }}</td>

                                    <td>{{ $persona->correo_electronico }}</td>
                                    <td>{{ $persona->telefono }}</td>
                                    <td>{{ $persona->direccion }}</td>

                                    <td>
                                        <form action="{{ route('personas.destroy', $persona->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('personas.show', $persona->id) }}" title="Ver datos"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('personas.edit', $persona->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;" title="Eliminar"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $personas->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection