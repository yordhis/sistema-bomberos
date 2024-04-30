@extends('layouts.index')

@section('title', 'A. Maryland')

@section('content')
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center ">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center pb-1" >
          
            <a href="{{ route('login.index') }}" >
              <img src="{{ asset('assets/img/logo.png') }}" alt="logo" id="logo">
            </a>
          </div><!-- End Logo -->

          <div class="card mb-1">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4 text-dark">Ingrese a su cuenta</h5>
                <p class="text-center small text-danger">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
              </div>

              <form action="{{ route('login.store') }}" method="post" class="row g-3 needs-validation" novalidate>
              @csrf
              @method('post')
                <div class="col-12">
                  <label for="yourUsername" class="form-label">Nombre de Usuario</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">@</span>
                    <input type="text" name="email" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Por favor, ingrese su nombre de usuario!</div>
                    @error('nombre')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Contraseña</label>
                  <input type="password" name="password" class="form-control" id="yourPassword" required>
                  <div class="invalid-feedback">Por favor, ingrese su contraseña!</div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="rememberMe" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Acuérdate de mí</label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Entrar</button>
                </div>
                {{-- <div class="col-12">
                  <p class="small mb-0 text-center"> 
                    <a href="pages-register.html">¿Olvido su contraseña?</a>
                  </p>
                </div> --}}
              </form>

            </div>
          </div>

        </div>
      </div>
    </div>

  </section>
@endsection


    