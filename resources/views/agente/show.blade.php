@extends('admin.layouts.master')

@section('template_title')
{{ $agente->name ?? __('Show') . " " . __('Agente') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Agente</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('agentes.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Persona Id:</strong>
                        {{ $agente->persona_id }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Municipio Id:</strong>
                        {{ $agente->municipio_id }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Tipo Agente:</strong>
                        {{ $agente->tipo_agente }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Respaldo:</strong>
                        {{ $agente->respaldo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $agente->estado }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/agente.css')
@vite('resources/js/agente.js')
@endsection