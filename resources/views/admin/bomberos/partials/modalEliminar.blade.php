
        
<!-- Vertically centered Modal -->
<a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$bombero->id}}">
    <i class="bi bi-trash"></i>
</a>

<div class="modal fade" id="verticalycentered{{$bombero->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Eliminando</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar al bombero <span class="text-danger fs-5">{{$bombero->nombre}}</span>? 
        </div>
        <div class="modal-footer">
            <form action="{{ route('admin.bomberos.destroy', $bombero->id) }}" method="post" >
            @csrf
            @method('delete')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Si, proceder a eliminar.</button>
            </form>
        </div>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


