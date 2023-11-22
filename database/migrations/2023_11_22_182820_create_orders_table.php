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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('ordered_by');
            $table->integer('quantity')->nullable()->default(0);
            $table->date('order_date')->nullable()->default(null);
            $table->date('delivery_date')->nullable()->default(null);
            $table->integer('no_of_unit')->nullable()->default(0);
            $table->decimal('unit_amount',10,2)->nullable()->default(null);
            $table->decimal('total_amount',10,2)->nullable()->default(null);
            $table->string('delivery_status')->nullable()->default(null);
            $table->string('delivery_location')->nullable()->default(null);
            $table->string('customer_name')->nullable()->default(null);
            $table->string('customer_phonenumber')->nullable()->default(null);
            $table->string('payment_method')->nullable()->default(null);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('ordered_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
