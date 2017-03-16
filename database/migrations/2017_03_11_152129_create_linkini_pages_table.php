<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkiniPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linkini_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_category_id')->unsigned();
            $table->string('image')->default('entreprise.png');
            $table->timestamps();
            $table->foreign('page_category_id')->references('id')->on('page_categories')
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
         Schema::table('linkini_pages', function(Blueprint $table) {
            $table->dropForeign('linkini_pages_page_category_id_foreign');
        });
        Schema::dropIfExists('linkini_pages');
    }
}
