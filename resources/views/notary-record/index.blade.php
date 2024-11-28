@extends('admin.layouts.master')

@section('template_title')
Notary Records
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Notary Records') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('notary-records.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
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

                                    <th>Municipio</th>
                                    <th>Numero Notaria</th>
                                    <th>Nombre Notaria</th>
                                    <th>Numero Escritura</th>
                                    <th>Fecha Escritura</th>
                                    <th>Naturaleza Escritura</th>
                                    <th>Nombre Cedente</th>
                                    <th>Ci Nit Cedente</th>
                                    <th>Nombre Beneficiario</th>
                                    <th>Ci Nit Beneficiario</th>
                                    <th>Tipo Bien</th>
                                    <th>Registro Bien</th>
                                    <th>Tipo Formulario</th>
                                    <th>Numero Orden</th>
                                    <th>Monto Pagado</th>
                                    <th>Observaciones</th>
                                    <th>Informe Id</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notaryRecords as $notaryRecord)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $notaryRecord->municipio }}</td>
                                    <td>{{ $notaryRecord->numero_notaria }}</td>
                                    <td>{{ $notaryRecord->nombre_notaria }}</td>
                                    <td>{{ $notaryRecord->numero_escritura }}</td>
                                    <td>{{ $notaryRecord->fecha_escritura }}</td>
                                    <td>{{ $notaryRecord->naturaleza_escritura }}</td>
                                    <td>{{ $notaryRecord->nombre_cedente }}</td>
                                    <td>{{ $notaryRecord->ci_nit_cedente }}</td>
                                    <td>{{ $notaryRecord->nombre_beneficiario }}</td>
                                    <td>{{ $notaryRecord->ci_nit_beneficiario }}</td>
                                    <td>{{ $notaryRecord->tipo_bien }}</td>
                                    <td>{{ $notaryRecord->registro_bien }}</td>
                                    <td>{{ $notaryRecord->tipo_formulario }}</td>
                                    <td>{{ $notaryRecord->numero_orden }}</td>
                                    <td>{{ $notaryRecord->monto_pagado }}</td>
                                    <td>{{ $notaryRecord->observaciones }}</td>
                                    <td>{{ $notaryRecord->informe_id }}</td>

                                    <td>
                                        <form action="{{ route('notary-records.destroy', $notaryRecord->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('notary-records.show', $notaryRecord->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('notary-records.edit', $notaryRecord->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
            {!! $notaryRecords->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection