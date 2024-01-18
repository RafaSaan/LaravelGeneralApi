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
            $table->decimal('amount');
            $table->decimal('amount_wholesale');
            $table->boolean('has_wholesale')->default(false);
            $table->string('img_url');
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('products_status');
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
