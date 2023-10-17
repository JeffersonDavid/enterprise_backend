<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id('transaction_id');

            $table->json('transaction_params');
            $table->json('transaction_headers');
            $table->string('transaction_source');
            $table->string('transaction_source_ip');
            $table->integer('transaction_type');
            

            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
