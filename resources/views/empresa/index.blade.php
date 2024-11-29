@extends('admin.layouts.master')

@section('template_title')
Empresas
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <a href="{{ route('empresas.create') }}" class="btn btn-primary font-14 float-left" data-placement="left">
            <i class="fa fa-plus"></i> Crear Nuevo Registro
        </a>
        <a href="{{ route('informe-index-seprec.indexSeprec') }}" class="btn btn-danger font-14 float-right" data-placement="left">
            <i class="fa fa-chevron-left"></i> Regresar a Información CEPREC
        </a>

        @if ($message = Session::get('success'))
        <div class="alert alert-success m-4">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover" id="empresasTable">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>No</th>

                        <th>Nombre Representante SEPREC</th>
                        <th>Nombre Razón Social</th>
                        <th>Número Matricula Comercio</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Actividad</th>
                        <th>Nombre Representante Legal</th>
                        <th>Número Cedula Identidad</th>
                        <th>Base Empresarial Empresas Activas</th>
                        <th>Transferencia Cuotas Capital</th>
                        <th>Transferencia Empresa Unipersonal</th>
                        <!-- <th>Informe Id</th>
                        <th>Usuario Id</th> -->

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ ++$i }}</td>

                        <td>{{ $empresa->nombre_representante_seprec }}</td>
                        <td>{{ $empresa->nombre_razon_social }}</td>
                        <td>{{ $empresa->numero_matricula_comercio }}</td>
                        <td>{{ $empresa->direccion }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->actividad }}</td>
                        <td>{{ $empresa->nombre_representante_legal }}</td>
                        <td>{{ $empresa->numero_cedula_identidad }}</td>

                        <!-- Archivos -->
                        <td>{{ $empresa->base_empresarial_empresas_activas }}</td>
                        <td>{{ $empresa->transferencia_cuotas_capital }}</td>
                        <td>{{ $empresa->transferencia_empresa_unipersonal }}</td>
                        <!-- <td>{{ $empresa->informe_id }}</td>
                        <td>{{ $empresa->usuario_id }}</td> -->

                        <td>
                            <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                                <a class="btn btn-sm btn-primary " href="{{ route('empresas.show', $empresa->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                <a class="btn btn-sm btn-success" href="{{ route('empresas.edit', $empresa->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@vite('resources/css/empresa.css')
@vite('resources/js/empresa.js')
@endsection