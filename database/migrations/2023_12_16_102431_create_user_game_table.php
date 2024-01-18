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
        Schema::create('user_game', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_game');
            $table->string('valoration')->nullable();
            $table->enum('match',['SI','NO'])->default('NO');
            $table->enum('state',['MATCHED','EN PAUSA','EN JUEGO','UNMATCHED','COMPLETADO','ABANDONADO'])->default('UNMATCHED');

            /** Relaciones**/
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_game')->references('id')->on('games');
            
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game');
    }
};
