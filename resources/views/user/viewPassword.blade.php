@extends('admin.layouts.master')

@section('template_title')
{{ $user->name ?? "{{ __('Show') User" }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-bg">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            <span class="text-uppercase text-white">Cambiar contraseña</span>
                        </span>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4 changes-password p-3 mt-3">
                            <div class="form-group">
                                <label for="">Anterior contraseña</label>
                                <input type="text" class="form-control" id="current-password">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Nueva contraseña</label>
                                <input type="text" class="form-control" id="new-password">
                            </div>
                            <div class="btn-changes mt-3">
                                <button class="btn btn-info  w-100 btn-block text-uppercase" id="changes-password"> <i class="fa fa-key"></i> Cambiar contraseña</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {

                            const current_password = document.getElementById('current-password');
                            const new_password = document.getElementById('new-password');
                            const btn_changes_password = document.getElementById('changes-password');

                            btn_changes_password.addEventListener('click', () => {
                                $.ajax({
                                    type: 'POST',
                                    url: '{{ route("admin.changespassword") }}',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        current_password: current_password.value,
                                        new_password: new_password.value
                                    },
                                    beforeSend: function() {
                                        console.log('Enviando credenciales');
                                    },
                                    success: function(response) {
                                        const {
                                            status,
                                            message,
                                            errors
                                        } = response;


                                        switch (status) {
                                            case 'success':
                                                // La contraseña se cambió correctamente
                                                // Agrega una nueva solicitud AJAX para cerrar la sesión
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ route("logout") }}',
                                                    data: {
                                                        _token: '{{ csrf_token() }}'
                                                    },
                                                    success: function() {
                                                        // Espera 5 segundos antes de redirigir al usuario
                                                        setTimeout(function() {
                                                            window.location.href = '{{ route("login") }}';
                                                        }, 5000);
                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.log(error);
                                                    }
                                                });

                                                swal({
                                                    title: "La contraseña se cambió correctamente",
                                                    text: "Inicie sesión nuevamente",
                                                    type: "success",
                                                });
                                                break;
                                            case 'error':
                                                swal({
                                                    title: `${message}`,
                                                    text: "La contraseña anterior no es correcta.",
                                                    type: "warning",
                                                    confirmButtonColor: "#DD6B55",
                                                    closeOnConfirm: false
                                                });
                                                break;
                                            case 'validacion':

                                                swal({
                                                    title: `Datos no validos`,
                                                    text: `La nueva contraseña debe tener al menos 8 caracteres`,
                                                    type: "warning",
                                                    confirmButtonColor: "#DD6B55",
                                                    closeOnConfirm: false
                                                });
                                                break;
                                            default:
                                                break;
                                        }

                                    },
                                    error: function(xhr, status, error) {
                                        console.log(error);
                                    }
                                });
                            })
                        })
                    </script>

                </div>
                <div class="card-footer">
                    <p> <strong>Consejos para una contraseña fuerte:</strong><br><br>
                        <strong>1.-</strong> Utiliza una combinación de letras mayúsculas y minúsculas. <br>
                        <strong>2.-</strong> Incluye números y caracteres especiales. <br>
                        <strong>3.-</strong> Evita usar información personal fácilmente identificable. <br><br>

                        Agradecemos tu cooperación en este asunto y valoramos tu compromiso con la seguridad en línea. <br>
                        ¡Mantente seguro! <br><br>

                        Atentamente, <br>
                        Gobierno Autónomo Departamental de Cochabamba
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection