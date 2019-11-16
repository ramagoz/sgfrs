<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionActualizacionUsuario extends FormRequest
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
            'cedula' => 'required|min:6|max:7',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'tel'=>'max:20',
            'cel'=>'required|min:8|max:20',
            'dpto'=>'max:100',
            'cargo'=>'max:100',
            'correo'=>'required|email|max:100',
            'estado'=>'required|boolean',
            'obs'=>'max:500'
        ];
    }
}
