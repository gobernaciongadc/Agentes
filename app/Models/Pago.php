<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['sancion_id', 'monto_pagado', 'metodo_pago', 'fecha_pago'];

    public function sancion()
    {
        return $this->belongsTo(Sancion::class);
    }
}
