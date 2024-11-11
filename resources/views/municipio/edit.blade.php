@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Municipio
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Municipio</span>
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