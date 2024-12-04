<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaryRecordRequest extends FormRequest
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
            'municipio' => 'required|string',
            'numero_notaria' => 'required|string',
            'nombre_notaria' => 'required|string',
            'numero_escritura' => 'required|string',
            'fecha_escritura' => 'required',
            'naturaleza_escritura' => 'required|string',
            'nombre_cedente' => 'required|string',
            'ci_nit_cedente' => 'required|string',
            'nombre_beneficiario' => 'required|string',
            'ci_nit_beneficiario' => 'required|string',
            'tipo_bien' => 'required|string',
            'registro_bien' => 'string',
            'tipo_formulario' => 'string',
            'numero_orden' => 'required',
            'monto_pagado' => 'required',
            'observaciones' => 'string',
            'informe_id' => 'required',
        ];
    }
}
