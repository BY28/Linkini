<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('description')->default('Entreprise sérieuse et fiable, en partenariat avec Linkini. Description attente...');
            $table->string('image')->default('entreprise.png');
            $table->boolean('checked')->default(false);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
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
        Schema::table('entreprises', function(Blueprint $table){
            $table->dropForeign('entreprises_user_id_foreign');
        });
        Schema::dropIfExists('entreprises');
    }
}
