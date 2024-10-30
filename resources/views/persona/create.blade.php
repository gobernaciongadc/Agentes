@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Persona
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12 col-md-6">

            <div class="card card-default border">
                <div class="card-header bg-tr">
                    <span class="card-title">{{ __('Crear') }} Persona</span>
                    <div class="float-right">
                        <a href="{{ route('personas.index') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                            <i class="fa fa-chevron-left"></i> {{ __('Regresar') }}
                        </a>
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
@endsection