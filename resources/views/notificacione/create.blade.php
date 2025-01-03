@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Notificacione
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Crear y Enviar Notificación</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('notificaciones.index') }}"><i class="fa fa-chevron-left"></i> Regresar a Lista de Notificaciones</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('notificaciones.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('notificacione.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/notificaciones.css')
@vite('resources/js/notificaciones.js')
@endsection