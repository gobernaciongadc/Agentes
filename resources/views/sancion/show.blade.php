@extends('admin.layouts.master')

@section('template_title')
{{ $sancion->name ?? __('Show') . " " . __('Sancion') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Sancion</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('sancions.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Tipo Sancion:</strong>
                        {{ $sancion->tipo_sancion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Motivo:</strong>
                        {{ $sancion->motivo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Feha Inposicion:</strong>
                        {{ $sancion->feha_inposicion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Monto:</strong>
                        {{ $sancion->monto }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado Recibido:</strong>
                        {{ $sancion->estado_recibido }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Informe Id:</strong>
                        {{ $sancion->informe_id }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Usuario Id:</strong>
                        {{ $sancion->usuario_id }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/sancion.css')
@vite('resources/js/sancion.js')
@endsection