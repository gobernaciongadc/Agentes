<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoBimestral extends Model
{

    use HasFactory;

    protected $table = 'periodo_bimestrales';
    protected $fillable = ['year', 'usuario_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }
}
