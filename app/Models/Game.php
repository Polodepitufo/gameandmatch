<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre', 'id_game', 'id_genre');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'game_category', 'id_game', 'id_category');
    }
    protected $fillable = [
        'name',
        'description',
        'background',
        'platform'
    ];
}
