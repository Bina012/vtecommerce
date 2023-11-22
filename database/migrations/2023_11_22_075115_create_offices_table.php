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
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('office_name')->nullable()->default(null);
            $table->string('office_address')->nullable()->default(null);
            $table->string('email_address')->nullable()->default(null);
            $table->string('phone_number')->nullable()->default(null);
            $table->string('focal_person_name')->nullable()->default(null);
            $table->string('fax')->nullable()->default(null);
            $table->string('website')->nullable()->default(null);
            $table->decimal('latitude',10,8)->nullable()->default(null);
            $table->decimal('longitude',10,8)->nullable()->default(null);
            $table->string('logo_path')->nullable()->default(null);
            $table->boolean('is_active')->default(1);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
