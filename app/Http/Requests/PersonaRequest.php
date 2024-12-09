<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'carnet' => 'required|string|unique:personas',
            'correo_electronico' => 'string|unique:personas',
            'telefono' => 'string',
            'direccion' => 'string',
        ];
    }
}
