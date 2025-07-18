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
			'name' => 'required|string',
			'username' => 'required|string',
			'email' => 'required|string',
            'password' => 'nullable|string',
			'sexo' => 'required',
			'telefono' => 'required',
			'direccion' => 'required|string',
			'fecha_registro' => 'nullable|date',
			'ci' => 'required',
            'tipo_usuario' => 'required',
			'id_rol' => 'required',
        ];
    }
}
