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
        Schema::create('country_vaccination', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Country::class);
            $table->foreignIdFor(\App\Models\Vaccination::class);
            $table->integer('age_at_administration')->comment('age in weeks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_vaccination');
    }
};
