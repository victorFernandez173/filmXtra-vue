<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Like
 *
 * @property int $usuario_id
 * @property int $critica_id
 *
 * @property Critica $critica
 * @property Usuario $user
 *
 * @package App\Models
 */
class Like extends Model
{
    /**
     * Tabla.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * primaryKey
     *
     * @var null
     * @access protected
     */
    protected $primaryKey = null;

    /**
     * Indica si hay auto_increment.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * No timestamps
     * @var bool
     */
	public $timestamps = false;

    /**
     * Attributos asignables.
     *
     * @var int[]
     */
    protected $fillable = [
        'usuario_id',
        'critica_id',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
	protected $casts = [
		'usuario_id' => 'int',
		'critica_id' => 'int'
	];

    /**
     * Obtiene la critica
     *
     * @return BelongsTo
     */
	public function critica(): BelongsTo
	{
		return $this->belongsTo(Critica::class);
	}

    /**
     * Obtiene el usuario
     *
     * @return BelongsTo
     */
	public function user(): BelongsTo
	{
		return $this->belongsTo(Usuario::class);
	}
}
