@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Empresa
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Empresa</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('empresas.update', $empresa->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('empresa.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/empresa.css')
@vite('resources/js/empresa.js')
@endsection