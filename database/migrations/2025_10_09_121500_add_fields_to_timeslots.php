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
        Schema::table('timeslots', function (Blueprint $table) {
            if (!Schema::hasColumn('timeslots', 'start_time')) {
                $table->dateTime('start_time')->nullable()->after('service_id');
            }
            if (!Schema::hasColumn('timeslots', 'end_time')) {
                $table->dateTime('end_time')->nullable()->after('start_time');
            }
            if (!Schema::hasColumn('timeslots', 'booked')) {
                $table->boolean('booked')->default(false)->after('end_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timeslots', function (Blueprint $table) {
            if (Schema::hasColumn('timeslots', 'booked')) {
                $table->dropColumn('booked');
            }
            if (Schema::hasColumn('timeslots', 'end_time')) {
                $table->dropColumn('end_time');
            }
            if (Schema::hasColumn('timeslots', 'start_time')) {
                $table->dropColumn('start_time');
            }
        });
    }
};
