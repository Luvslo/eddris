<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedGamesTable extends Migration
{
    public function up()
    {
        Schema::create('saved_games', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('name');
            $table->string('user_id');
            $table->json('choices_ids');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('saved_games', function (Blueprint $table) {
            $table->dropForeign('saved_games_user_id_foreign');
        });

        Schema::dropIfExists('saved_games');
    }
}
