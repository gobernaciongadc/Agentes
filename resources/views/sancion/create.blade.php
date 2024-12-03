@extends('admin.layouts.master')

@section('template_title')
{{ __('Create') }} Sancion
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Create') }} Sancion</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('sancions.store') }}" role="form" enctype="multipart/form-data">
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