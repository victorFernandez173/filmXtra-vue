<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Cita
 *
 * @property int $id
 * @property int $obra_id
 * @property string $cita
 * @property string $tipo
 *
 * @package App\Models
 */
class Cita extends Model
{
    public $timestamps = false;

    /**
     * Atributos asignables
     *
     * TIPOS:
     * -Pelicula
     * -SobreCine
     * -Motivacional
     *
     * @var array<string>
     */
    protected $fillable = [
        'obra_id',
        'cita',
        'tipo'
    ];

    /**
     * Obtener la obra.
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
}
