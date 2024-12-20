  <nav class="navbar top-navbar navbar-expand-md navbar-light">
      <!-- ============================================================== -->
      <!-- Logo -->
      <!-- ============================================================== -->
      <div class="navbar-header">
          <a class="navbar-brand" href="{{route('admin.layaouts.master')}}">
              <!-- Logo icon --><b>
                  <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                  <!-- Dark Logo icon -->
                  <!-- <img class="img-fluid logo-navbar" src="{{ asset('img/escudo.png') }}" alt="homepage" class="dark-logo" /> -->
                  <!-- Light Logo icon -->
                  <img class="img-fluid logo-navbar" src="{{ asset('img/escudo.png') }}" alt="homepage" class="light-logo" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text --><span class="font-weight-bold">
                  <!-- dark Logo text -->
                  <!-- <img class="img-fluid logo-navbar" src="{{ asset('img/escudo.png') }}" alt="homepage" class="dark-logo" /> -->
                  <!-- Light Logo text -->
                  <!-- <img class="img-fluid logo-navbar" src="{{ asset('img/escudo.png') }}" class="light-logo" alt="homepage" />
                  -->AGENTES
              </span>

          </a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav mr-auto">
              <!-- This is  -->
              <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                      href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
              <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark"
                      href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
              <li class="nav-item hidden-sm-down"></li>
          </ul>
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
          <ul class="navbar-nav my-lg-0">

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                      <div class="notify" id="point-notificacion"> <span class="heartbit"></span> <span class="point"></span> </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right mailbox animated fallInDown">
                      <ul>
                          <li>
                              <div class="drop-title">Notificaciones</div>
                          </li>
                          <li>
                              <div class="message-center">

                              </div>
                              <script>
                                  document.addEventListener('DOMContentLoaded', function() {
                                      const mensaje = document.querySelector('.message-center');

                                      // Punto de notificacion 
                                      const punto = document.querySelector('#point-notificacion');

                                      const baseUrl = "{{ url('/') }}"; // Base de la URL

                                      if (!mensaje) {
                                          console.error("Elemento '.message-center' no encontrado");
                                          return;
                                      }

                                      //   AdminController
                                      fetch("{{ route('notificacion-real.notificacionReal') }}", {
                                              method: "GET",
                                              headers: {
                                                  "Content-Type": "application/json"
                                              }
                                          })
                                          .then(response => {
                                              if (!response.ok) {
                                                  throw new Error('Error al obtener las notificaciones');
                                              }
                                              return response.json();
                                          })
                                          .then(data => {

                                              // Aqui llega las notificaciones


                                              let contenidoHTML = '';

                                              if (data.totalNotificaciones > 0 || data.totalSanciones > 0) {
                                                  punto.style.display = 'block';
                                              } else {
                                                  punto.style.display = 'none';
                                              }


                                              if (!data.notificaciones) {
                                                  console.warn("El servidor no devolvió 'notificaciones'");
                                                  return;
                                              }

                                              if (!data.sanciones) {
                                                  console.warn("El servidor no devolvió 'Sanciones'");
                                                  return;
                                              }

                                              data.notificaciones.forEach(element => {
                                                  contenidoHTML += `
                                                        <a href="${baseUrl}/notificaciones/show/${element.id}">
                                                        <div class="btn btn-danger btn-circle"><i class="ti-bell"></i></div>
                                                        <div class="mail-contnet">
                                                            <span class="mail-desc">
                                                                <p class="mb-0">Remitente: ${element.user.persona.nombres || 'Nombre no disponible'} ${element.user.persona.apellidos || 'Apellido no disponible'}</p>
                                                                <p>Asunto: ${element.asunto || 'Asunto no disponible'}</p>
                                                            </span>
                                                            <span class="time">${formatFechaHora(element.created_at) || 'Fecha no disponible'}</span>
                                                        </div>
                                                    </a>`;
                                              });

                                              // Armado de sanciones
                                              data.sanciones.forEach(element => {
                                                  contenidoHTML += `
                                                        <a href="${baseUrl}/notificaciones/show/${element.id}">
                                                       <div class="btn btn-warning btn-circle"><i class="ti-alert"></i></div>
                                                        <div class="mail-contnet">
                                                            <span class="mail-desc">
                                                                <p class="mb-0">Remitente: ${element.user.persona.nombres || 'Nombre no disponible'} ${element.user.persona.apellidos || 'Apellido no disponible'}</p>
                                                                <p>Asunto: Sanción por incumplimiento de deberes</p>
                                                            </span>
                                                            <span class="time">${formatFechaHora(element.created_at) || 'Fecha no disponible'}</span>
                                                        </div>
                                                    </a>`;
                                              });


                                              mensaje.innerHTML = contenidoHTML;
                                          })
                                          .catch(error => {
                                              console.error("Error al procesar las notificaciones:", error);
                                          });

                                      // Función para formatear la fecha y hora
                                      function formatFechaHora(fechaIso) {
                                          if (!fechaIso) return null;

                                          const fecha = new Date(fechaIso);
                                          const fechaFormateada = fecha.toLocaleDateString('es-ES'); // Ejemplo: 16/12/2024
                                          const horaFormateada = fecha.toLocaleTimeString('es-ES', {
                                              hour: '2-digit',
                                              minute: '2-digit',
                                              second: '2-digit'
                                          }); // Ejemplo: 14:59:15
                                          return `${fechaFormateada} ${horaFormateada}`;
                                      }
                                  });
                              </script>


                          </li>

                      </ul>
                  </div>
              </li>
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->



              <!-- ============================================================== -->
              <!-- Profile -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <img src="{{asset('backend/assets/images/users/usuario_dos.png')}}"
                          alt="user" class="profile-pic" /></a>
                  <div class="dropdown-menu dropdown-menu-right animated fall-in-down">
                      <ul class="dropdown-user">
                          <li>
                              <div class="dw-user-box">
                                  <div class="u-img">
                                      <img style="width:50px !important;" src="{{asset('backend/assets/images/users/usuario.png')}}" alt="user">
                                  </div>
                                  <div class="u-text">
                                      <h4>
                                          @if(Auth::user()->rol == 'Agente')
                                          {{Auth::user()->agente->persona->nombres}} {{Auth::user()->agente->persona->apellidos}}
                                          @endif

                                          @if(Auth::user()->rol == 'Administrador')
                                          {{Auth::user()->persona->nombres}} {{Auth::user()->persona->apellidos}}
                                          @endif

                                      </h4>
                                  </div>
                              </div>
                          </li>
                          <li role="separator" class="divider"></li>
                          <li><a href="{{ route('admin.perfilusuario', Auth::user()->id) }}"><i class="ti-user"></i> Mi Perfil</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="{{ route('admin.viewpassword') }}"><i class="ti-settings"></i> Configuración de la cuenta</a></li>
                          <li role="separator" class="divider"></li>
                          <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                  <i class="fa fa-power-off"></i> Salir del sistema
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </li>
                      </ul>
                  </div>
              </li>
          </ul>
      </div>
  </nav>