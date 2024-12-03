@extends('admin.layouts.master')

@section('template_title')
Sancions
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        @if ($message = Session::get('success'))
        <div class="alert alert-success m-4">
            <p>{{ $message }}</p>
        </div>
        @endif


        <div class="table-responsive">
            <table id="bandejaTable" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th style="width: 20%">Informe</th>
                        <th>agente_id</th>
                        <th>tipo_agente</th>
                        <th>feche emitida</th>
                        <th>Estado Recibido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>



                    <tr>
                        <td>1</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi modi error similique mollitia omnis dolores molestiae, repellat tempora, saepe ut minima ipsa at ratione rerum, odit eius recusandae officiis ad!</td>
                        <td>David salinas</td>
                        <td>Derechos Reales</td>
                        <td>13-12-2022</td>
                        <td>Pendiente</td>
                        <td><button class="btn btn-primary">Recibir informe</button></td>

                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>

@vite('resources/css/sancion.css')
@vite('resources/js/sancion.js')
@endsection