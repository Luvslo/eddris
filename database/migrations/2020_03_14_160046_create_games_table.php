<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('user_id');
            $table->string('progress_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('progress_id')
                ->references('id')
                ->on('progress')
                ->onDelete('cascade');

            $table->index('user_id', 'games_user_id_index');

            $table->index('progress_id', 'games_progress_id_index');
        });
    }

    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('games_user_id_foreign');
            $table->dropForeign('games_progress_id_foreign');
            $table->dropIndex('games_user_id_index');
            $table->dropIndex('games_progress_id_index');
        });

        Schema::dropIfExists('games');
    }
}
