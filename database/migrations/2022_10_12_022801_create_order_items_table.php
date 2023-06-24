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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('price');
            $table->text('special')->nullable();
            $table->timestamps();
            $table->foreignId('order_id')->constrained()->onDelete("cascade");
            $table->foreignId('item_id')->constrained()->onDelete("cascade");
            $table->foreignId('choice_id')->nullable()->constrained()->onDelete("cascade");
            $table->foreignId('option_id')->nullable()->constrained()->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
