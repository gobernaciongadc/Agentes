<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor text-uppercase font-18">{{ $titulo }}</h3>
        </div>


        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ Auth::check() ? url('/admin/layouts/master') : route('login') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active">{{ $currentPage }}</li>
            </ol>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Start Page Content- Contenido Principal InnovaDevCode -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card card-borde">
                <div class="card-body">
                    @if ($showPanel ?? false)
                    @include('admin.layouts.panel-control')
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->