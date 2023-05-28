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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->integer('price');
            $table->tinyInteger('total_rooms');
            $table->string('size')->nullable();
            $table->tinyInteger('total_beds')->nullable();
            $table->tinyInteger('total_guests')->nullable();
            $table->tinyInteger('total_bathroom')->nullable();
            $table->tinyInteger('total_balconies')->nullable();
            $table->string('main_photo');
            $table->string('video_code')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('rooms');
    }
};
