<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DirectorObra
 *
 * @property int $director_id
 * @property int $obra_id
 * @property Director $director
 * @property Obra $obra
 */
class DirectorObra extends Model
{
    /**
     * Tabla.
     *
     * @var string
     */
    protected $table = 'director_obra';

    /**
     * primaryKey
     *
     * @var null
     */
    protected $primaryKey = null;

    /**
     * Indica si hay auto_increment
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * No timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Attributos asignables
     *
     * @var int[]
     */
    protected $fillable = [
        'director_id',
        'obra_id',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
    protected $casts = [
        'director_id' => 'int',
        'obra_id' => 'int',
    ];

    /**
     * Obtiene el director
     */
    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    /**
     * Obtiene la obra
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
}
