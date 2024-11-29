<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
			'nombre_representante_seprec' => 'required|string',
			'nombre_razon_social' => 'required|string',
			'numero_matricula_comercio' => 'required|string',
			'direccion' => 'required|string',
			'telefono' => 'required|string',
			'actividad' => 'required|string',
			'nombre_representante_legal' => 'required|string',
			'numero_cedula_identidad' => 'required|string',
			'base_empresarial_empresas_activas' => 'required|string',
			'transferencia_cuotas_capital' => 'required|string',
			'transferencia_empresa_unipersonal' => 'required|string',
			'informe_id' => 'required',
			'usuario_id' => 'required',
        ];
    }
}
