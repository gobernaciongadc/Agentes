@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Derechos Reale
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Derechos Reale</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('derechos-reales.update', $derechosReale->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('derechos-reale.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/derechos.css')
@vite('resources/js/derechos.js')
@endsection