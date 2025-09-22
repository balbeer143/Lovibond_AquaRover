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
        Schema::create('tb350_sheet_data', function (Blueprint $table) {
            $table->id(); // Auto increment primary key
            $table->dateTime('datetime')->nullable(); // Excel Date
            $table->string('initials')->nullable();
            $table->text('notes')->nullable();
            $table->string('measurement')->nullable();
            $table->string('location')->nullable();
            $table->string('mode')->nullable();
            $table->string('sample_id')->nullable();
            $table->float('signal_average_readings')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb350_sheet_data');
    }
};
