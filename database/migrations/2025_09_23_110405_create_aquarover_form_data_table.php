<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aquarover_form_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('tested_by');
            $table->string('mobile');
            $table->string('email');
            $table->text('address');
            $table->string('state');
            $table->string('city');
            $table->string('village');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('location_screenShot')->nullable();
            $table->string('sample_type');
            $table->string('source_category');
            $table->date('date');
            $table->time('time');
            $table->json('instruments')->nullable();
            $table->string('xd7500_files')->nullable();
            $table->string('sd335_files')->nullable();
            $table->string('md610_files')->nullable();
            $table->string('tb350_files')->nullable();
            $table->string('sd400_oxi_l_field')->nullable();
            $table->string('ph')->nullable();
            $table->string('temperature')->nullable();
            $table->string('conductivity')->nullable();
            $table->string('tds')->nullable();
            $table->string('salinity')->nullable();
            $table->string('sd40_files')->nullable();
            $table->text('remarks');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aquarover_form_data');
    }
};
