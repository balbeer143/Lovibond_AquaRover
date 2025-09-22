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
        Schema::create('sd400_oxi_l_sheet_data', function (Blueprint $table) {
            $table->id(); // Auto increment primary key
            $table->string('data_no')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->float('do_mg_l')->nullable();
            $table->float('saturation')->nullable();
            $table->float('temperature')->nullable();
            $table->float('pressure')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sd400_oxi_l_sheet_data');
    }
};
