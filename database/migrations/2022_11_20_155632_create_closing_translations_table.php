<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closing_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedInteger('closing_id');
            $table->unique(['closing_id', 'locale']);
            $table->foreign('closing_id')->references('id')->on('closings')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('title')->nullable();
            $table->string('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closing_translations');
    }
};
