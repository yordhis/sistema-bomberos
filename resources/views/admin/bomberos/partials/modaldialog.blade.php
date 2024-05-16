 <!-- Modal Dialog Scrollable -->
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearBombero">
     <i class="bi bi-plus"></i>Registrar bombero
 </button>
 <div class="modal fade" id="modalCrearBombero" tabindex="-1">
     <div class="modal-dialog modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Formulario para registrar bombero</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form action="{{ route('admin.bomberos.store') }}" method="post"
                     class="row g-3 needs-validation text-start" enctype="multipart/form-data" novalidate>
                     @csrf
                     @method('post')

                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Nombre completo
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                 <i class="bi bi-people-fill"></i>
                             </span>
                             <input type="text" name="nombre" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('nombre') ?? '' }}"  
                                 placeholder="Ingrese nombre completo"
                                 required>

                             <div class="invalid-feedback">Por favor, ingrese nombre completo! </div>
                             @error('nombre')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Cédula
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-credit-card-fill"></i>
                             </span>
                             <input type="text" name="cedula" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('cedula') ?? '' }}"  required>

                             <div class="invalid-feedback">Por favor, ingrese cédula! </div>
                             @error('cedula')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Teléfono
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                 <i class="bi bi-phone-fill"></i>
                             </span>
                             <input type="text" name="telefono" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('telefono') ?? '' }}"  required>

                             <div class="invalid-feedback">Por favor, ingrese Teléfono! </div>
                             @error('telefono')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Correo
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-envelope-at-fill"></i>
                             </span>
                             <input type="text" name="correo" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('correo') ?? '' }}"  required>

                             <div class="invalid-feedback">Por favor, ingrese Correo! </div>
                             @error('correo')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Dirección
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-envelope-at-fill"></i>
                             </span>
                             <input type="text" name="direccion" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('direccion') ?? '' }}"  required>

                             <div class="invalid-feedback">Por favor, ingrese Dirección! </div>
                             @error('direccion')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Cargo
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-envelope-at-fill"></i>
                             </span>
                             <input type="text" name="cargo" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('cargo') ?? '' }}"  required>

                             <div class="invalid-feedback">Por favor, ingrese Cargo! </div>
                             @error('cargo')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12">
                         <label for="yourUsername" class="form-label">
                            Rol o función
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-envelope-at-fill"></i>
                             </span>
                             <input type="text" name="rol" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ old('rol') ?? '' }}"  required>

                             <div class="invalid-feedback">Por favor, ingrese rol! </div>
                             @error('rol')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>


                  


                     <div class="col-12">
                         <button class="btn btn-primary w-100" type="submit">Guardar datos</button>
                     </div>

                 </form>

             </div>
         </div>
     </div>
 </div><!-- End Modal Dialog Scrollable-->
