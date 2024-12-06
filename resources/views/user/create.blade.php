@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} User
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default border">
                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="titulo-card">Formulario de Usuarios</span>
                        <div class="float-right">
                            <a class="btn btn-info font-14" href="{{ route('users.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
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

                    <form method="POST" action="{{ route('users.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('user.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/usuarios.css')
@vite('resources/js/usuarios.js')
@endsection