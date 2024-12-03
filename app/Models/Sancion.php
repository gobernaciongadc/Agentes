<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sancion
 *
 * @property $id
 * @property $tipo_sancion
 * @property $motivo
 * @property $feha_inposicion
 * @property $monto
 * @property $estado_recibido
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
class Sancion extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tipo_sancion', 'motivo', 'feha_inposicion', 'monto', 'estado_recibido', 'informe_id', 'usuario_id'];


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
