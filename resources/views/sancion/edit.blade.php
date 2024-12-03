@extends('admin.layouts.master')

@section('template_title')
{{ __('Update') }} Sancion
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Sancion</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('sancions.update', $sancion->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('sancion.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@vite('resources/css/sancion.css')
@vite('resources/js/sancion.js')
@endsection