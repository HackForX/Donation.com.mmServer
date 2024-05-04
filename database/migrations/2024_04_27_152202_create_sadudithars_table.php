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
        Schema::create('sadudithars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('township_id')->nullable();
            $table->unsignedBigInteger('subCategory_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->integer('estimated_amount');
            $table->string('estimated_time')->nullable();
            $table->string('estimated_quantity')->nullable();
            $table->string('actual_start_time')->nullable();
            $table->string('actual_end_time')->nullable();
            $table->string('event_date')->nullable();
            $table->boolean('is_open')->default(false);
            $table->boolean('is_show')->default(true);
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable(); // Add status column
            $table->double('latitude')->nullable(); // Stores latitude (max_digits: 10, decimal_places: 6)
            $table->double('longitude')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('township_id')->references('id')->on('townships')->onDelete('cascade');
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sadudithars');
    }
};
