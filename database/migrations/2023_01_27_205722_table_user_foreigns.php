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

         

         //------INPUTS FOREIGN-------//

        schema::table('inputs', function(blueprint $table){
            $table->unsignedbiginteger('user_id');
        });

        schema::table('inputs', function(blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        

        schema::table('inputs', function(blueprint $table){
            $table->dropforeign('inputs_user_id_foreign');
            $table->dropcolumn('user_id');
        });
        
    }
};
