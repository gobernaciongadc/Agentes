<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgenteRequest extends FormRequest
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
			'persona_id' => 'required',
			'municipio_id' => 'required',
			'tipo_agente' => 'required|string',
			'respaldo' => 'required|string',
			'estado' => 'required',
        ];
    }
}
