<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConnectedApplication;


class AuthController extends Controller
{
    public function getToken(Request $request)
    {

        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        list($scheme, $credentials) = explode(' ', $authorizationHeader, 2);

        if (strtolower($scheme) !== 'basic') {
            return response()->json(['error' => 'Invalid authorization scheme'], 401);
        }

        $decodedCredentials = base64_decode($credentials);
        
        list($name,$secret) = explode(':', $decodedCredentials, 2);

        $connectedApp = ConnectedApplication::where('secret', $secret)->first();


        if (!$connectedApp) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        logger()->info(json_encode($connectedApp));
        logger()->info('Connected App: ' . $connectedApp->name);

        $accessToken = $connectedApp->createToken('my-access-token')->accessToken;

        return response()->json(['access_token' => $accessToken]);  

    }
}
