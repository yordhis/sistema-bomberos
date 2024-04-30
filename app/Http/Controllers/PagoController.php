<?php

namespace App\Http\Controllers;

use App\Models\{
    Pago,
    Estudiante,
    Cuota,
    Concepto,
    Helpers,
    DataDev,
    FormaDePago,
    Grupo,
    Inscripcione
};
use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class PagoController extends Controller
{

    public $data;

    public function __construct()
    {
        $this->data = new DataDev;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notificaciones = $this->data->notificaciones;
            $usuario = $this->data->usuario;
            $pagos = Pago::where('estatus', 1)->orderBy('codigo', 'desc')->get();
            foreach ($pagos as $key => $pago) {
                $pago['estudiante'] = Helpers::getEstudiante($pago->cedula_estudiante);
                $array = explode(',', $pago->monto);
                $pago->monto = $array[0] . "Bs | " . $array[1] . "$";
            }
            return view('admin.pagos.lista', compact('notificaciones', 'usuario', 'pagos'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar lista de pago en el método index,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $notificaciones = $this->data->notificaciones;
            $usuario = $this->data->usuario;
            $metodos = $this->data->metodosPagos;
            $codigo = Helpers::getCodigo('pagos');
            $conceptos = Concepto::where("estatus", 1)->get();
            return view('admin.pagos.crear', compact('notificaciones', 'usuario', 'conceptos', 'metodos', 'codigo'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos para crear el pago en el método create,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function getPagoEstudiante($request, $codigoInscripcion)
    {

        try {
            $notificaciones = $this->data->notificaciones;
            $metodos = $this->data->metodosPagos;
            $codigo = Helpers::getCodigo('pagos');
            $conceptos = Concepto::where('estatus', 1)->get();
            $estudiante = Estudiante::where("cedula", $request)->get();
            return view('admin.pagos.crear', compact('conceptos', 'notificaciones', 'metodos', 'codigo', "estudiante", 'codigoInscripcion'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos de pago del estudiante en el método getPagoEstudiante,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {

        try {

            $estatusPago = false;

            /** registrar el pago */
            $estatusPago = Pago::create([
                'codigo' => $request->codigo_pago,
                'cedula_estudiante' => $request->cedula_estudiante,
                'codigo_inscripcion' => $request->codigo_inscripcion,
                'concepto' => $request->concepto,
                'fecha' => $request->fecha
            ]);

            /** registrar las formas de pago */
            for ($i = 1; $i <= 3; $i++) {
                if ($request["formas_pagos_" . $i] != 0 && $request["monto_" . $i] > 0) {
                    FormaDePago::create([
                        'codigo_pago' => $request->codigo_pago,
                        'metodo' => $request["formas_pagos_" . $i],
                        'monto' => $request["monto_" . $i],
                        'tasa' => $request["tasa_" . $i],
                        'referencia' => $request["referencia_" . $i]
                    ]);
                }
            }

            /** Obtenemos las inscripciones a ver si son dos o mas estudiantes en cueatión */
            $inscripciones = Inscripcione::where('codigo', $request->codigo_inscripcion)->get();

            foreach ($inscripciones as $key => $inscripcion) {
                /** Obtenemos el abono */
                $abono = floatval($request->abono);

                /** Obtenemos las cuotas por estudiante en caso de ser varios en una planilla */
                $cuotas = Cuota::where([
                    'codigo_inscripcion' => $inscripcion->codigo,
                    'cedula_estudiante' => $inscripcion->cedula_estudiante
                ])->get();

                /** Actualizar las cuotas */
                foreach ($cuotas as $key => $cuota) {

                    if ($cuota->cuota > 0 && $abono > 0) {

                        if ($cuota->cuota > $abono) {
                            $cuota->update([
                                "cuota" => $cuota->cuota - $abono
                            ]);
                            $abono = 0;
                        } else {
                            $abono = $abono - $cuota->cuota;
                            $cuota->update([
                                "cuota" => 0,
                                "estatus" => 1,
                            ]);
                        }
                    }
                }
            }


            /** Actualizar la planilla de inscripcion en el campo ABONO */
            foreach ($inscripciones as $key => $inscripcion) {
                Inscripcione::where('codigo', $request->codigo_inscripcion)->update([
                    "abono" => $request->abono + $inscripcion->abono
                ]);
            }

            $mensaje = $estatusPago ? "¡El Pago del estudiante se proceso correctamente!"
                : "No se pudo procesar el pago, por favor vuelva a intentar.";

            $estatus = $estatusPago ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED;

            return back()->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        } catch (\Throwable $th) {

            /** borramos el pago si algo falla */
            FormaDePago::where('codigo_pago', $request->codigo_pago)->delete();
            Pago::where('codigo', $request->codigo_pago)->delete();

            /** mensaje de error */
            $errorInfo = Helpers::getMensajeError($th, "Error al registarr pago del estudiante en el método store,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        try {
            $notificaciones = $this->data->notificaciones;
            $metodos = $this->data->metodosPagos;
            $pago['estudiante'] = Helpers::getEstudiante($pago->cedula_estudiante);
            $pago->id_cuota = explode(",", $pago->id_cuota);
            $pago->monto = explode(",", $pago->monto);

            // Configuramos los horarios
            $pago['horario'] = null;
            foreach ($pago->id_cuota as $key => $cuotaPagada) {
                foreach ($pago['estudiante']['inscripciones'] as $key => $inscripcion) {

                    foreach ($inscripcion['cuotas'] as $key => $cuota) {
                        if ($cuotaPagada == $cuota['id']) {
                            foreach ($pago['estudiante']['grupos'] as $key => $grupo) {
                                if ($cuota['codigo_grupo'] == $grupo['codigo']) {
                                    $pago['horario'] = [
                                        "dias" => $grupo['dias'],
                                        "horas" => $grupo['hora_inicio'] . " - " . $grupo['hora_fin']
                                    ];
                                    break;
                                }
                            }
                            break;
                        }
                    }
                }
            }

            // Configuramos los metodos de pago 
            $metodosPagos = explode(",", $pago->metodo);
            foreach ($metodosPagos as $metodosPago) {
                foreach ($metodos as $key => $metodo) {
                    if ($metodo['metodo'] == $metodosPago) {
                        $metodos[$key]["activo"] = true;
                        break;
                    }
                }
            }

            // return $pago;
            return view('admin.pagos.recibo', compact('pago', 'metodos', 'notificaciones'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos de pago del estudiante en el método show,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function recibopdf($cedulaEstudiante, $codigoInscripcion)
    {
        try {
            // obtenemos los datos del pago
            $pagos = Pago::where([
                "codigo_inscripcion" => $codigoInscripcion
            ])->get();

            if (count($pagos)) {

                foreach ($pagos as $key => $pago) {
                    /** obtenemos las formas de pago */
                    $pago->formas_pagos = FormaDePago::where('codigo_pago', $pago->codigo)->get();

                    /** normalizamos el tipo de dato de monto y tasa  */
                    foreach ($pago->formas_pagos as $key => $pay) {
                        $pay->tasa = floatval($pay->tasa);
                        $pay->monto = floatval($pay->monto);
                    }
                    /** normalizamos la fecha */
                    $pago->fecha = Helpers::normalizarFecha($pago->fecha);
                }


                /** Obtenemos la inscripcion pagada */
                $inscripciones = Inscripcione::where([
                    'codigo' => $codigoInscripcion
                ])->get();

                /** obtenemos al estudiante */
                $estudiantes = [];
                foreach ($inscripciones as $key => $inscripcion) {
                    array_push($estudiantes, Helpers::getEstudiante($inscripcion->cedula_estudiante)[0]);
                }

                /** Obtenemos las cuotas */
                $cuotas = Cuota::where([
                    "codigo_inscripcion" => $codigoInscripcion,
                    "cedula_estudiante" => $cedulaEstudiante,
                ])->get();

                $estatusCuotas = 0;
                $contarPagoCompletador = 0;
                foreach ($cuotas as $key => $cuota) {
                    $cuota->cuota = floatval($cuota->cuota);
                    $cuota->estatus = floatval($cuota->estatus);
                    $cuota->fecha = Helpers::normalizarFecha($cuota->fecha);
                    if ($cuota->estatus == 1) {
                        $contarPagoCompletador++;
                    }

                    if ($contarPagoCompletador == count($cuotas)) {
                        $estatusCuotas = 1;
                    }
                }

                // return $estudiantes;
                // Codigo para previsualizar el pdf
                // return view('admin.pagos.recibopdf',  compact('pagos', 'inscripciones', 'estudiantes', 'cuotas', 'estatusCuotas'));
                // Se genera el pdf
                $pdf = PDF::loadView('admin.pagos.recibopdf', compact('pagos', 'inscripciones', 'estudiantes', 'cuotas', 'estatusCuotas'));
                return $pdf->download("recibo_control_de_pago_{$pagos[0]->fecha}.pdf");
            } else {
                return back()->with([
                    "mensaje" => "No poseé pagos registrados, por favor procese un pago antes de solicitar el recibo de pago.",
                    "estatus" => Response::HTTP_UNAUTHORIZED,
                ]);
            }
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Generar PDF del Pago del estudiante en el método recibopdf,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        return redirect("pagos");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagoRequest  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        return redirect("pagos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        try {

            // Cambiamos de estado las cuotas del pago
            $pago->id_cuota = explode(",", $pago->id_cuota);
            if ($pago->id_cuota[0] > 0) {
                foreach ($pago->id_cuota as $key => $cuota) {
                    Cuota::where("id", $cuota)->update(["estatus" => 0]);
                }
            }

            // Eliminamos el pago
            $pago->delete();

            // Redireccionamos con una respuesta
            $mensaje = "El Pago del estudiante se eliminó correctamente.";
            $estatus = 200;
            return redirect("pagos?mensaje={$mensaje}&estatus={$estatus}");
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Eliminar el Pago del estudiante en el método destroy,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }
}
