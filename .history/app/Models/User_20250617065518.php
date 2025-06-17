<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'sexo',
        'telefono',
        'direccion',
        'fecha_registro',
        'ci',
        'tipo_usuario',
        'id_rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function rol()
    {
        return $this->belongsTo(\App\Models\Rol::class, 'id_rol', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function administrador()
    {
        return $this->hasOne(\App\Models\Administrador::class, 'id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudiante()
    {
        return $this->hasOne(\App\Models\Estudiante::class, 'id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function instructor()
    {
        return $this->hasOne(\App\Models\Instructor::class,  'id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notiEnviadas()
    {
        return $this->hasMany(\App\Models\NotiEnviada::class, 'id', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagosAdministrador()
    {
        return $this->hasMany(\App\Models\Pago::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagosEstudiante()
    {
        return $this->hasMany(\App\Models\Pago::class,  'id_est');
    }
    protected static function booted()
    {
        // Crear perfil con valores por defecto al crear usuario
        static::created(function ($usuario) {
            if ($usuario->id_rol  == 1){
                $usuario->administrador()->create([
                    'id' => $usuario->id,
                    'turno' => 'mañana'
                ]);
            }
            if ($usuario->id_rol  == 2){
                $usuario->estudiante()->create([
                    'id' => $usuario->id,
                    'fecha_nacimiento' => now()
                ]);
            }
            if ($usuario->id_rol  == 3){
                $usuario->instructor()->create([
                    'id' => $usuario->id,
                    'categ_licencia' => 'A'
                ]);
            }
        });

        // Eliminar perfil al borrar usuario (opcional si ya tienes onDelete('cascade'))
        static::deleting(function ($usuario) {
            $usuario->administrador?->delete();
            $usuario->estudiante?->delete();
            $usuario->instructor?->delete();
        });
        static::updated(function ($usuario) {
        // Verificar si el id_rol fue cambiado
        if ($usuario->isDirty('id_rol')) {
            // Eliminar perfiles antiguos
            $usuario->administrador?->delete();
            $usuario->estudiante?->delete();
            $usuario->instructor?->delete();

            // Crear el perfil correspondiente al nuevo rol
            if ($usuario->id_rol == 1) {
                $usuario->administrador()->create([
                    'id' => $usuario->id,
                    'turno' => 'mañana'
                ]);
            }
            if ($usuario->id_rol == 2) {
                $usuario->estudiante()->create([
                    'id' => $usuario->id,
                    'fecha_nacimiento' => now()
                ]);
            }
            if ($usuario->id_rol == 3) {
                $usuario->instructor()->create([
                    'id' => $usuario->id,
                    'categ_licencia' => 'A'
                ]);
            }
        }
        });
    }
        public function evaluaciones()
{
    return $this->hasMany(Evaluacion::class, 'estudiante_id');
}

public function evaluaciones_realizadas()
{
    return $this->hasMany(Evaluacion::class, 'instructor_id');
}
}
