@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Informe Notarial
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Informe Notarial</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('informe-notarials.update', $informeNotarial->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('informe-notarial.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/informe.css')
@vite('resources/js/informe.js')
@endsection