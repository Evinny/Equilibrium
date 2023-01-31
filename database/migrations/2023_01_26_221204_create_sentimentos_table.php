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
        Schema::create('sentimentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sentimento', 100);
        });

        schema::table('inputs', function (blueprint $table){
            $table->foreign('sentimento_id')->references('id')->on('sentimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('inputs', function (blueprint $table){
            $table->dropforeign('inputs_sentimento_id_foreign');
        });

        Schema::dropIfExists('sentimentos');
    }
};
