@extends('admin.layouts.master')

@section('template_title')
Municipios
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title" class="titulo-card">
                            Lista de Municipios
                        </span>

                        <div class="float-right">
                            <a href="{{ route('municipios.create') }}" class="btn btn-info float-right" data-placement="left">
                                <i class="fa fa-plus"></i> Crear Municipio
                            </a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                <div id="success-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div id="error-message" class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="municipioTable" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>

                                    <th>Municipio</th>
                                    <th>Provincia</th>
                                    <th>Estado</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($municipios as $municipio)
                                <tr>
                                    <td style="width: 20%;">{{ ++$municipio->id }}</td>

                                    <td style="width: 20%;">{{ $municipio->nombre }}</td>
                                    <td style="width: 20%;">{{ $municipio->provincia }}</td>
                                    <td style="width: 25%;"> {{ $municipio->estado == 1 ? 'Activo' : 'No Activo' }}</td>

                                    <td style="width: 15%;">
                                        <form id="delete-form-{{ $municipio->id }}" action="{{ route('municipios.destroy', $municipio->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary" href="{{ route('municipios.show', $municipio->id) }}" title="Ver Datos"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('municipios.edit', $municipio->id) }}" title="Modificar Datos"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $municipio->id }}')" title="Eliminar Datos"><i class="fa fa-fw fa-trash"></i></button>
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

@vite('resources/css/municipio.css')
@vite('resources/js/municipio.js')
@endsection

@section('scripts')
<script>
    $('#municipioTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
        }
    });
</script>
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