<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notificacione
 *
 * @property $id
 * @property $asunto
 * @property $destinatario
 * @property $mensaje
 * @property $fecha_emision
 * @property $adjuntos
 * @property $usuario_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Notificacione extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['asunto', 'destinatario', 'mensaje', 'fecha_emision', 'adjuntos', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }
    
}
