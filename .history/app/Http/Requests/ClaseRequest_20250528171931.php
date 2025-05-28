<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaseRequest extends FormRequest
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
			'fecha' => 'required',
			'hora_inicio' => 'required',
			'hora_fin' => 'required',
			'estado' => 'required|string',
			'comentario_Inst' => 'nullable|string',
			'reporte_estudiante' => 'nullable|string',
			'id_paquete' => 'required',
			'id_inst' => 'required',
            'id_est' => 'nullable',
        ];
    }
}
