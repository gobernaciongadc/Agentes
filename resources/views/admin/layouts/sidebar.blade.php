  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
          <ul id="sidebarnav">
              <li class="user-profile">
                  <a class="has-arrow waves-effect waves-dark mt-3" href="#" aria-expanded="false"><i class="fa fa-user" style="font-size: 1.2rem;"></i> <span class="hide-menu">

                          @if(Auth::user()->rol == 'agente')
                          {{Auth::user()->agente->persona->nombres}}
                          @endif

                          @if(Auth::user()->rol == 'administrador')
                          {{Auth::user()->persona->nombres}}
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

              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Notarial<span
                              class="label label-rouded label-themecolor pull-right">2</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-notarials.index')}}">Información Notarial</a></li>
                      <li><a href="#">Lista de envios</a></li>
                  </ul>
              </li>
              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión SEPREC<span
                              class="label label-rouded label-themecolor pull-right">2</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-index-seprec.indexSeprec')}}">Información SEPREC</a></li>
                      <li><a href="#">Lista de envios</a></li>
                  </ul>
              </li>

              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Juzgados<span
                              class="label label-rouded label-themecolor pull-right">2</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-index-juzgado.indexJuzgado')}}">Información Juzgados</a></li>
                      <li><a href="#">Lista de envios</a></li>
                  </ul>
              </li>

              <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                          class="mdi mdi-file-document"></i><span class="hide-menu">Gestión Derechos<span
                              class="label label-rouded label-themecolor pull-right">2</span></span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{route('informe-index-derecho.indexDerecho')}}">Información Derechos</a></li>
                      <li><a href="#">Lista de envios</a></li>
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


          </ul>
      </nav>
      <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->