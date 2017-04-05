<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_category_id')->unsigned();
            $table->string('content_title')->default('Titre...');
            $table->string('content_sub_title')->default('Sous titre...');
            $table->string('content_text')->default('Text...');
            $table->string('image')->default(null);
            $table->foreign('page_category_id')->references('id')->on('page_categories')
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
        Schema::table('advertisements', function(Blueprint $table) {
            $table->dropForeign('advertisements_page_category_id_foreign');
        });
        
        Schema::dropIfExists('advertisements');
    }
}
