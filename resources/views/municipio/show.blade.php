@extends('admin.layouts.master')

@section('template_title')
{{ $municipio->name ?? __('Show') . " " . __('Municipio') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Municipio</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('municipios.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Nombre:</strong>
                        {{ $municipio->nombre }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Provincia:</strong>
                        {{ $municipio->provincia }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $municipio->estado }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/municipio.css')
@vite('resources/js/municipio.js')
@endsection