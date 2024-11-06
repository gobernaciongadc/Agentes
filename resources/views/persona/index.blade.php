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
                        <span id="card_title">{{ __('Lista de Personas') }}</span>
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
                        <table id="personasTable" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Carnet</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
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
    let tabla = $('#personasTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "bRetrive": true,
        "ordering": true,
        "order": [
            [0, "desc"]
        ],

        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('personas.index') }}",

    })
</script>
@endsection