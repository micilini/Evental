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
        Schema::create('events', function (Blueprint $table) {
            $table->id('id_event');
            $table->string('title_event', 100);
            $table->string('description_event', 255);
            $table->date('start_date_event');
            $table->date('end_date_event');
            $table->time('start_hour_event');
            $table->time('end_hour_event');
            $table->boolean('is_active');
            $table->dateTime('dt_datecreated');
            $table->dateTime('dt_dateupdated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
