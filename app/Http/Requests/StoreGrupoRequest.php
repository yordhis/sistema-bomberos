<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrupoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => "required",
            'nombre' => "required",
            'codigo_nivel' => "required",
            'cedula_profesor' => "required",
            'hora_inicio' => "required",
            'hora_fin' => "required",
            'fecha_inicio' => "required",
            'fecha_fin' => "required",
        ];
    }
}
