@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} User
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default border">

                <div class="card-header card-bg" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="titulo-card">Actualizar Datos de Usuario</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info font-14" href="{{ route('users.index') }}"><i class="fa fa-chevron-left"></i> Regresar</a>
                    </div>
                </div>

                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
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