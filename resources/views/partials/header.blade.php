


    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.panel.index') }}" class="">
            <img src="{{ asset('assets/img/logo_bomberos.png') }}" class="img-thumbnail" alt="logo"
            width="50" 
            >
        </a>
        <h5 class="text-primary">Sistema de incidencias</h5>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">{{$notificaciones['total']}} </span>
            </a><!-- End Notification Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            
            <li class="dropdown-header">
                Tienes {{$notificaciones['total']}} notificaciones nuevas
                <a href="/notificaciones"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver todo</span></a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

          
            @foreach ($notificaciones['data'] as $noticia)
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                    <h4>{{$noticia['descripcion']}}</h4>
                    <p> <a href="{{ route($noticia['route']) }}"> Verificar: {{$noticia['tipo']}}</a> </p>
                   
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
            @endforeach
           
            

            <li>
                <hr class="dropdown-divider">
            </li>


            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
                <a href="/notificaciones">Ver Todas las notificaciones</a>
            </li>

            </ul><!-- End Notification Dropdown Items -->

        </li>
        <!-- End Notification Nav -->

        

        <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset(Auth::user()->foto) ?? asset('assets/img/avatar.png') }}" alt="Avatar img" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nombre ?? ''}}</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
                <h6>{{Auth::user()->nombre}}</h6>
                <span>{{Auth::user()->rol ? 'Aministrador' : 'Asistente'}}</span>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>



            <li>
                <form action="{{ route('logout') }}" method="post" class="text-center">
                @csrf
                @method('post')
                    <button type="submit" class="btn btn-node ">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Salir</span>
                    </button>
                    </a>
                </form>
            </li>

            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

