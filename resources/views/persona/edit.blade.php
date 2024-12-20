@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Persona
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Modificar Datos de Persona</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('personas.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('personas.update', $persona->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('persona.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/persona.css')
@vite('resources/js/persona.js')
@endsection