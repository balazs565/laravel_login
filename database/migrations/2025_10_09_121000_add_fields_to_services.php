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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('services', 'price')) {
                $table->decimal('price', 8, 2)->default(0)->after('name');
            }
            if (!Schema::hasColumn('services', 'duration')) {
                // duration in minutes
                $table->integer('duration')->default(30)->after('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'duration')) {
                $table->dropColumn('duration');
            }
            if (Schema::hasColumn('services', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('services', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
