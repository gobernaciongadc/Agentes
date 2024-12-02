@extends('admin.layouts.master')

@section('template_title')
Sentencias Judiciales
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <a href="{{ route('sentencias-judiciales.create') }}" class="btn btn-primary font-14 float-right" data-placement="left">
            <i class="fa fa-plus"></i> Crear Nuevo Registro
        </a>
        <a href="{{ route('informe-index-juzgado.indexJuzgado') }}" class="btn btn-danger font-14 float-left" data-placement="left">
            <i class="fa fa-chevron-left"></i> Regresar a Información de Juzgado
        </a>

        @if ($message = Session::get('success'))
        <div class="alert alert-success m-4">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="table-responsive">
            <table id="sentenciasJudicialesTable" class="table table-striped table-hover">
                <thead class="thead small bg-cabecera">
                    <tr>
                        <th>No</th>
                        <th>Nombre Secretario</th>
                        <th>Número Juzgado</th>
                        <th>Municipio Jurisdicción</th>
                        <th>Naturaleza Proceso</th>
                        <th>Número Resolución</th>
                        <th>Fecha Resolución</th>
                        <th>Nombre Demandante</th>
                        <th>Cédula Demandante</th>
                        <th>Nombre Demandado</th>
                        <th>Cédula Demandado</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach ($sentenciasJudiciales as $sentenciasJudiciale)
                    <tr>
                        <td>{{ ++$i }}</td>

                        <td>{{ $sentenciasJudiciale->nombre_secretario }}</td>
                        <td>{{ $sentenciasJudiciale->numero_juzgado }}</td>
                        <td>{{ $sentenciasJudiciale->municipio_jurisdiccion }}</td>
                        <td>{{ $sentenciasJudiciale->naturaleza_proceso }}</td>
                        <td>{{ $sentenciasJudiciale->numero_resolucion }}</td>
                        <td>{{ $sentenciasJudiciale->fecha_resolucion }}</td>
                        <td>{{ $sentenciasJudiciale->nombre_demandante }}</td>
                        <td>{{ $sentenciasJudiciale->cedula_demandante }}</td>
                        <td>{{ $sentenciasJudiciale->nombre_demandado }}</td>
                        <td>{{ $sentenciasJudiciale->cedula_demandado }}</td>

                        <td>
                            <form action="{{ route('sentencias-judiciales.destroy', $sentenciasJudiciale->id) }}" method="POST">
                                <a class="btn btn-sm btn-primary " href="{{ route('sentencias-judiciales.show', $sentenciasJudiciale->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                <a class="btn btn-sm btn-success" href="{{ route('sentencias-judiciales.edit', $sentenciasJudiciale->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
@vite('resources/css/juzgado.css')
@vite('resources/js/juzgado.js')
@endsection