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
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class LoginTipo extends Model
{
    const string CREATED_AT = 'creado';
    const string UPDATED_AT = 'modificado';

    const int FILMXTRA_TIPO = 1;
    const int GOOGLE_TIPO = 2;
    const int GIT_TIPO = 3;

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
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
