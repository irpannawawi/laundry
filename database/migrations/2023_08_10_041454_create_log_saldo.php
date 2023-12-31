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
        //
        Schema::create('log_saldo', function (Blueprint $table) {
            $table->increments('id_log_saldo')->primary;
            $table->integer('saldo');
            $table->enum('type', ['masuk','keluar']);
            $table->string('ket');
            $table->string('user_id');
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
        //
        Schema::dropIfExists('log_saldo');
    }
};
