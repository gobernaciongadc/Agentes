<div class="row padding-1 p-1">
    <div class="col-12 col-md-8 col-lg-4">

        @if ($respaldoUrl==false)
        <!-- Campo para seleccionar el rol -->
        <div class="form-group mb-3">
            <label for="rol" class="form-label">Rol de acceso<span class="text-danger">*</span></label>
            <select name="rol" class="form-control" id="rol">
                <option value="" disabled selected>Selecciona un rol de acceso</option>
                @foreach($roles as $rol)
                <option value="{{ $rol }}" {{ old('rol') == $rol ? 'selected' : '' }}>
                    {{ $rol }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Campo dinámico para seleccionar persona -->
        <div class="form-group mb-3">
            <label for="persona" class="form-label">Nombre<span class="text-danger">*</span></label><br>
            <select name="opcion_id" class="form-control" id="persona"></select>
        </div>
        <script>
            // Dinamico select para administradores y agentes de información
            document.addEventListener('DOMContentLoaded', () => {

                // Evento al cambiar el rol
                $('#rol').on('change', function() {
                    const rol = $(this).val(); // Obtiene el valor seleccionado
                    $('#persona').empty(); // Limpia el select de personas

                    console.log(rol);


                    if (rol === 'Administrador') {

                        // Hace una llamada AJAX para obtener los datos
                        $.ajax({
                            url: "{{route('admin.listpersonas')}}", // Reemplaza con la URL correcta de tu controlador
                            type: "GET", // Puedes cambiar a GET si es más apropiado
                            success: function(data) {
                                console.log(data); // Mensaje de depuración
                                // Rellena el select con los resultados
                                $('#persona').append('<option></option>'); // Opción vacía
                                data.listpersonas.forEach(persona => {
                                    $('#persona').append(
                                        `<option value="${persona.id}">${persona.nombres} ${persona.apellidos}</option>`
                                    );
                                });

                                // Reinicia Select2 para que detecte los nuevos elementos
                                $('#persona').select2({
                                    placeholder: 'Selecciona una opción',
                                    allowClear: true,
                                });

                            },
                            error: function() {
                                alert('Error al cargar las personas.');
                            },
                        });
                    }

                    if (rol === 'Agente') {

                        // Hace una llamada AJAX para obtener los datos
                        $.ajax({
                            url: "{{route('admin.listagentes')}}", // Reemplaza con la URL correcta de tu controlador
                            type: "GET", // Puedes cambiar a GET si es más apropiado
                            success: function(data) {
                                console.log(data); // Mensaje de depuración
                                // Rellena el select con los resultados
                                $('#persona').append('<option></option>'); // Opción vacía
                                data.listagentes.forEach(agente => {
                                    $('#persona').append(
                                        `<option value="${agente.id}">${agente.persona.nombres} ${agente.persona.apellidos}</option>`
                                    );
                                });

                                // Reinicia Select2 para que detecte los nuevos elementos
                                $('#persona').select2({
                                    placeholder: 'Selecciona una opción',
                                    allowClear: true,
                                });

                            },
                            error: function() {
                                alert('Error al cargar las personas.');
                            },
                        });

                    }
                });

                // Evento al seleccionar una persona
                $('#persona').on('change', function() {

                    const selectedOption = $(this).find(':selected'); // Opción seleccionada
                    const nombres = selectedOption[0].innerText // Inés Mendoza
                    if (nombres) {
                        // Separar el nombre completo en un array de palabras
                        const nombresArray = nombres.trim().split(/\s+/); // Divide por espacios y elimina espacios extra

                        // Tomar el primer nombre
                        const nombre = nombresArray[0].toLowerCase();

                        // Tomar el primer apellido (segunda palabra si existe, para evitar espacios)
                        const apellido = nombresArray.length > 1 ? nombresArray[1].toLowerCase() : '';

                        // Generar el usuario y la contraseña
                        const usuario = `${nombre}.${apellido}`.replace(/\s+/g, ''); // Elimina espacios adicionales
                        const password = generarPassword(); // Función para generar una contraseña

                        // Actualizar los campos
                        $('#email').val(usuario);
                        $('#password').val(password);
                    }
                });

                // Función para generar una contraseña aleatoria
                function generarPassword() {
                    const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$';
                    let password = '';
                    for (let i = 0; i < 8; i++) {
                        const randomIndex = Math.floor(Math.random() * caracteres.length);
                        password += caracteres[randomIndex];
                    }
                    return password;
                }

            });
        </script>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Usuario<span class="text-danger">*</span></label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user?->email) }}" id="email" placeholder="Ingrese el usuario">

        </div>

        <div class="form-group mb-3">
            <label for="password" class=" col-form-label">Contraseña<span class="text-danger">*</span></label>
            <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ingrese la Contraseña">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        @endif


        @if ($respaldoUrl)


        <div class="form-group mb-2 mb20">
            <label>Rol de acceso<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="{{ $user->rol }}" readonly>
        </div>

        <div class="form-group mb-2 mb20">
            <label>Nombre<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="{{ $user->agente->persona->nombres }} {{ $user->agente->persona->apellidos }}" readonly>

        </div>

        <div class="form-group mb-2 mb20">
            <label>Usuario<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
        </div>

        <div class="form-group  mb-2 mb20">
            <label for="estado" class="form-label">Estado<span class="text-danger">*</span></label>
            <select name="estado" class="form-control @error('estado') is-invalid @enderror mb-2 mb20" id="estado">
                <option value="" disabled selected>Selecciona un estado</option>
                @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ old('estado', $user?->estado) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
                @endforeach
            </select>
            @error('estado')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Guardar</button>
    </div>
</div>