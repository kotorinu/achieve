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
       Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('artist_name', 50);
            $table->string('venue', 50);
            $table->string('seat', 100);
            $table->string('stage_distance', 50);
            $table->string('others', 1000);
            $table->string('fan_service', 50);
            $table->string('falling_objects', 50);
            $table->string('visible', 50);
            $table->string('comment', 4000);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
