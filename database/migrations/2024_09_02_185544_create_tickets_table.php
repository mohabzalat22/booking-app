<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('category');
            $table->dateTime('date_time');
            $table->string('country');
            $table->string('city');
            $table->string('place');
            $table->string('location'); //lang - lat
            $table->float('price');
            $table->string('image');
            $table->float('discount')->default(0);
            $table->float('tax')->default(0);
            $table->boolean('reserved_bool')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};