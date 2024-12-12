@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Comunicado
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Comunicado</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('comunicados.update', $comunicado->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('comunicado.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/comunicados.css')
@vite('resources/js/comunicados.js')
@endsection