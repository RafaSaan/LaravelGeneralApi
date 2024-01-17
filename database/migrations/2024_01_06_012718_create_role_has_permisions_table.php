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
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->foreign('profile_id')
            ->references('id')
            ->on('user_profiles')
            ->onDelete('NO ACTION')
            ->onUpdate('NO ACTION');

            $table->foreign('permission_id')
            ->references('id')
            ->on('permissions')
            ->onDelete('NO ACTION')
            ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_has_permissions');
    }
};
