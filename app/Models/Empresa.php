<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 *
 * @property $id
 * @property $nombre_representante_seprec
 * @property $nombre_razon_social
 * @property $numero_matricula_comercio
 * @property $direccion
 * @property $telefono
 * @property $actividad
 * @property $nombre_representante_legal
 * @property $numero_cedula_identidad
 * @property $base_empresarial_empresas_activas
 * @property $transferencia_cuotas_capital
 * @property $transferencia_empresa_unipersonal
 * @property $informe_id
 * @property $usuario_id
 * @property $created_at
 * @property $updated_at
 *
 * @property InformeNotarial $informeNotarial
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empresa extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_representante_seprec', 'nombre_razon_social', 'numero_matricula_comercio', 'direccion', 'telefono', 'actividad', 'nombre_representante_legal', 'numero_cedula_identidad', 'base_empresarial_empresas_activas', 'transferencia_cuotas_capital', 'transferencia_empresa_unipersonal', 'informe_id', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function informeNotarial()
    {
        return $this->belongsTo(\App\Models\InformeNotarial::class, 'informe_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }
    
}
