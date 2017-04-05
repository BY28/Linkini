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
            $table->integer('entreprise_id')->unsigned();
            $table->integer('page_category_id')->unsigned();
            $table->string('content_title')->default('');
            $table->string('content_sub_title')->default('');
            $table->string('content_text')->default('');
            $table->string('image')->default('');
            $table->timestamps();
            $table->foreign('entreprise_id')->references('id')->on('entreprises')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
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
            $table->dropForeign('linkini_pages_entreprise_id_foreign');
            $table->dropForeign('linkini_pages_page_category_id_foreign');
        });
        Schema::dropIfExists('linkini_pages');
    }
}
