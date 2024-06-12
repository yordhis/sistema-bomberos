@extends('layouts.app')

@section('title', 'Lista de equipos')

@section('content')

    @if( session('mensaje') )
        @include('partials.alert')
    @endif

    <div id="alert"></div>

    <section class="section">
        <div class="row">
            <div class="col-12">  
                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>


            <div class="col-12">
                <h2> Lista de equipos </h2>
            </div>
            {{-- boton del modal para crear --}}
            <div class="col-sm-6 col-xs-12">
            @include('admin.equipos.partials.modalFormCreate')
            </div>

            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.equipos.index') }}" method="post">
                @csrf
                @method('get')
                <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                    name="filtro"
                    placeholder="Buscar" 
                    aria-label="Filtrar" 
                    aria-describedby="button-addon2" required>
                    <button class="btn btn-primary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                  </div>
                </form>
            </div>

            <div class="col-lg-12 table-responsive">
                <!-- Table with stripped rows -->

                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        @foreach ($equipos as $equipo)
                            <tr>
                                <th scope="row">{{ $equipo->id }}</th>
                                <td>{{ $equipo->nombre }}</td>
                                <td>{{ $equipo->cedula }}</td>
                                <td>{{ $equipo->telefono }}</td>
                                <td class="text-break">{{ $equipo->correo }}</td>

                                <td>
                                    @include('admin.equipos.partials.modalVer')
                                    
                                    <a href="{{ route('admin.equipos.edit', $equipo->id) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    @include('admin.equipos.partials.modalEliminar')


                                </td>
                            </tr>
                           
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="7" class="text-center table-secondary">
                                Total de equipos: {{ $equipos->total() }} | 
                                <a href="{{ route('admin.equipos.index') }}"
                                   class="text-primary" >
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                
                            <div class="col-sm-6 col-xs-12">
                                {{ $equipos->appends(['filtro'=> $request->filtro])->links() }}
                            </div>

            </div>

           
        </div>

       

    </section>


    


@endsection
