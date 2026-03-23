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
        Schema::create('bussola_submissions', function (Blueprint $table) {
            $table->id();
            $table->uuid('token')->unique();
            $table->json('answers');
            $table->json('scores');
            $table->json('profile');
            $table->json('strengths');
            $table->json('growth_areas');
            $table->string('user_agent')->nullable();
            $table->foreignId('report_request_id')
                  ->nullable()
                  ->constrained('report_requests')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bussola_submissions');
    }
};
