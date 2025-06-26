<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificacioneRequest extends FormRequest
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
       
            $rules = [
                'mensaje' => ['required', 'string', 'max:255'],
                'tipo'    => ['required', 'string', 'max:100'],
                'fecha'   => ['required', 'date'],
                'leido'   => ['boolean'],
            ];

            if (auth()->user()->tipo_usuario === 'A') {
                $rules['user_id'] = ['required', 'exists:users,id'];
            }

            return $rules;
        

    }
}
