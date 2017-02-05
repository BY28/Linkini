<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_tag', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('demand_id')->references('id')->on('demands')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');

            $table->foreign('tag_id')->references('id')->on('tags')
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
        Schema::table('demand_tag', function(Blueprint $table) {
            $table->dropForeign('demand_tag_demand_id_foreign');
            $table->dropForeign('demand_tag_tag_id_foreign');
        });

        Schema::dropIfExists('demand_tag');
    }
}
