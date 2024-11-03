<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GeneroObra
 *
 * @property int $obra_id
 * @property int $genero_id
 * @property Genero $genero
 * @property Obra $obra
 */
class GeneroObra extends Model
{
    /**
     * Tabla
     *
     * @var string
     */
    protected $table = 'genero_obra';

    /**
     * primaryKey
     *
     * @var null
     */
    protected $primaryKey = null;

    /**
     * Indica si hay autoincrement
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Sin timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atributos asignables.
     *
     * @var int[]
     */
    protected $fillable = [
        'obra_id',
        'genero_id',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
    protected $casts = [
        'obra_id' => 'int',
        'genero_id' => 'int',
    ];

    /**
     * Obtiene el genero
     */
    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class);
    }

    /**
     * Obtiene la obra
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
}
