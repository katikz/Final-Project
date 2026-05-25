<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('cost');
            $table->date('scheduled_date')->nullable()->after('date');
        });
    }

    public function down(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn(['status', 'scheduled_date']);
        });
    }
};