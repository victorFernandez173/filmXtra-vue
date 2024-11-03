<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActorObra
 *
 * @property int $obra_id
 * @property int $actor_id
 * @property Actor $actor
 * @property Obra $obra
 */
class ActorObra extends Model
{
    /**
     * Tabla asociada con el modelo
     *
     * @var string
     */
    protected $table = 'actor_obra';

    /**
     * primaryKey
     *
     * @var null
     */
    protected $primaryKey = null;

    /**
     * Indica si el id es auto_increment.
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
     * Atributos asignables
     *
     * @var int[]
     */
    protected $fillable = [
        'obra_id',
        'actor_id',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
    protected $casts = [
        'obra_id' => 'int',
        'actor_id' => 'int',
    ];

    /**
     * Obtiene el actor
     */
    public function actor(): BelongsTo
    {
        return $this->belongsTo(Actor::class);
    }

    /**
     * Obtiene la obra
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
}
