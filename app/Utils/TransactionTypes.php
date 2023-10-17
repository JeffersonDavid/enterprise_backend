<?php
namespace App\Utils;

use \App\Jobs\DipatcherJob;
use \App\Models\Transaction ;
use App\Mail\CustomerLeadsMail;

class TransactionTypes
{
    const BUYREQUEST = 1;

    const CONTACT = 2;
   

    public static function executeTransaction( Transaction $transaction )
    {  

        $data = $transaction->getTransactionParams(); 

        switch ( (int) $transaction->transaction_type ) {

            case self::BUYREQUEST:

                $selectedFields = array_intersect_key( $data, array_flip ([
                    'quantity',
                    'order_type',
                    'product_type'
                ]));

                $data['transaction_id'] = $transaction->transaction_id;
                $data['customer_id'] = $transaction->customer->customer_id;

                $order = \App\Models\Orders::create($data);

                $notify = \App\Models\MailNotifications::create([
                    'customer_id' => $transaction->customer->customer_id,
                    'transaction_type' => $transaction->transaction_type,
                    'transaction_id' => $transaction->transaction_id
                ]);

                return $notify;

            case self::CONTACT:

                return 'Clase encargada de hacer una CONT';

            default:
                throw new \Exception('Transaction type not found');
        }
    }
}