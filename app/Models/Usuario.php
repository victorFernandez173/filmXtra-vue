<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Usuario
 *
 * @property int $id
 * @property string $usuario
 * @property string $nombre
 * @property string $apellidos
 * @property string|null $username
 * @property Carbon|null $nacimiento
 * @property string|null $pais
 * @property string $email
 * @property Carbon|null $email_verificado_fecha
 * @property string $password
 * @property string|null $social_id
 * @property int $login_tipo_id
 * @property Carbon $creado
 * @property Carbon $modificado
 *
 * @property Collection|Critica[] $criticas
 * @property Collection|Evaluacion[] $evaluaciones
 * @property Collection|Like[] $likes
 * @property LoginTipo $loginTipo
 *
 * @package App\Models
 */
class Usuario extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const string CREATED_AT = 'creado';
    const string UPDATED_AT = 'modificado';

    /**
     * Atributos asignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario',
        'nombre',
        'apellidos',
        'age',
        'pais',
        'email',
        'social_id',
        'login_tipo_id',
    ];

    /**
     * Atributos escondidos.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Castings.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nacimiento'             => 'datetime',
        'email_verificado_fecha' => 'datetime',
        'login_tipo_id'          => 'integer'
    ];

    /**
     * Obtiene las críticas.
     */
    public function criticas(): HasMany
    {
        return $this->hasMany(Critica::class);
    }

    /**
     * Obtiene las evaluaciones.
     */
    public function evaluaciones(): HasMany
    {
        return $this->hasMany(Evaluacion::class);
    }

    /**
     * Obtiene los likes.
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Critica::class, 'likes', 'usuario_id', 'critica_id', 'id');
    }

    /**
     * Obtiene tipo de login.
     */
    public function loginTipo(): BelongsTo
    {
        return $this->belongsTo(LoginTipo::class);
    }

    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verificado_fecha);
    }

    /**
     * Marca email usuario como verificado.
     *
     * @return bool
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verificado_fecha' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Obtiene el email que debe ser verificado.
     *
     * @return string
     */
    public function getEmailForVerification(): string
    {
        return $this->email;
    }
}
