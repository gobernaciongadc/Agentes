<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion_2 extends Model
{
    use HasFactory;

    protected $table = 'sanciones';

    protected $fillable = ['nombre', 'tipo_sancion_id', 'monto', 'estado', 'descripcion'];

    public function tipoSancion()
    {
        return $this->belongsTo(TipoSancion::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
