<?php

namespace App\Http\Controllers;

use App\Models\Bombero;
use App\Http\Requests\StoreBomberoRequest;
use App\Http\Requests\UpdateBomberoRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BomberoController extends Controller
{
    public $data;
    /**
     * Constructor
     */
     public function __construct(){
        $this->data = new DataDev;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bomberos = Bombero::paginate(12);
        $respuesta = $this->data->respuesta;
        $notificaciones = $this->data->notificaciones;
        return view('admin.bomberos.lista', compact('bomberos', 'request', 'respuesta','notificaciones'));
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
            if($createBombero){
                return back()->with(compact('mensaje', 'estatus'));
            }else{
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBomberoRequest  $request
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBomberoRequest $request, Bombero $bombero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bombero $bombero)
    {
        //
    }
}
