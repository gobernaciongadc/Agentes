@extends('admin.layouts.master')

@section('template_title')
Verificar Datos de sanciones
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-bg border">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="titulo-card">Datos de Sanción</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info font-14" href="{{ route('sanciones.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div style="width: 50%;">
                        <?php

                        use App\Models\User;

                        $usuario = User::with('agente.persona')->where('id', $sancion->agente_id)->first();

                        ?>

                        <div class="form-group mb-2 mb20">
                            <strong class="text-dark">Agente Sancionado:</strong>
                            {{ $usuario->agente->persona->nombres }} {{ $usuario->agente->persona->apellidos }}
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong class="text-dark">Tipo Sanción:</strong>
                            {{ $sancion->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong class="text-dark">Monto (UFV):</strong>
                            {{ $sancion->monto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong class="text-dark">Estado Pago:</strong>
                            {{ $sancion->estado }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/sanciones.css')
@vite('resources/js/sanciones.js')
@endsection