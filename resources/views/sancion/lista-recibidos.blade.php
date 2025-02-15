@extends('admin.layouts.master')

@section('template_title')
Sancions
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        @if ($message = Session::get('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success("{{ $message }}", "Agentes de Información", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000,
                    positionClass: 'toast-top-right'
                });
            });
        </script>
        @endif

        <div class="row">

            <div class=" col-12 mb-3">
                <h2 class="text-uppercase">{{$lista}}</h2>
            </div>

            <a class="col-lg-3" href="{{route('sancions-bandeja-entrada.indexBandejaEntrada', ['id'=>'Derechos Reales'])}}">
                <div class="card border bg-info" style="border-radius: 5px;">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">Derechos Reales</h6>

                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a class="col-lg-3" href="{{route('sancions-bandeja-entrada.indexBandejaEntrada', ['id'=>'Jueces y Secretarios del Tribunal Departamental de Justicia'])}}">
                <div class="card border bg-success" style="border-radius: 5px;">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">Jueces y Secretarios</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a class="col-lg-3" href="{{route('sancions-bandeja-entrada.indexBandejaEntrada', ['id'=>'Notarios de Fe Pública'])}}">
                <div class="card border bg-primary" style="border-radius: 5px;">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">Notarios de Fe Pública</h6>

                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a class="col-lg-3" href="{{route('sancions-bandeja-entrada.indexBandejaEntrada', ['id'=>'SEPREC'])}}">
                <div class="card border bg-danger" style="border-radius: 5px;">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('backend/assets/images/icon/expense-w.png') }}" alt="Income"></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">SEPREC</h6>

                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>

        <div class="table-responsive">
            <table id="bandejaTable" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th style="width: 20%">Descripción de Informe</th>
                        <th>Agentes</th>
                        <th>Tipo Agente</th>
                        <th>Fecha Emitida</th>
                        <th>Estado Recibido</th>
                        <th>Estado Plazo</th>
                        <th style="width: 16%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($informes as $informe)

                    <tr>
                        <td>{{$informe->id}}</td>
                        <td>{{$informe->descripcion}}</td>
                        <td>{{$informe->user->agente->persona->nombres}} {{$informe->user->agente->persona->apellidos}}</td>
                        <td>{{$informe->user->agente->tipo_agente}}</td>
                        <td>{{$informe->fecha_envio}}</td>
                        <td>
                            @switch($informe->estado)

                            @case('Pendiente')
                            <span class="badge badge-warning">{{ $informe->estado }}</span>
                            @break

                            @case('No verificado')
                            <span class="badge badge-danger">{{ $informe->estado }}</span>
                            @break
                            @case('Verificado')
                            <span class="badge badge-success">{{ $informe->estado }}</span>
                            @break
                            @case('Rechazado')
                            <span class="badge badge-dark">{{ $informe->estado }}</span>
                            @break
                            @case('Corregido')
                            <span class="badge badge-primary">{{ $informe->estado }}</span>
                            @break
                            @endswitch
                        </td>

                        <td>

                            @if($informe->estado_sancion == 'Con sancion')

                            @if($informe->estado_plazo_sancion == 'Sin crear')
                            <!-- <span class="badge badge-danger">Con sancion {{ $informe->periodo_date }}</span> -->
                            <a href="{{ route('sanciones-crear.createSancion', ['idInforme' => $informe->id, 'idUserInforme' => $informe->usuario_id, 'tipo' => $informe->tipo_informe,'dias'=> $informe->dias_retrazo])}}" class="btn btn-danger btn-sm"><i class="fa fa-money"></i> Sancionar</a>
                            <p>Dias con retraso: <span class="text-danger">{{$informe->dias_retrazo}}</span></p>
                            @endif

                            @if($informe->estado_plazo_sancion == 'creado')
                            <span class="badge badge-info">Sancion creada</span>
                            <p>Con dias de retraso: <span class="text-danger">{{$informe->dias_retrazo}}</span></p>
                            @endif

                            @if($informe->estado_plazo_sancion == 'enviado')
                            <span class="badge badge-success">Sancion enviada</span>
                            <p>Con dias de retraso: <span class="text-danger">{{$informe->dias_retrazo}}</span></p>
                            @endif

                            @else
                            <span class="badge badge-success">Sin sancion</span>
                            @endif
                        </td>

                        <td>
                            @if ($informe->estado == 'No verificado')
                            <a href="{{ route('sancions-verificar.indexVerificar', ['idInforme' => $informe->id, 'idUser' => $informe->usuario_id, 'tipo' => $informe->tipo_informe]) }}" class="btn btn-info btn-sm" title="Ver Informe"><i class=" fa fa-eye"></i> Verificar</a>
                            @endif
                            @if ($informe->estado == 'Verificado')
                            <a href="{{ route('sancions-verificar.indexVerificar', ['idInforme' => $informe->id, 'idUser' => $informe->usuario_id, 'tipo' => $informe->tipo_informe]) }}" class="btn btn-primary btn-sm" title="Ver Informe">Ver informe <i class=" fa fa-chevron-right"></i></a>
                            @endif

                            @if ($informe->estado == 'Rechazado')
                            <a onclick="openModalObservar('{{$informe->id}}','{{$informe->usuario_id}}','{{$informe->tipo_informe}}')" class="btn btn-warning text-white btn-sm" title="Ver observaciones"><i class=" fa fa-eye"></i> Con Observaciones</a>
                            <a href="{{ route('sancions-verificar.indexVerificar', ['idInforme' => $informe->id, 'idUser' => $informe->usuario_id, 'tipo' => $informe->tipo_informe]) }}" class="btn btn-primary btn-sm" title="Ver Informe">Ver informe <i class=" fa fa-chevron-right"></i></a>
                            @endif

                            @if ($informe->estado == 'Corregido')
                            <a onclick="openModalObservar('{{$informe->id}}','{{$informe->usuario_id}}','{{$informe->tipo_informe}}')" class="btn btn-warning text-white btn-sm" title="Ver observaciones"><i class=" fa fa-eye"></i> Con Observaciones</a>
                            <a href="{{ route('sancions-verificar.indexVerificar', ['idInforme' => $informe->id, 'idUser' => $informe->usuario_id, 'tipo' => $informe->tipo_informe]) }}" class="btn btn-primary btn-sm" title="Ver Informe">Ver informe <i class=" fa fa-chevron-right"></i></a>
                            @endif


                        </td>


                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Lista de observaciones por informe -->
<div class="row">
    <div class="col-md-4">
        <!-- sample modal content -->
        <div id="observacion-informe-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1200px !important;">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <span class="text-dark">Lista de Observaciones a Informe</span>
                        <button type="button" class="close" onclick="closeModalObservar()" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped table-bordered">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th style="width: 40%;">Observación</th>
                                    <th>Fecha Observación</th>
                                    <!-- <th>Ver Archivo</th> -->
                                </tr>

                            </thead>
                            <tbody id="tbody-observacion-informe">

                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" onclick="closeModalObservar()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Fin Modal -->

<script>
    // Abrir modal
    function openModalObservar(IdInforme, IdUser, TipoInforme) {
        $('#observacion-informe-modal').modal('show');
        console.log(IdInforme, IdUser, TipoInforme);

        const tbody = document.getElementById('tbody-observacion-informe');
        tbody.innerHTML = '';
        const data = {
            informe_id: IdInforme,
            user_id: IdUser,
            tipo_informacion: TipoInforme,
            _token: '{{ csrf_token() }}'
        };

        // Extraer la lista de observaciones del informe en especifico
        $.ajax({
            url: '{{ route("sancions-index-observacion.indexObservacion") }}',
            method: 'POST',
            data: data,
            success: function(response) {

                console.log(response);
                const {
                    observacion
                } = response

                observacion.forEach(element => {
                    // Convertir la fecha al formato deseado
                    const createdAt = new Date(element.created_at);
                    const formattedDate = createdAt.toLocaleDateString('es-ES', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    tbody.innerHTML += `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.descripcion}</td>
                            <td>${formattedDate}</td>
                        </tr>
                    `;
                });

            },
            error: function(response) {

                toastr.error('Ocurrio un error al obtener la lista de observaciones', 'Agentes de Información');
            }
        });
    }

    // Cerrar modal
    function closeModalObservar() {
        $('#observacion-informe-modal').modal('hide');
    }
</script>

@vite('resources/css/sancion.css')
@vite('resources/js/sancion.js')
@endsection

<!-- <td><a href="{{ url('/observaciones') }}/${element.archivo_observacion}" target="_blank" class="btn btn-twitter btn-sm"><i class="fa fa-file"></i> Ver Archivo</a></td> -->