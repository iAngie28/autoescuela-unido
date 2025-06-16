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
        return [
            'name' => 'nullable|string',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $this->route('usuario'),
            'password' => 'nullable|string|min:6',
            'sexo' => 'nullable|in:masculino,femenino,otro',
            'telefono' => '-|integer',
            'direccion' => 'nullable|string',
            'fecha_registro' => 'nullable|date',
            'ci' => 'nullable|integer',
            'tipo_usuario' => 'nullable|in:A,E,I',
            'id_rol' => 'nullable|exists:rols,id',
        ];
    }
}
