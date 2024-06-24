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
        Schema::create('online_vote_person', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tanggal_lahir');
            $table->string('nik')->unique();
            $table->string('ip');
            $table->string('user_agent');
            $table->enum('pilihan', ['1', '2', '3']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_vote_person');
    }
};
