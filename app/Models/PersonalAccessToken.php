<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonalAccessToken
 *
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string $token
 * @property string|null $abilities
 * @property Carbon|null $last_used_at
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PersonalAccessToken extends Model
{
    protected $table = 'personal_access_tokens';

    /**
     * Castings
     *
     * @var string[]
     */
    protected $casts = [
        'tokenable_id' => 'int',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Escondidos
     *
     * @var string[]
     */
    protected $hidden = [
        'token',
    ];

    /**
     * Atributos asignables
     *
     * @var string[]
     */
    protected $fillable = [
        'tokenable_type',
        'tokenable_id',
        'usuario',
        'token',
        'abilities',
        'last_used_at',
        'expires_at',
    ];
}
