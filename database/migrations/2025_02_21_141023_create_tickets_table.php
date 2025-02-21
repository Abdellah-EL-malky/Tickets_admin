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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->text('message')->default(null);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('status',['Résolu','En cours','Non résolu'])->default('Non résolu');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
