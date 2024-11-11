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

                                    <th>Nombre</th>
                                    <th>Provincia</th>
                                    <th>Estado</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($municipios as $municipio)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $municipio->nombre }}</td>
                                    <td>{{ $municipio->provincia }}</td>
                                    <td>{{ $municipio->estado }}</td>

                                    <td>
                                        <form action="{{ route('municipios.destroy', $municipio->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('municipios.show', $municipio->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('municipios.edit', $municipio->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
            {!! $municipios->withQueryString()->links() !!}
        </div>
    </div>
</div>

@vite('resources/css/municipio.css')
@vite('resources/js/municipio.js')
@endsection