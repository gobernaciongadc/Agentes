<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 *
 * @property $id
 * @property $nombre
 * @property $provincia
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'provincia', 'estado'];


}
