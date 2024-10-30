<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 *
 * @property $id
 * @property $nombres
 * @property $apellidos
 * @property $fecha_nacimiento
 * @property $genero
 * @property $carnet
 * @property $lugar_expedicion
 * @property $correo_electronico
 * @property $telefono
 * @property $direccion
 * @property $departamento
 * @property $provincia
 * @property $estado_civil
 * @property $profesion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Persona extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombres', 'apellidos', 'carnet', 'correo_electronico', 'telefono', 'direccion'];
}
