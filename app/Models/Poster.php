<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Poster
 *
 * @property int $id
 * @property int $obra_id
 * @property string $ruta
 * @property string $alt
 * @property Carbon $creado
 * @property Carbon $modificado
 *
 * @property Obra $obra
 *
 * @package App\Models
 */
class Poster extends Model
{
    /**
     * Clave primaria
     *
     * @var integer
     */
    protected $primaryKey = 'id';

    /**
     * Indica si hay auto_increment.
     *
     * @var bool
     */
    public $incrementing = false;

    const string CREATED_AT = 'creado';
    const string UPDATED_AT = 'modificado';

    /**
     * Castings
     *
     * @var string[]
     */
    protected $casts = [
        'obra_id' => 'int',
    ];

    /**
     * Atributos asignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'obra_id',
        'ruta',
        'alt'
    ];

    /**
     * Obtener la obra.
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }
}
