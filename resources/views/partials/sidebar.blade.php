@php
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $categoria = strtoupper($url[1]);
    if (isset($url[2])) {
        $subcategoria = strtoupper($url[2]);
    } else {
        $subcategoria = 'LISTA';
    }
@endphp

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->rol == 1 || Auth::user()->rol == 2)
            <!-- Start Components Nav | Panel -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.panel.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Panel</span>
                </a>
            </li><!-- End Dashboard Nav | Panel-->



            <!-- Start Components Nav | Bomberos -->
            <li class="nav-item">
                <a href="{{ route('admin.bomberos.index') }}"
                    class="nav-link  {{ $categoria == 'NIVELES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-controller"></i><span>Bomberos</span>
                </a>
            </li><!-- End Components Nav | bomberos -->

            <!-- Start Components Nav | Equipos -->
            <li class="nav-item">
                <a href="{{ route('admin.equipos.index') }}"
                    class="nav-link  {{ $categoria == 'NIVELES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-controller"></i><span>Equipos</span>
                </a>
            </li><!-- End Components Nav | Equipos -->

            <!-- Start Components Nav | Formatos -->
            <li class="nav-item">
                <a href="{{ route('admin.formatos.index') }}"
                    class="nav-link  {{ $categoria == 'NIVELES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-controller"></i><span>Formatos de incidencias</span>
                </a>
            </li><!-- End Components Nav | Formatos -->
            
            <!-- Start Components Nav | Incidencias lista -->
            <li class="nav-item">
                <a href="{{ route('admin.incidencias.index') }}"
                    class="nav-link  {{ $categoria == 'NIVELES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-controller"></i><span>Incidencias</span>
                </a>
            </li><!-- End Components Nav | Incidencias lista -->

            <!-- Start Components Nav | Incidencias crear -->
            <li class="nav-item">
                <a href="{{ route('admin.incidencias.create') }}"
                    class="nav-link  {{ $categoria == 'NIVELES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-controller"></i><span>Registrar incidencia</span>
                </a>
            </li><!-- End Components Nav | Incidencias crear -->
        @endif

        @if (Auth::user()->rol == 1)
            <!-- Start Components Nav | configuraciones -->
            <li class="nav-item">
                <a class="nav-link {{ $categoria == 'USUARIOS' ? 'collapse show' : 'collapsed' }}"
                    data-bs-target="#components-nav-10" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Configuración</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-10"
                    class="nav-content {{ ($categoria == 'CONCEPTOS' ? 'collapse show' : $categoria == 'USUARIOS') ? 'collapse show' : 'collapse' }} "
                    data-bs-parent=" #sidebar-nav">

                    <!-- Start Components Nav | usuarios -->
                    <li class="nav-item">
                        <a class="nav-link {{ $categoria == 'USUARIOS' ? 'collapse show' : 'collapsed' }}"
                            data-bs-target="#components-nav-1" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-people fs-3"></i><span>Usuarios</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav-1"
                            class="nav-content {{ $categoria == 'USUARIOS' ? 'collapse show' : 'collapse' }} "
                            data-bs-parent=" #sidebar-nav-1">
                            <li>
                                <a href="{{ route('admin.usuarios.index') }}"
                                    class="{{ $categoria == 'USUARIOS' ? ($subcategoria == 'LISTA' ? 'active border rounded' : '') : '' }}">
                                    <i class="bi bi-circle"></i><span>Lista</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.usuarios.create') }}"
                                    class="{{ $categoria == 'USUARIOS' ? ($subcategoria == 'CREATE' ? 'active border rounded' : '') : '' }}">
                                    <i class="bi bi-circle"></i><span>Crear</span>
                                </a>
                            </li>

                        </ul>
                    </li><!-- End Components Nav | usuarios -->

                </ul>
            </li><!-- End Components Nav | configuraciones -->
        @endif

    </ul>


</aside><!-- End Sidebar -->
