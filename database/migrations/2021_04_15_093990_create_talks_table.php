<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('title', 100);
            $table->text('description', 100);
            $table->unsignedBigInteger('speaker_id');
            $table->unsignedBigInteger('event_id');
            $table->json('participants');
            $table->json('tags');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('speaker_id')->references('id')->on('speaker');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talks');
    }
}
