<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emotions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('emotion', 100);
        });

        schema::table('responses', function (blueprint $table){
            $table->foreign('emotion_id')->references('id')->on('emotions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('responses', function (blueprint $table){
            $table->dropforeign('responses_emotion_id_foreign');
        });

        Schema::dropIfExists('emotions');
    }
};
