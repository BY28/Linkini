<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrepriseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->text('description');
            $table->boolean('accepted')->default(false);
            $table->boolean('refused')->default(false);
            $table->integer('user_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->foreign('activity_id')
                    ->references('id')
                    ->on('activities')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entreprise_orders', function(Blueprint $table){
            $table->dropForeign('entreprise_orders_user_id_foreign');
            $table->dropForeign('entreprise_orders_activity_id_foreign');
            $table->dropForeign('entreprise_orders_category_id_foreign');
        });
        Schema::dropIfExists('entreprise_orders');
    }
}
