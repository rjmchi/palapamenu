<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedInteger('menu_id');
            $table->unique(['menu_id', 'locale']);
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('name');
            $table->longText('description')->nullable();              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_translations');
    }
}
