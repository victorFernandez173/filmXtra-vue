<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Medio
 *
 * @property int $id
 * @property string $nombre
 * @property Carbon $creado
 * @property Carbon $modificado
 * @property Collection|Usuario[] $usuarios
 */
class LoginTipo extends Model
{
    const CREATED_AT = 'creado';

    const UPDATED_AT = 'modificado';

    const FILMXTRA_TIPO = 1;

    const GOOGLE_TIPO = 2;

    const GIT_TIPO = 3;

    /**
     * Atributos asignables.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Obtener usuarios con este tipo.
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class);
    }
}
