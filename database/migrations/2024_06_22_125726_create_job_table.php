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
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('company')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_web_link')->nullable();
            $table->string('location')->nullable();
            $table->string('salary')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('time_slot')->nullable();
            $table->boolean('is_remote')->default(false);
            $table->boolean('is_fulltime')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};
