<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrdersTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //php artisan make:migration nombre_de_la_migracion --create=order_types
    public function up()
    {
        Schema::create('order_types', function (Blueprint $table) {
            $table->id();
            $table->string('order_name');
            $table->integer('order_type');
            $table->timestamps();
        });

        $t = DB::table('order_types')->insert([
            'order_name' => 'buy_order',
            'order_type' => 1
        ]);

        $t = DB::table('order_types')->insert([
            'order_name' => 'contact_order',
            'order_type' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_types');
    }
}
