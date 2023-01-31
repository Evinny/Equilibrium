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
        Schema::create('habitos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('categoria');
        });

        schema::table('inputs', function (blueprint $table){
            $table->foreign('habito_id')->references('id')->on('habitos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        schema::table('inputs', function(blueprint $table){
            $table->dropforeign('inputs_habito_id_foreign');
        
        });

        Schema::dropIfExists('habitos');
    }
};
