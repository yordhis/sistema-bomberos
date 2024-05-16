@extends('layouts.app')

@section('title', 'Lista de bomberos')

@section('content')

    @if( session('mensaje') )
        @include('partials.alert')
    @endif
    <div id="alert"></div>

    <section class="section">
        <div class="row">



            <div class="col-sm-6 col-xs-12">
                <h2> Lista de bomberos </h2>
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.bomberos.index') }}" method="post">
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
               
                        @foreach ($bomberos as $bombero)
                            <tr>
                                <th scope="row">{{ $bombero->id }}</th>
                                <td>{{ $bombero->nombre }}</td>
                                <td>{{ $bombero->cedula }}</td>
                                <td>{{ $bombero->telefono }}</td>
                                <td class="text-break">{{ $bombero->correo }}</td>

                                <td>

                                    <a href="{{ route('admin.bomberos.edit', $bombero->id) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    @include('admin.bomberos.partials.modal')


                                </td>
                            </tr>
                           
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="7" class="text-center table-secondary">
                                Total de bomberos: {{ $bomberos->total() }} | 
                                <a href="{{ route('admin.bomberos.index') }}"
                                   class="text-primary" >
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->

            </div>

            <div class="col-sm-6 col-xs-12">
                {{ $bomberos->appends(['filtro'=> $request->filtro])->links() }}
            </div>

            <div class="col-sm-6 col-xs-12 text-end">
                {{-- boton del modal para crear --}}
                @include('admin.bomberos.partials.modaldialog')
                <br>
                 
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
        </div>

       

    </section>


    


@endsection
