<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrepriseTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise_tag', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('entreprise_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
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
        Schema::table('entreprise_tag', function(Blueprint $table) {
            $table->dropForeign('entreprise_tag_entreprise_id_foreign');
            $table->dropForeign('entreprise_tag_tag_id_foreign');
        });

        Schema::dropIfExists('entreprise_tag');
    }
}
