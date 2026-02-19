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
        Schema::table('transactions', function (Blueprint $table) {
            $table->boolean('is_delivered')->default(false)
                ->after('description');
            $table->dateTime('delivered_at')->nullable();
            $table->boolean('is_completed')->default(false)
                ->after('is_delivered');
            $table->dateTime('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['is_completed', 'completed_at', 'is_delivered', 'delivered_at']);
        });
    }
};
