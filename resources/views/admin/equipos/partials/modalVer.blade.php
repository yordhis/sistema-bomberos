<!-- Button trigger modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalVer{{$equipo->id}}">
    <i class="bi bi-eye"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="modalVer{{$equipo->id}}" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalVerLabel">Información de equipo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               
                      <div class="card h-100">
                        {{-- <img src="{{ asset($equipo->foto)}}" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h2 class="card-title fs-2">
                                <i class="bi bi-person-circle"></i>
                                {{ $equipo->nombre }}
                            </h2>
                            {{-- <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="card-text"><strong class="text-blue ">Número de cedula:</strong> {{ $equipo->cedula }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p class="card-text"><strong class="text-blue ">Teléfono:</strong> {{ $equipo->telefono }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p class="card-text"><strong class="text-blue ">Correo electrónico:</strong> {{ $equipo->correo }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p class="card-text"><strong class="text-blue ">Dirección de domicilio:</strong> {{ $equipo->direccion }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p class="card-text"><strong class="text-blue ">Cargo que desempeña:</strong> {{ $equipo->cargo }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p class="card-text"><strong class="text-blue ">Rol o función:</strong> {{ $equipo->rol }}</p>
                                </li>   
                            </ul> --}}
                        </div>
                      </div>
                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
