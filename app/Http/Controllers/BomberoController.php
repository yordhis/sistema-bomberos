<?php

namespace App\Http\Controllers;

use App\Models\Bombero;
use App\Http\Requests\StoreBomberoRequest;
use App\Http\Requests\UpdateBomberoRequest;
use App\Models\DataDev;
use App\Models\Equipo;
use App\Models\EquipoBombero;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BomberoController extends Controller
{
    public $data;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = new DataDev;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filtro){
            $bomberos = Bombero::where('cedula', $request->filtro)
            ->orWhere('nombre', 'LIKE', "%{$request->filtro}%")
            ->orWhere('correo', 'LIKE', "%{$request->filtro}%")
            ->orderBy('nombre', 'desc')
            ->paginate(12);
        }else{
            $bomberos = Bombero::orderBy('id', 'desc')->paginate(12);
        }

        $respuesta = $this->data->respuesta;
        $notificaciones = $this->data->notificaciones;
        return view('admin.bomberos.lista', compact('bomberos', 'request', 'respuesta', 'notificaciones'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBomberoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBomberoRequest $request)
    {
        try {
            $mensaje = "El bombero se creó correctamente";
            $estatus = Response::HTTP_OK;
            $createBombero = Bombero::create($request->all());
            if ($createBombero) {
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                $mensaje = "El bombero NO se creó correctamente";
                $estatus = Response::HTTP_NOT_FOUND;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al registrar el bombero!.");
            $estatus = Response::HTTP_NOT_FOUND;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Vista para editar un bombero
     *
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Http\Response
     */
    public function edit(Bombero $bombero)
    {
        $respuesta = $this->data->respuesta;
        $notificaciones = $this->data->notificaciones;
        return view('admin.bomberos.edit', compact('respuesta', 'bombero', 'notificaciones'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBomberoRequest  $request
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBomberoRequest $request, Bombero $bombero)
    {
        if ($request->cedula != $bombero->cedula) {
            /** Realizamos la busqueda del la nueva cedula */
            $cedulaYaRegistrada = Bombero::where('cedula', $request->cedula)->get();

            /** validadmos que la nueva cedula no este registrada con otro bombero */
            if (count($cedulaYaRegistrada)) {
                $mensaje = "El número de cédula ya esta registrado con otro bombero, por favor ingrese uno nuevo.";
                $estatus = Response::HTTP_UNAUTHORIZED;
                return back()->with(compact('mensaje', 'estatus'));
            }

            /** si la cedula no coincide con nadie registrado
             *  actualizamos las relaciones del bombero 
             */
            // EquipoBombero::where('cedula', $bombero->cedula)->update(['cedula'=>$request->cedula]);
        }

        $bombero->update($request->all());

        $mensaje = "Los cambios se guardaron correctamente.";
        $estatus = Response::HTTP_OK;
        return back()->with(compact('mensaje', 'estatus'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bombero $bombero)
    {
        try {
            /** 
             * Si esta en un grupo lo eliminamos 
             */
            // EquipoBombero::where('cedula', $bombero->cedula)->delete();

            $bombero->delete();
            $mensaje = "El bombero fue eiminado correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
            
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar eliminar al bombero del sistema!");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
