<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * Definición de la relación muchos a muchos con el modelo 
     */
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    //Define que atributos se pueden llenar de forma masiva
    protected $fillable = [
        'name',
        'email',
        'nick',
        'rol',
        'steam_id',
        'password',
    ];

    //Define que atributos deben ser ocultos para la serialización
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //Define cómo deben ser tratados dichos atributos
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


}
