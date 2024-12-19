<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion_2 extends Model
{
    use HasFactory;

    protected $table = 'sanciones';

    protected $fillable = ['nombre', 'agente_id', 'monto', 'estado', 'estado_vista', 'usuario_id', 'estado_envio'];

    public function tipoSancion()
    {
        return $this->belongsTo(TipoSancion::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function agente()
    {
        return $this->belongsTo(\App\Models\Agente::class, 'agente_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }
}
