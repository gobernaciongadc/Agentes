  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
          <ul id="sidebarnav">
              <li class="user-profile">
                  <a class="has-arrow waves-effect waves-dark mt-3" href="#" aria-expanded="false"><i class="fa fa-user" style="font-size: 1.2rem;"></i> <span class="hide-menu">

                          @if(Auth::user()->rol == 'Agente')
                          {{Auth::user()->agente->persona->nombres}} {{Auth::user()->agente->persona->apellidos}}
                          @endif

                          @if(Auth::user()->rol == 'Administrador')
                          {{Auth::user()->persona->nombres}} {{Auth::user()->persona->apellidos}}
                          @endif

                      </span>
                  </a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{ route('admin.perfilusuario', Auth::user()->id) }}">Mi Perfil </a></li>
                      <li><a href="{{ route('admin.viewpassword') }}">Configuración de cuenta</a></li>
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
              </li>
              <li class="nav-devider"></li>
              <li class="nav-small-cap">MENU PRINCIPAL</li>

              @role('Agente')

              @if(Auth::user()->agente->tipo_agente == "Notarios de Fe Pública")
              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Notarial<span
                              class="label label-rouded label-themecolor pull-right">4</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-notarials.index','Notarios de Fe Pública')}}">Información Notarial</a></li>
                      <li><a href="{{ route('notificaciones.index')}}">Notificaciones</a></li>
                      <li><a href="{{ route('comunicados.index')}}">Comunicados</a></li>
                      <li><a href="{{ route('sanciones.index')}}">Sanciones</a></li>
                  </ul>
              </li>
              @endif

              @if(Auth::user()->agente->tipo_agente == "SEPREC")
              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión SEPREC<span
                              class="label label-rouded label-themecolor pull-right">4</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-index-seprec.indexSeprec')}}">Información SEPREC</a></li>
                      <li><a href="{{ route('notificaciones.index')}}">Notificaciones</a></li>
                      <li><a href="{{ route('comunicados.index')}}">Comunicados</a></li>
                      <li><a href="{{ route('sanciones.index')}}">Sanciones</a></li>
                  </ul>
              </li>
              @endif

              @if(Auth::user()->agente->tipo_agente == "Jueces y Secretarios del Tribunal Departamental de Justicia")
              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Juzgados<span
                              class="label label-rouded label-themecolor pull-right">4</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-index-juzgado.indexJuzgado')}}">Información Juzgados</a></li>
                      <li><a href="{{ route('notificaciones.index')}}">Notificaciones</a></li>
                      <li><a href="{{ route('comunicados.index')}}">Comunicados</a></li>
                      <li><a href="{{ route('sanciones.index')}}">Sanciones</a></li>
                  </ul>
              </li>
              @endif

              @if(Auth::user()->agente->tipo_agente == "Derechos Reales")
              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Derechos<span
                              class="label label-rouded label-themecolor pull-right">4</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-index-derecho.indexDerecho')}}">Información Derechos</a></li>
                      <li><a href="{{ route('notificaciones.index')}}">Notificaciones</a></li>
                      <li><a href="{{ route('comunicados.index')}}">Comunicados</a></li>
                      <li><a href="{{ route('sanciones.index')}}">Sanciones</a></li>
                  </ul>
              </li>
              @endif

              @endrole

              @role('Administrador')

              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-laptop"></i><span class="hide-menu">Dashboard<span
                              class="label label-rouded label-info pull-right">1</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('admin.layaouts.master')}}">Panel de Control</a></li>
                  </ul>
              </li>

              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Sancionador<span
                              class="label label-rouded label-success pull-right">4</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('sancions-bandeja-entrada.indexBandejaEntrada', ['id'=>'bandeja'])}}">Bandeja de Entrada</a></li>
                      <li><a href="{{ route('comunicados.index')}}">Comunicados</a></li>
                      <li><a href="{{ route('notificaciones.index')}}">Notificaciones</a></li>
                      <li><a href="{{ route('sanciones.index')}}">Sanciones</a></li>
                  </ul>
              </li>


              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-multiple"></i><span class="hide-menu">Reportes<span
                              class="label label-rouded label-warning pull-right">6</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{ route('reportes-transmision.reporteTransmision') }}">Tipo de Transmisión</a></li>
                      <!-- Los agentes son los usuarios -->
                      <li><a href="{{ route('reportes-agentes.reporteAgentes')}}">Reporte Por Agentes</a></li>
                      <li><a href="{{ route('reportes-municipio.reporteMunicipio')}}">Reporte Por Municipio</a></li>
                      <li><a href="{{ route('reportes-plazos.reportePlazos')}}">Reporte Por Plazos</a></li>
                      <li><a href="{{ route('reportes-sanciones.reporteSanciones')}}">Reporte Por Sanciones</a></li>
                  </ul>
              </li>


              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Configuraciónes<span
                              class="label label-rouded label-danger pull-right">4</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('personas.index')}}">Personas</a></li>
                      <li><a href="{{route('municipios.index')}}">Municipios</a></li>
                      <li><a href="{{route('agentes.index')}}">Agentes</a></li>
                      <li><a href="{{route('users.index')}}">Usuarios</a></li>
                  </ul>
              </li>


              @endrole

          </ul>
      </nav>
      <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->