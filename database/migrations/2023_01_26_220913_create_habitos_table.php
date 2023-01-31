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
        Schema::create('habits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('categoria');
        });

        schema::table('responses', function (blueprint $table){
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

        schema::table('responses', function(blueprint $table){
            $table->dropforeign('responses_habits_id_foreign');
        
        });

        Schema::dropIfExists('habits');
    }
};
