@extends('admin.layouts.master')

@section('template_title')
{{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
<secction class="container mt-5">
    <div class="card mx-auto shadow border" style="max-width: 400px;">
        <div class="card-header card-bg mb-3">
            <p class="titulo-card">Mi Perfil</p>
        </div>
        <div class="card-body text-center">

            <div class="mb-4">
                <i class="fa fa-user-circle text-primary" style="font-size: 5rem;"></i>
            </div>
            <h4 class="card-title font-weight-bold">

                @if($user->rol == 'Agente')
                {{Auth::user()->agente->persona->nombres}} {{Auth::user()->agente->persona->apellidos}}
                @endif

                @if($user->rol == 'Administrador')
                {{Auth::user()->persona->nombres}} {{Auth::user()->persona->apellidos}}
                @endif

            </h4>
            <p class="text-muted mb-2">Rol: <span class="font-weight-bold text-dark"> {{ $user->rol }}</span></p>
            <p class="text-muted mb-2">Usuario: <span class="font-weight-bold text-dark"> {{ $user->email }}</span></p>
            @if($user->rol == 'Agente')
            <p class="text-muted mb-2">Tipo de Agente: <span class="font-weight-bold text-dark">
                    {{Auth::user()->agente->tipo_agente}}
                </span></p>
            @endif

            <p class="text-muted">Estado: <span class="badge badge-success">{{ $user->estado == 1 ? 'Activo' : 'Inactivo' }}</span></p>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">Identificador: 1</small>
        </div>
    </div>
</secction>



@vite('resources/css/usuarios.css')
@vite('resources/js/usuarios.js')
@endsection