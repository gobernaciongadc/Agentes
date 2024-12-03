  <nav class="navbar top-navbar navbar-expand-md navbar-light">
      <!-- ============================================================== -->
      <!-- Logo -->
      <!-- ============================================================== -->
      <div class="navbar-header">
          <a class="navbar-brand" href="index.html">
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
                      <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right mailbox animated fallInDown">
                      <ul>
                          <li>
                              <div class="drop-title">Notifications</div>
                          </li>
                          <li>
                              <div class="message-center">
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                      <div class="mail-contnet">
                                          <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new
                                              admin!</span> <span class="time">9:30 AM</span>
                                      </div>
                                  </a>
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="btn btn-success btn-circle"><i class="ti-calendar"></i>
                                      </div>
                                      <div class="mail-contnet">
                                          <h5>Event today</h5> <span class="mail-desc">Just a reminder that
                                              you have event</span> <span class="time">9:10 AM</span>
                                      </div>
                                  </a>
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                      <div class="mail-contnet">
                                          <h5>Settings</h5> <span class="mail-desc">You can customize this
                                              template as you want</span> <span class="time">9:08 AM</span>
                                      </div>
                                  </a>
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                      <div class="mail-contnet">
                                          <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my
                                              admin!</span> <span class="time">9:02 AM</span>
                                      </div>
                                  </a>
                              </div>
                          </li>
                          <li>
                              <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all
                                      notifications</strong> <i class="fa fa-angle-right"></i> </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                          class="mdi mdi-email"></i>
                      <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                  </a>
                  <div class="dropdown-menu mailbox dropdown-menu-right animated fall-in-down"
                      aria-labelledby="2">
                      <ul>
                          <li>
                              <div class="drop-title">You have 4 new messages</div>
                          </li>
                          <li>
                              <div class="message-center">
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="user-img"> <img src="../assets/images/users/1.jpg"
                                              alt="user" class="img-circle"> <span
                                              class="profile-status online pull-right"></span> </div>
                                      <div class="mail-contnet">
                                          <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my
                                              admin!</span> <span class="time">9:30 AM</span>
                                      </div>
                                  </a>
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="user-img"> <img src="../assets/images/users/2.jpg"
                                              alt="user" class="img-circle"> <span
                                              class="profile-status busy pull-right"></span> </div>
                                      <div class="mail-contnet">
                                          <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See
                                              you at</span> <span class="time">9:10 AM</span>
                                      </div>
                                  </a>
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="user-img"> <img src="../assets/images/users/3.jpg"
                                              alt="user" class="img-circle"> <span
                                              class="profile-status away pull-right"></span> </div>
                                      <div class="mail-contnet">
                                          <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span>
                                          <span class="time">9:08 AM</span>
                                      </div>
                                  </a>
                                  <!-- Message -->
                                  <a href="#">
                                      <div class="user-img"> <img src="../assets/images/users/4.jpg"
                                              alt="user" class="img-circle"> <span
                                              class="profile-status offline pull-right"></span> </div>
                                      <div class="mail-contnet">
                                          <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my
                                              admin!</span> <span class="time">9:02 AM</span>
                                      </div>
                                  </a>
                              </div>
                          </li>
                          <li>
                              <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all
                                      e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <!-- ============================================================== -->
              <!-- End Messages -->
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