@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Persona
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card  border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Crear Persona</span>
                        <div class="float-right">
                            <a href="{{ route('personas.index') }}" class="btn btn-info float-right" data-placement="left">
                                <i class="fa fa-chevron-left"></i> Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('personas.store') }}" role="form" enctype="multipart/form-data">
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