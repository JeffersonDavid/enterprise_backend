<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectedApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('connected_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_name')->nullable();
            $table->string('application_grants')->nullable();
            $table->integer('oauth_client_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('connected_applications');
    }
}
