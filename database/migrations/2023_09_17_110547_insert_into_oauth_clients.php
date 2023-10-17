<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;


class InsertIntoOauthClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create a new instance of Passport Client
        $client = new Client();
        $client->name = 'company_brand_website';
        $client->secret ='iNEJYnNcOmzfIwrAj6jnQRqYINp1zEv1dI2pImrU';
        $client->redirect = '';
        $client->personal_access_client = 1;
        $client->password_client = false;
        $client->revoked = false;
        $client->save();

         $t = DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // To reverse, you may want to delete the client you created.
        // However, be cautious as dropping clients may have security implications.
    }
}
