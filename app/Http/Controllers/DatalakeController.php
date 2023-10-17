<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sources\FromSource;

use Illuminate\Support\Facades\Validator;

class DatalakeController extends Controller
{
    
    public function intertOrders( Request $request ){

            try {
                    
                    if (! $request->isJson()) {
                        throw new \Exception("Request params must be a json", 400 );
                    }

                    $validator = self::validateJson( $request->json()->all(), [
                        'name' => 'required|string',
                        'email' => 'required|string',
                        'phone' => 'required|string',
                        'product'=> 'required|int',
                        'address' => 'required|string',
                        'transaction_type'=> 'required|int',
                        'quantity'=> 'required|int',
                        'order_type'=> 'required|int',
                        'product_type'=> 'required|int',
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['errors' => $validator->errors()], 400);
                    }

                    $FrormTransaction = FromSource::create( $request )
                    ->validated('JSON')->mode('queue')->start();

                    return response()->json(['ok' => 'ok'], 200); 

            
            
                }catch (\Throwable $th) {

                    logger()->error($th->getMessage());
                    logger()->error($th->getFile());
                    logger()->error($th->getLine());

                    return response()->json(['error' => 'There are some errors at the request', 'message' => $th->getMessage()], 500);
            }
    }
}
