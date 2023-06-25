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
            $table->string('name', 255);
            $table->string('wp_id', 255)->nullable();
            $table->string('slug')->nullable();
            $table->string('permalink', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('barcode')->default(0);
            $table->string('price')->default(0);
            $table->string('costo')->default(0);
            $table->string('stock')->nullable();
            $table->string('marca')->nullable();
            $table->string('talla')->nullable();
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
            $table->softDeletes();
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
