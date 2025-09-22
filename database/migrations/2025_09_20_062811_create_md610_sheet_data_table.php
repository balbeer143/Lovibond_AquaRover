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
        Schema::create('md610_sheet_data', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable();
            $table->time('time')->nullable();
            $table->string('instrument_serial_no')->nullable();
            $table->string('method_no')->nullable();
            $table->string('method_name')->nullable();
            $table->string('range')->nullable();
            $table->integer('number_of_results')->nullable();
            $table->string('Result_1')->nullable();
            $table->string('units_and_chemical_formula_1')->nullable();
            $table->string('Result_2')->nullable();
            $table->string('units_and_chemical_formula_2')->nullable();
            $table->string('Result_3')->nullable();
            $table->string('units_and_chemical_formula_3')->nullable();
            $table->string('Result_4')->nullable();
            $table->string('units_and_chemical_formula_4')->nullable();
            $table->string('code_no')->nullable();
            $table->string('current_instrument_firmware_version')->nullable();
            $table->string('instrument_firmware_version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md610_sheet_data');
    }
};
