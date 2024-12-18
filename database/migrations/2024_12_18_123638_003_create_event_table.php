<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hasdept_id')->unsigned();
            $table->text('nama_event');
            $table->text('deskripsi_event');
            $table->text('lokasi_event');
            $table->string('pic');
            $table->string('nohp_pic');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table
                ->foreign('hasdept_id')
                ->references('id')
                ->on('hasdept')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
};
