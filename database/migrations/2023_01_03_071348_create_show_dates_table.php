<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->index()->constrained('films');
            $table->date('showing_date');
            $table->foreignId('show_time_id')->index()->constrained('show_times');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_dates');
    }
};
