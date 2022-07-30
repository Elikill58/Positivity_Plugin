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
        Schema::create('positivity_settings', function (Blueprint $table) {
            $table->id();
            $table->string('stats_host')->nullable();
            $table->unsignedInteger('stats_port')->nullable();
            $table->string('stats_username')->nullable();
            $table->string('stats_password')->nullable();
            $table->string('stats_database')->nullable();
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
        Schema::dropIfExists('positivity_settings');
    }
};