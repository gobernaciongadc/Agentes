<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NotaryRecord
 *
 * @property $id
 * @property $municipio
 * @property $numero_notaria
 * @property $nombre_notaria
 * @property $numero_escritura
 * @property $fecha_escritura
 * @property $naturaleza_escritura
 * @property $nombre_cedente
 * @property $ci_nit_cedente
 * @property $nombre_beneficiario
 * @property $ci_nit_beneficiario
 * @property $tipo_bien
 * @property $registro_bien
 * @property $tipo_formulario
 * @property $numero_orden
 * @property $monto_pagado
 * @property $observaciones
 * @property $informe_id
 * @property $created_at
 * @property $updated_at
 *
 * @property InformeNotarial $informeNotarial
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class NotaryRecord extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['municipio', 'numero_notaria', 'nombre_notaria', 'numero_escritura', 'fecha_escritura', 'naturaleza_escritura', 'nombre_cedente', 'ci_nit_cedente', 'nombre_beneficiario', 'ci_nit_beneficiario', 'tipo_bien', 'registro_bien', 'tipo_formulario', 'numero_orden', 'monto_pagado', 'observaciones', 'informe_id', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function informeNotarial()
    {
        return $this->belongsTo(\App\Models\InformeNotarial::class, 'informe_id', 'id');
    }
}
