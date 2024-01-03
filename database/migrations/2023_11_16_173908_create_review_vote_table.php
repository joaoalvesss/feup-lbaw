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
        Schema::create('review_vote', function (Blueprint $table){
            $table->boolean('vote');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('review_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');

            $table->primary(['user_id', 'review_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_vote');
    }
};
