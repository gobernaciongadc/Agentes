<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SentenciasJudiciale
 *
 * @property $id
 * @property $nombre_secretario
 * @property $numero_juzgado
 * @property $municipio_jurisdiccion
 * @property $naturaleza_proceso
 * @property $numero_resolucion
 * @property $fecha_resolucion
 * @property $nombre_demandante
 * @property $cedula_demandante
 * @property $nombre_demandado
 * @property $cedula_demandado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SentenciasJudiciale extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_secretario', 'numero_juzgado', 'municipio_jurisdiccion', 'naturaleza_proceso', 'numero_resolucion', 'fecha_resolucion', 'nombre_demandante', 'cedula_demandante', 'nombre_demandado', 'cedula_demandado'];


}
