<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SentenciasJudicialeRequest extends FormRequest
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
			'nombre_secretario' => 'required|string',
			'numero_juzgado' => 'required',
			'municipio_jurisdiccion' => 'required|string',
			'naturaleza_proceso' => 'required|string',
			'numero_resolucion' => 'required|string',
			'fecha_resolucion' => 'required',
			'nombre_demandante' => 'required|string',
			'cedula_demandante' => 'required|string',
			'nombre_demandado' => 'required|string',
			'cedula_demandado' => 'required|string',
        ];
    }
}
