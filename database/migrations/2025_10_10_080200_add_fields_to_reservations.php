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
        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->unsignedBigInteger('service_id')->nullable()->after('user_id');
                $table->unsignedBigInteger('timeslot_id')->nullable()->after('service_id');

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
                $table->foreign('timeslot_id')->references('id')->on('timeslots')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'timeslot_id')) {
                $table->dropForeign(['timeslot_id']);
                $table->dropColumn('timeslot_id');
            }
            if (Schema::hasColumn('reservations', 'service_id')) {
                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');
            }
            if (Schema::hasColumn('reservations', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
