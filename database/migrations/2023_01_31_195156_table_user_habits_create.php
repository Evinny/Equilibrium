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
        schema::create('user_habits', function(blueprint $table){
            $table->unsignedbiginteger('user_id');
            $table->unsignedbiginteger('habit_id');
        });

        schema::table('user_habits', function(blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('habit_id')->references('id')->on('habits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('user_habits', function(blueprint $table){
            $table->dropforeign('user_habits_habit_id_foreign');
            $table->dropforeign('user_habits_user_id_foreign');
        });

        schema::dropifexists('user_habits');
    }
};
