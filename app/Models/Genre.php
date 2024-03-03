<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
        /**
     * Definición de la relación muchos a muchos con el modelo 
     */
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
        //Define que atributos se pueden llenar de forma masiva
    protected $fillable = [
        'name'
    ];
}
