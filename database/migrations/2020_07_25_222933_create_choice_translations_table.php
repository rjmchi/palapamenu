<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedInteger('choice_id');
            $table->unique(['choice_id', 'locale']);
            $table->foreign('choice_id')->references('id')->on('choices')->onDelete('cascade');

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
        Schema::dropIfExists('choice_translations');
    }
}
