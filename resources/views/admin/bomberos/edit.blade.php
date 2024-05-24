@extends('layouts.app')

@section('title', 'Editar datos del bombero')


@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert"></div>

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                      <a href="{{route('admin.bomberos.index')}}">Volver a la lista de bomberos</a>
                    </div>

                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Editar datos del bombero</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>


                                <form action="{{ route('admin.bomberos.update', $bombero->id) }}" method="post"
                                    class="row g-3 needs-validation text-start" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('PUT')

                                    <div class="col-12">
                                        <label for="nombre" class="form-label">
                                            Nombre completo
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="iconoNombre">
                                                <i class="bi bi-person-circle"></i>
                                            </span>
                                            <input type="text" name="nombre" class="form-control text-dark"
                                                id="nombre" value="{{ old('nombre') ?? $bombero->nombre }}"
                                                placeholder="Ingrese nombre completo" required>

                                            <div class="invalid-feedback">Por favor, ingrese nombre completo! </div>
                                        </div>
                                        @error('nombre')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="cedula" class="form-label">
                                            Cédula
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="inputGroupPrepend">
                                                <i class="bi bi-credit-card"></i>
                                            </span>
                                            <input type="number" name="cedula" class="form-control text-dark"
                                                id="cedula" value="{{ old('cedula') ?? $bombero->cedula }}"
                                                min="600000" max="100000000" placeholder="Ingrese número de cédula"
                                                required>

                                            <div class="invalid-feedback">Por favor, ingrese número de cédula valido (min:
                                                600.000 -
                                                max: 100.000.000)! </div>

                                        </div>
                                        @error('cedula')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="telefono" class="form-label">
                                            Teléfono
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="iconTelefono">
                                                <i class="bi bi-telephone"></i>
                                            </span>
                                            <input type="phone" name="telefono" class="form-control text-dark"
                                                id="telefono" value="{{ old('telefono') ?? $bombero->telefono }}"
                                                min="11" max="25" placeholder="Ejemplo: +584147894563" required>

                                            <div class="invalid-feedback">Por favor, ingrese Teléfono valido! </div>
                                        </div>
                                        @error('telefono')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="correo" class="form-label">
                                            Correo
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="iconoCorreo">
                                                <i class="bi bi-envelope-at"></i>
                                            </span>
                                            <input type="email" name="correo" class="form-control text-dark"
                                                id="correo" value="{{ old('correo') ?? $bombero->correo }}"
                                                min="3" max="255" placeholder="Ejemplo: youremail@mail.com"
                                                required>

                                            <div class="invalid-feedback">Por favor, ingrese Correo eletrónico! </div>
                                        </div>
                                        @error('correo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="direccion" class="form-label">
                                            Dirección
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="iconoDireccion">
                                                <i class="bi bi-pin-map"></i>
                                            </span>
                                            <input type="text" name="direccion" class="form-control text-dark"
                                                id="direccion" value="{{ old('direccion') ?? $bombero->direccion }}"
                                                min="5" max="255"
                                                placeholder="Ejemplo: Urb. Alto Barinas calle X casa X" required>

                                            <div class="invalid-feedback">Por favor, ingrese Dirección! </div>
                                        </div>
                                        @error('direccion')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="cargo" class="form-label">
                                            Cargo
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="iconoRol">
                                                <i class="bi bi-person-rolodex"></i>
                                            </span>
                                            <input type="text" name="cargo" class="form-control text-dark"
                                                id="cargo" value="{{ old('cargo') ?? $bombero->cargo }}"
                                                min="3" max="255"
                                                placeholder="Ejemplo: Capitán, entre otro..." required>

                                            <div class="invalid-feedback">Por favor, ingrese cargo bombero valido! </div>
                                        </div>
                                        @error('cargo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="rol" class="form-label">
                                            Rol o función
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-dark" id="inputGroupPrepend">
                                                <i class="bi bi-gear"></i>
                                            </span>
                                            <input type="text" name="rol" class="form-control text-dark"
                                                id="rol" value="{{ old('rol') ?? $bombero->rol }}" min="3"
                                                max="255" placeholder="Ejemplo: lider de pelotón 1, entre otro..."
                                                required>

                                            <div class="invalid-feedback">Por favor, ingrese rol o función del bombero!
                                            </div>
                                        </div>
                                        @error('rol')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Guardar cambios</button>
                                    </div>

                                </form>



                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endsection
