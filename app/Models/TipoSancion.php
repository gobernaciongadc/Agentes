<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSancion extends Model
{
    use HasFactory;
    protected $table = 'tipos_sancion';
    protected $fillable = ['nombre', 'descripcion'];

    public function sanciones()
    {
        return $this->hasMany(Sancion::class);
    }
}
