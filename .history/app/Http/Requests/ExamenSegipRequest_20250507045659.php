<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamenSegipRequest extends FormRequest
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
			'id_est' => 'required',
			'id_grupo' => 'required',
			'nro_intento' => 'required',
			'estado' => 'required|string',
			'id_categoria' => 'required',
            'nota_teorica' => 'nullable|integer',
            'nota_practica' => 'nullable|integer'

        ];
    }
}
