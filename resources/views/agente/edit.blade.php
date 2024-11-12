@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Agente
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Agente</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('agentes.update', $agente->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('agente.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@vite('resources/css/agente.css')
@vite('resources/js/agente.js')
@endsection