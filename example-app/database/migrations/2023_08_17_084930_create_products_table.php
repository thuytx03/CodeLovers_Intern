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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image');
            $table->string('brand')->nullable();
            $table->integer('selling_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('quantity');
            $table->longText('description');
            $table->integer('features')->nullable();
            $table->integer('like')->nullable();
            $table->integer('status')->nullable();
            $table->integer('view')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
