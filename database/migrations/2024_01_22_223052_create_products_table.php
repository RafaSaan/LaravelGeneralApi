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
            $table->string('description');
            $table->integer('quantity')->unsigned();
            $table->decimal('amount');
            $table->decimal('amountWholesale')->nullable();
            $table->boolean('hasWholesale')->default(false);
            $table->string('imgUrl')->nullable();
            $table->integer('statusId')->unsigned();
            $table->timestamps();

            $table->foreign('statusId')->references('id')->on('product_statuses');
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
