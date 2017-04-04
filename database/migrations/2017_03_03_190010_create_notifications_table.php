<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->boolean('seen')->default(false);
            $table->string('title');
            $table->string('content');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
            $table->foreign('project_id')->references('id')->on('projects')
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
        Schema::table('notifications', function(Blueprint $table){
            $table->dropForeign('notifications_user_id_foreign');
            $table->dropForeign('notifications_project_id_foreign');
        });

        Schema::dropIfExists('notifications');
    }
}
