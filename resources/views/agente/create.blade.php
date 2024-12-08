@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Agente
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Formulario de Agente de Información</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('personas.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <!-- Mensaje de error global -->
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('agentes.store') }}" role="form" enctype="multipart/form-data">
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