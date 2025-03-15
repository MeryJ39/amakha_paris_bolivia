<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',  // Agregado el campo apellido
        'email',
        'password',
        'phone',      // Agregado el campo teléfono
        'role_id',    // Asegúrate de que role_id esté también aquí si vas a asignarlo en masa
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    // Nueva función para verificar si el usuario es administrador
    public function isAdmin()
    {
        return $this->role && $this->role->name === 'Admin';
    }

    /**
     * Define the relationship between User and Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


}