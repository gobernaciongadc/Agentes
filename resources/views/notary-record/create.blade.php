@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Notary Record
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Formulario de Registro</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('municipios.index') }}"><i class="fa fa-chevron-left"></i> Regresar a gestión de Informe</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('notary-records.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('notary-record.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/notarial.css')
@vite('resources/js/notarial.js')
@endsection