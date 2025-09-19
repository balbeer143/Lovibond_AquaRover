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
        Schema::create('xd7500_sheet_data', function (Blueprint $table) {
            $table->id();
            $table->string('memory_id')->nullable();
            $table->string('date_time')->nullable();
            $table->string('value_id')->nullable();
            $table->string('user')->nullable();
            $table->string('method')->nullable();
            $table->string('cell')->nullable();
            $table->string('value')->nullable();
            $table->string('unit')->nullable();
            $table->string('citation')->nullable();
            $table->string('dilution_1x')->nullable();
            $table->string('aqa1_id')->nullable();
            $table->string('aqa2_id')->nullable();
            $table->string('matrixcheck_id')->nullable();
            $table->string('reference_sample_blank')->nullable();
            $table->string('blank')->nullable();
            $table->string('date_of_blank')->nullable();
            $table->string('lot_id')->nullable();
            $table->string('measured_absorbance')->nullable();
            $table->string('cal_id')->nullable();
            $table->string('mq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xd7500_sheet_data');
    }
};
