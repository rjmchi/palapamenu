<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedInteger('item_id');
            $table->unique(['item_id', 'locale']);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            // Actual fields you want to translate     
            $table->string('name');
            $table->text('description')->nullable();       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_translations');
    }
}
