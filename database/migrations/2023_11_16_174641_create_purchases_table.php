<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedInteger('quantity');
            $table->timestamp('date')->default(now());
            $table->unsignedFloat('total');
            $table->enum('delivery_progress', ['Processing', 'Shipped', 'Delivered'])->default('Processing');
            $table->unsignedBigInteger('address_id'); //?
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        DB::statement('ALTER TABLE purchases ADD CONSTRAINT total_check CHECK (total > 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
