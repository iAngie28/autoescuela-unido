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
            dd($this->route('usuario'));
            'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $this->route('usuario'),
        'password' => 'nullable|string|min:6',
        'sexo' => 'required|in:masculino,femenino,otro',
        'telefono' => 'required|integer',
        'direccion' => 'required|string',
        'fecha_registro' => 'nullable|date',
        'ci' => 'required|integer',
        'tipo_usuario' => 'nullable|in:A,E,I',
        'id_rol' => 'required|exists:rols,id',
        ];
    }
}
