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
        Schema::table('users', function (Blueprint $table) {
            $table->after('otp_verified', function (Blueprint $table) {
                $table->string('mobile_number')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('gender')->nullable();
                $table->text('address')->nullable();
                $table->string('country')->nullable();
                $table->string('city')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('citizenship')->nullable();
                $table->string('passport_number')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_number');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('citizenship');
            $table->dropColumn('passport_number');
        });
    }
};
