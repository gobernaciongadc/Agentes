@extends('admin.layouts.master')

@section('template_title')
{{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border">
                <div class="card-header card-bg" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="titulo-card">Datos de Usuario</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info" href="{{ route('users.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Identificador:</strong>
                        {{ $user->id }}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Completo:</strong>
                        {{ $user->agente->persona->nombres }} {{ $user->agente->persona->apellidos }}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <strong>Rol:</strong>
                        {{ $user->rol }}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <strong>Usuario:</strong>
                        {{ $user->email }}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $user->estado == 1 ? 'Activo' : 'Inactivo' }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/usuarios.css')
@vite('resources/js/usuarios.js')
@endsection