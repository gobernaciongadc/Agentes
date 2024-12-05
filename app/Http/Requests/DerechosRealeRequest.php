<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DerechosRealeRequest extends FormRequest
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
            'nombre_registrador' => 'required|string',
            'municipio_jurisdiccion' => 'required|string',
            'naturaleza_titulo' => 'required|string',
            'numero_titulo' => 'required|string',
            'nombre_razon_social_cedente' => 'required|string',
            'cedula_o_nit_cedente' => 'required|string',
            'nombre_razon_social_beneficiario' => 'required|string',
            'cedula_o_nit_beneficiario' => 'required|string',
            'superficie_del_inmueble' => 'required',
            'porcentaje_de_acciones' => 'required|numeric|min:0',
            'tipo_de_formulario' => 'required|string',
            'numero_de_orden' => 'required',
            'monto_pagado' => 'required|numeric|min:0',
            'informe_id' => 'required',
            'usuario_id' => 'required',
        ];
    }
}
