<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules(): array
{
    $id = $this->route('usuario');
    if (is_object($id)) {
        $id = $id->id;
    }
    return [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'sexo' => 'required|in:masculino,femenino,otro',
        'telefono' => 'required|numeric',
        'direccion' => 'required|string|max:255',
        'fecha_registro' => 'nullable|date',
        'ci' => 'required|numeric',
        'tipo_usuario' => 'required|in:A,E,I',
        'id_rol' => 'required|exists:rols,id',
    ];
}


}
