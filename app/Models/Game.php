<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;
    /**
     * Definición de la relación muchos a muchos con el modelo 
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Definición de la relación muchos a muchos con el modelo 
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre', 'id_game', 'id_genre');
    }

    /**
     * Definición de la relación muchos a muchos con el modelo 
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'game_category', 'id_game', 'id_category');
    }

    //Define que atributos se pueden llenar de forma masiva
    protected $fillable = [
        'name',
        'description',
        'background',
        'platform'
    ];
}
