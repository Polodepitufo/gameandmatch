<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_game');
            $table->unsignedBigInteger('id_genre');
            
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();

            /** Relaciones**/
            $table->foreign('id_game')->references('id')->on('games');
            $table->foreign('id_genre')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_genre');
    }
};
