@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Derechos Reale
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Formulario de Registro</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('derechos-reales.index') }}"><i class="fa fa-chevron-left"></i> Regresar a gestión de Informe de derechos reales</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('derechos-reales.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('derechos-reale.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/derechos.css')
@vite('resources/js/derechos.js')
@endsection