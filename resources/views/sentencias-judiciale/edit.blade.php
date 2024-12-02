@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Sentencias Judiciale
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Sentencias Judiciale</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('sentencias-judiciales.update', $sentenciasJudiciale->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('sentencias-judiciale.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/juzgado.css')
@vite('resources/js/juzgado.js')
@endsection