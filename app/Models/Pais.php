<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Genero
 *
 * @property string $id
 * @property string $pais_es
 * @property string $pais_en
 * @property Carbon $creado
 * @property Carbon $modificado
 *
 * @package App\Models
 */
class Pais extends Model
{
    /**
     * Tabla
     *
     * @var string
     */
    protected $table = 'paises';

    public $incrementing = false;

    protected $keyType = 'string';

    const string CREATED_AT = 'creado';
    const string UPDATED_AT = 'modificado';

    /**
     * Atributos asignables
     *
     * @var array<int, string>
     */
    protected $fillable = [];

    /**
     * Get the comments for the blog post.
     */
    public function obras(): HasMany
    {
        return $this->hasMany(Obra::class);
    }
}
