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
        Schema::table('job_applications', function (Blueprint $table) {
            $table->after('reference', function (Blueprint $table) {
                $table->string('payment_method')->nullable();
                $table->string('transaction_id')->nullable();
                $table->string('card_token')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('transaction_id');
            $table->dropColumn('card_token');
        });
    }
};
