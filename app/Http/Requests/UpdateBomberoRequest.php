<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBomberoRequest extends FormRequest
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
            'nombre' => "required | max:255",
            'cedula' => "required | max:255", 
            'telefono' => "required | max:255",
            'correo'  => "required | max:255",
            'direccion'  => "required | max:255",
            'cargo' => "required | max:255",
            'rol' => "required | max:255",
        ];
    }
}
