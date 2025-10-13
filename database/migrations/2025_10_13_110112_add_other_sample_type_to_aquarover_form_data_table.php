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
        Schema::table('aquarover_form_data', function (Blueprint $table) {
            $table->string('other_sample_type')->nullable()->after('sample_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aquarover_form_data', function (Blueprint $table) {
            $table->dropColumn('other_sample_type');
        });
    }
};
