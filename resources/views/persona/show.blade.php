@extends('admin.layouts.master')

@section('template_title')
{{ $persona->name ?? __('Show') . " " . __('Persona') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Datos') }} de la persona</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('personas.index') }}"><i class="fa fa-chevron-left"></i> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Nombres:</strong>
                        {{ $persona->nombres }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Apellidos:</strong>
                        {{ $persona->apellidos }}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <strong>Carnet:</strong>
                        {{ $persona->carnet }}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <strong>Correo Electronico:</strong>
                        {{ $persona->correo_electronico }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Telefono:</strong>
                        {{ $persona->telefono }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Direccion:</strong>
                        {{ $persona->direccion }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Estilos Para el el componente persona -->
@vite('resources/css/persona.css')
@vite('resources/js/persona.js')
@endsection