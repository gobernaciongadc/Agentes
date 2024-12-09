@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Municipio
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Modificar Municipio</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('municipios.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('municipios.update', $municipio->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('municipio.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/municipio.css')
@vite('resources/js/municipio.js')
@endsection