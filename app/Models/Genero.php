<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Genero
 *
 * @property int $id
 * @property string $genero_es
 * @property string $genero_en
 * @property Carbon $creado
 * @property Carbon $modificado
 *
 * @property Collection|Obra[] $obras
 *
 * @package App\Models
 */
class Genero extends Model
{
    const string CREATED_AT = 'creado';
    const string UPDATED_AT = 'modificado';

    /**
     * Atributos asignables
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'genero',
    ];
    /**
     * Obtiene las obras
     */
    public function obras(): BelongsToMany
    {
        return $this->belongsToMany(Obra::class);
    }
}
