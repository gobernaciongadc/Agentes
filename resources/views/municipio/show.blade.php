@extends('admin.layouts.master')

@section('template_title')
{{ $municipio->name ?? __('Show') . " " . __('Municipio') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border">
                <div class="card-header card-bg" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="titulo-card">Datos municipio {{$municipio->nombre}}</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info font-14" href="{{ route('municipios.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Municipio:</strong>
                        {{ $municipio->nombre }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Provincia:</strong>
                        {{ $municipio->provincia }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $municipio->estado == 1 ? 'Activo' : 'No Activo' }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/municipio.css')
@vite('resources/js/municipio.js')
@endsection