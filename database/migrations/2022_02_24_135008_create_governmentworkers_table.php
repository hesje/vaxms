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
        Schema::create('governmentworkers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string("access_token")->nullable();
            $table->foreignIdFor(\App\Models\Country::class)->default(1);
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
        Schema::dropIfExists('governmentworkers');
    }
};
