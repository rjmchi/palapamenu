<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedInteger('selection_id');
            $table->unique(['selection_id', 'locale']);
            $table->foreign('selection_id')->references('id')->on('selections')->onDelete('cascade');

            // Actual fields you want to translate 
            $table->string('name');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selection_translations');
    }
}
