<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InformeNotarial
 *
 * @property $id
 * @property $descripcion
 * @property $estado
 * @property $fecha_envio
 * @property $created_at
 * @property $updated_at
 *
 * @property NotaryRecord[] $notaryRecords
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InformeNotarial extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['descripcion', 'estado', 'fecha_envio'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notaryRecords()
    {
        return $this->hasMany(\App\Models\NotaryRecord::class, 'id', 'informe_id');
    }


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }
}
