@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Comunicado
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Crear y Enviar Comunicado</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('comunicados.index') }}"><i class="fa fa-chevron-left"></i> Regresar a Lista de Comunicados</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('comunicados.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('comunicado.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/comunicados.css')
@vite('resources/js/comunicados.js')
@endsection