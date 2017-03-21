<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('entreprise_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('accepted')->default(false);
            $table->boolean('refused')->default(false);
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('link_orders', function(Blueprint $table){
            $table->dropForeign('link_orders_project_id_foreign');
            $table->dropForeign('link_orders_entreprise_id_foreign');
            $table->dropForeign('link_orders_user_id_foreign');
        });
        Schema::dropIfExists('link_orders');
    }
}
