<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->unsignedInteger('path_id');
            $table->timestamps();

            $table->foreign('path_id')
                ->references('id')
                ->on('paths')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('progress', function (Blueprint $table) {
            $table->dropForeign('progress_path_id_foreign');
        });
        Schema::dropIfExists('progress');
    }
}
