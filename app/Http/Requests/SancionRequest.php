<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SancionRequest extends FormRequest
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
			'tipo_sancion' => 'required|string',
			'motivo' => 'required|string',
			'feha_inposicion' => 'required',
			'monto' => 'required',
			'estado_recibido' => 'required|string',
			'informe_id' => 'required',
			'usuario_id' => 'required',
        ];
    }
}