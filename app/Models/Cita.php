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
 * @property int $tipo
 *
 * @package App\Models
 */
class Cita extends Model
{
    public $table = 'citas';
    public $timestamps = false;

//    Constantes para el tipo de cita
    const int PELICULA = 1;
    const int SOBRECINE = 2;
    const int MOTIVACIONAL = 3;

    /**
     * Atributos asignables
     *
     * @var array<string>
     */
    protected $fillable = [
        'obra_id',
        'cita',
        'tipo'
    ];

    /**
     * Obtener la obra
     * @return BelongsTo
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
}
