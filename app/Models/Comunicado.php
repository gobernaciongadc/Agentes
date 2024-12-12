<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comunicado
 *
 * @property $id
 * @property $titulo
 * @property $fecha_emision
 * @property $destinatario
 * @property $asunto
 * @property $cuerpo_mensaje
 * @property $adjuntos
 * @property $created_at
 * @property $updated_at
 * @property $usuario_id
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comunicado extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['titulo', 'fecha_emision', 'destinatario', 'asunto', 'cuerpo_mensaje', 'adjuntos', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }
    
}
