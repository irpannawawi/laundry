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
        
        Schema::table('transaction', function(Blueprint $table){
            $table->dropColumn('transaction_status');
        });
        Schema::table('transaction', function(Blueprint $table){
            $table->enum('transaction_status', ['ordered', 'accepted', 'proccess', 'shipment', 'finish', 'canceled'])->default('ordered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
