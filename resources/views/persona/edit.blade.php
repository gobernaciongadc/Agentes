@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Persona
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Persona</span>
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