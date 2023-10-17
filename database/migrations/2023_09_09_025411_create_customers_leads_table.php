<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCustomersLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('customers_leads', function (Blueprint $table) {

            $table->id('customer_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('transaction_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers_leads');
    }

}
