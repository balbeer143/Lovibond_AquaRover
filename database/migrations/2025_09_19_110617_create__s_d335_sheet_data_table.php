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
        Schema::create('sd335_sheet_data', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp')->nullable();  
            $table->string('value')->nullable();         
            $table->string('unit')->nullable();       
            $table->string('location')->nullable();     
            $table->timestamps();                     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SD335_sheet_data');
    }
};
