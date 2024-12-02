<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DerechosReale
 *
 * @property $id
 * @property $nombre_registrador
 * @property $municipio_jurisdiccion
 * @property $naturaleza_titulo
 * @property $numero_titulo
 * @property $nombre_razon_social_cedente
 * @property $cedula_o_nit_cedente
 * @property $nombre_razon_social_beneficiario
 * @property $cedula_o_nit_beneficiario
 * @property $superficie_del_inmueble
 * @property $porcentaje_de_acciones
 * @property $tipo_de_formulario
 * @property $numero_de_orden
 * @property $monto_pagado
 * @property $created_at
 * @property $updated_at
 * @property $informe_id
 * @property $usuario_id
 *
 * @property InformeNotarial $informeNotarial
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DerechosReale extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_registrador', 'municipio_jurisdiccion', 'naturaleza_titulo', 'numero_titulo', 'nombre_razon_social_cedente', 'cedula_o_nit_cedente', 'nombre_razon_social_beneficiario', 'cedula_o_nit_beneficiario', 'superficie_del_inmueble', 'porcentaje_de_acciones', 'tipo_de_formulario', 'numero_de_orden', 'monto_pagado', 'informe_id', 'usuario_id'];


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
