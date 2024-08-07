<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Evaluacion
 *
 * @property int $id
 * @property int $obra_id
 * @property int $usuario_id
 * @property float $evaluacion
 * @property Carbon $creada
 * @property Carbon $modificada
 *
 * @property Obra $obra
 * @property Usuario $user
 *
 * @package App\Models
 */
class Evaluacion extends Model
{

    /**
     * Tabla
     *
     * @var string
     */
    protected $table = 'evaluaciones';

    const string CREATED_AT = 'creada';
    const string UPDATED_AT = 'modificada';

    /**
     * Castings
     * @var string[]
     */
    protected $casts = [
        'obra_id' => 'int',
        'usuario_id' => 'int',
        'evaluacion' => 'int',
    ];

    /**
     * Attributos asignables
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'obra_id',
        'usuario_id',
        'evaluacion',
    ];

    /**
     * Obtener la obra
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }

    /**
     * Obtener la obra
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
