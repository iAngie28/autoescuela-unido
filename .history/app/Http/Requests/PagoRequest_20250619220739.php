<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
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
            /*'monto' => 'required',
            'fecha' => 'nullable|date',
            'descuento' => 'nullable|integer',
            'id_est' => 'required',
            'id_adm' => 'required',
            'detalle' => 'nullable|string',
            'estado' => 'nullable|string',*/
            'id_est' => 'required|exists:estudiante,id',
        'tipo_pago' => 'required|in:paquete,grupo',
        'paquete_id' => 'nullable|exists:paquete,id',
        'categoria_id' => 'nullable|exists:categorias,id',
        ];
    }
}
