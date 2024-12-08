@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Agente
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Modificar Datos de Agente de Información</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('agentes.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('agentes.update', $agente->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('agente.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/agente.css')
@vite('resources/js/agente.js')
@endsection