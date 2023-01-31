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
        schema::create('user_emotions', function(blueprint $table){
            $table->unsignedbiginteger('user_id');
            $table->unsignedbiginteger('emotion_id');
        });

        schema::table('user_emotions', function(blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
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
        schema::table('user_emotions', function(blueprint $table){
            $table->dropforeign('user_emotions_emotion_id_foreign');
            $table->dropforeign('user_emotions_user_id_foreign');
        });

        schema::dropifexists('user_emotions');
    }
};
