@extends('admin.layouts.master')

@section('template_title')
{{ $informeNotarial->name ?? __('Show') . " " . __('Informe Notarial') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Informe Notarial</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('informe-notarials.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Descripcion:</strong>
                        {{ $informeNotarial->descripcion }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $informeNotarial->estado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Fecha Envio:</strong>
                        {{ $informeNotarial->fecha_envio }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/informe.css')
@vite('resources/js/informe.js')
@endsection