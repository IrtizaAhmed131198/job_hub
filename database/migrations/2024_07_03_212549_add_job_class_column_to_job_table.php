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
        Schema::table('job', function (Blueprint $table) {
            $table->unsignedBigInteger('class_id')->nullable()->after('title');

            $table->foreign('class_id')
                  ->references('id')
                  ->on('job_class')
                  ->onDelete('set null'); // Adjust the onDelete behavior as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });
    }
};
