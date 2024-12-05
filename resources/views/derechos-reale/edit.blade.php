@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Derechos Reale
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header">

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Modificar Datos de Registro</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('derechos-reales.index', ['id'=>$idInforme]) }}"><i class="fa fa-chevron-left"></i> Regresar a Getion de Derechos Reales</a>
                        </div>
                    </div>

                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('derechos-reales.update', [ 'id'=>$derechosReale->id,'idInforme'=>$idInforme]) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
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