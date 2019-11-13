<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCargaUsuario extends FormRequest
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
            'cedula' => 'required|min:5|max:7|unique:personas,cedula',
            'nombre'=>'required|min:1|max:50',
            'apellido'=>'required|min:1|max:50',
            'telefono'=>'max:20',
            'celular'=>'required|min:8|max:20',
            'dpto'=>'max:100',
            'cargo'=>'max:100',
            'correo'=>'required|email|max:100|unique:personas,correo',
            'estado'=>'required|boolean',
            'observacion'=>'max:500'
        ];
    }
}
