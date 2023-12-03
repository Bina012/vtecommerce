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
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('title')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->text('short_description')->nullable()->default(null);
            $table->string('manufacture_name')->nullable()->default(null);
            $table->string('manufacture_brand')->nullable()->default(null);
            $table->string('stocks')->nullable()->default(null);
            $table->decimal('price',10,2)->nullable()->default(null);
            $table->string('discount')->nullable()->default(null);
            $table->string('color')->nullable()->default(null);
            $table->string('size')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('visibility')->nullable()->default(null);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
