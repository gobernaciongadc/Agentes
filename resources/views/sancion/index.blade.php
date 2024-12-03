@extends('admin.layouts.master')

@section('template_title')
Sancions
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Sancions') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('sancions.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
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

                                    <th>Tipo Sancion</th>
                                    <th>Motivo</th>
                                    <th>Feha Inposicion</th>
                                    <th>Monto</th>
                                    <th>Estado Recibido</th>
                                    <th>Informe Id</th>
                                    <th>Usuario Id</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sancions as $sancion)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $sancion->tipo_sancion }}</td>
                                    <td>{{ $sancion->motivo }}</td>
                                    <td>{{ $sancion->feha_inposicion }}</td>
                                    <td>{{ $sancion->monto }}</td>
                                    <td>{{ $sancion->estado_recibido }}</td>
                                    <td>{{ $sancion->informe_id }}</td>
                                    <td>{{ $sancion->usuario_id }}</td>

                                    <td>
                                        <form action="{{ route('sancions.destroy', $sancion->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('sancions.show', $sancion->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('sancions.edit', $sancion->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
        </div>
    </div>
</div>
@vite('resources/css/sancion.css')
@vite('resources/js/sancion.js')
@endsection