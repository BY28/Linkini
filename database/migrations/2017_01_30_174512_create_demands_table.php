<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 80);
            $table->text('content');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('demands', function(Blueprint $table){
            $table->dropForeign('demands_user_id_foreign');
        });
        Schema::dropIfExists('demands');
    }
}
